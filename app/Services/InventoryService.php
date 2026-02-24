<?php

namespace App\Services;

use App\Enums\TransactionType;
use App\Models\Item;
use App\Models\InventoryTransaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class InventoryService
{
    public function add(array $lines): void
    {
        DB::transaction(function () use ($lines) {
            foreach ($lines as $line) {
                $name = trim($line['name']);
                $unit = trim($line['unit']);
                $qty  = (float) $line['quantity'];

                $item = Item::firstOrCreate(
                    ['name' => $name],
                    ['unit' => $unit, 'quantity' => 0]
                );

                if ($item->unit !== $unit) {
                    throw ValidationException::withMessages([
                        'lines' => ["Unit mismatch for item '{$item->name}'. Existing unit: {$item->unit}, received: {$unit}."]
                    ]);
                }

                $item = Item::whereKey($item->id)->lockForUpdate()->first();

                InventoryTransaction::create([
                    'item_id' => $item->id,
                    'type' => TransactionType::Add->value,
                    'quantity' => $qty,
                    'note' => $line['note'] ?? null,
                    'meta' => null,
                ]);

                $item->quantity = (float) $item->quantity + $qty;
                $item->save();
            }
        });
    }

    public function createItems(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $createdItems = [];

            foreach ($items as $itemData) {
                $item = Item::create([
                    'name' => $itemData['name'],
                    'unit' => $itemData['unit'],
                    'quantity' => $itemData['quantity'],
                ]);

                if ($itemData['quantity'] > 0) {
                    InventoryTransaction::create([
                        'item_id' => $item->id,
                        'type' => TransactionType::Add->value,
                        'quantity' => $itemData['quantity'],
                        'note' => 'Initial stock',
                        'meta' => 'Created with initial stock',
                    ]);
                }

                $createdItems[] = $item;
            }

            return $createdItems;
        });
    }

    public function addStock(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $transactions = [];

            foreach ($items as $itemData) {
                $inventoryItem = Item::lockForUpdate()->find($itemData['item_id']);

                $quantityBefore = $inventoryItem->quantity;
                $quantityAfter = $quantityBefore + $itemData['quantity'];

                $inventoryItem->update(['quantity' => $quantityAfter]);

                $transactions[] = InventoryTransaction::create([
                    'item_id' => $inventoryItem->id,
                    'type' => TransactionType::Add->value,
                    'quantity' => $itemData['quantity'],
                    'note' => $itemData['note'] ?? null,
                    'meta' => [
                        'quantity_before' => $quantityBefore,
                        'quantity_after' => $quantityAfter,
                    ],
                ]);

                $transactions[] = $transactions;
            }

            return $transactions;
        });
    }

    public function deductStock(array $items): array
    {
        return DB::transaction(function () use ($items) {
            $transactions = [];

            foreach ($items as $itemData) {
                $inventoryItem = Item::lockForUpdate()->find($itemData['item_id']);

                if ($inventoryItem->quantity < $itemData['quantity']) {
                    throw new \Exception("Insufficient quantity for item: {$inventoryItem->name}");
                }

                $quantityBefore = $inventoryItem->quantity;
                $quantityAfter = $quantityBefore - $itemData['quantity'];

                $inventoryItem->update(['quantity' => $quantityAfter]);

                $transactions[] = InventoryTransaction::create([
                    'item_id' => $inventoryItem->id,
                    'type' => TransactionType::Deduct->value,
                    'quantity' => $itemData['quantity'],
                    'note' => $itemData['note'] ?? null,
                    'meta' => [
                        'quantity_before' => $quantityBefore,
                        'quantity_after' => $quantityAfter,
                    ],
                ]);

                $transactions[] = $transactions;
            }

            return $transactions;
        });
    }

    public function deduct(array $lines): void
    {
        DB::transaction(function () use ($lines) {
            foreach ($lines as $line) {
                $qty = (float) $line['quantity'];

                $item = Item::whereKey($line['item_id'])->lockForUpdate()->firstOrFail();

                if ((float) $item->quantity < $qty) {
                    throw ValidationException::withMessages([
                        'lines' => ["Not enough stock for '{$item->name}'. Available: {$item->quantity}, requested: {$qty}."]
                    ]);
                }

                InventoryTransaction::create([
                    'item_id' => $item->id,
                    'type' => TransactionType::Deduct->value,
                    'quantity' => $qty,
                    'note' => $line['note'] ?? null,
                    'meta' => null,
                ]);

                $item->quantity = (float) $item->quantity - $qty;
                $item->save();
            }
        });
    }
}
