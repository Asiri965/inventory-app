<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreInventoryRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Item;
use App\Services\InventoryService;

class ItemController extends Controller
{
    public function __construct(private InventoryService $inventory) {}

    public function index(Request $request)
    {
        $search = trim((string) $request->get('search', ''));

        $items = Item::query()
            ->when($search !== '', fn($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        return Inertia::render('Index', [
            'items' => $items,
            'filters' => ['search' => $search],
        ]);
    }

    public function show(Item $item)
    {
        $transactions = $item->transactions()
            ->latest('created_at')
            ->paginate(20)
            ->withQueryString();

        return Inertia::render('Show', [
            'item' => $item,
            'transactions' => $transactions,
        ]);
    }

    public function addItem()
    {
        $units = [
            ['id' => 1, 'name' => 'kg'],
            ['id' => 2, 'name' => 'g'],
            ['id' => 3, 'name' => 'm'],
            ['id' => 4, 'name' => 'cm'],
            ['id' => 5, 'name' => 'pcs'],
            ['id' => 6, 'name' => 'L'],
            ['id' => 7, 'name' => 'mL'],
            ['id' => 8, 'name' => 'box'],
            ['id' => 9, 'name' => 'dz'],
        ];
        return Inertia::render('Items/AddItem', [
            'units' => $units,
        ]);
    }

    public function storeItem(StoreInventoryRequest $request)
    {
        $this->inventory->createItems($request->validated()['items']);
        return redirect()->route('dashboard')->with('success', 'Items added successfully.');
    }
}
