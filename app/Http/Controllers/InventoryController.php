<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddInventoryRequest;
use App\Http\Requests\DeductInventoryRequest;
use App\Http\Requests\Inventory\StoreAdditionRequest;
use App\Http\Requests\Inventory\StoreDeductionRequest;
use App\Models\Item;
use App\Services\InventoryService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InventoryController extends Controller
{
    public function __construct(private InventoryService $inventory) {}

    public function add()
    {
        $items = Item::all()->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'unit' => $item->unit,
            'quantity' => $item->quantity,
        ]);
        return Inertia::render('Items/AddStock', [
            'inventoryItems' => $items,
        ]);
    }

    public function deduct()
    {
        $items = Item::all()->map(fn($item) => [
            'id' => $item->id,
            'name' => $item->name,
            'unit' => $item->unit,
            'quantity' => $item->quantity,
        ]);
        return Inertia::render('Items/DeductStock', [
            'inventoryItems' => $items,
        ]);
    }


    public function addStoreStock(AddInventoryRequest $request)
    {
        $this->inventory->addStock($request->validated()['items']);

        return redirect()->route('dashboard')->with('success', 'Stock added successfully.');
    }

    public function deductStock(AddInventoryRequest $request)
    {
        $this->inventory->addStock($request->validated()['items']);

        return redirect()->route('dashboard')->with('success', 'Stock added successfully.');
    }

    public function deductStoreStock(DeductInventoryRequest $request)
    {
        $this->inventory->deductStock($request->validated()['items']);

        return redirect()->route('dashboard')->with('success', 'Stock deducted successfully.');
    }

    public function addStore(StoreAdditionRequest $request): RedirectResponse
    {
        $this->inventory->add($request->validated()['lines']);
        return back()->with('success', 'Items added successfully.');
    }

    // public function deduct(StoreDeductionRequest $request): RedirectResponse
    // {
    //     $this->inventory->deduct($request->validated()['lines']);
    //     return back()->with('success', 'Items deducted successfully.');
    // }
}
