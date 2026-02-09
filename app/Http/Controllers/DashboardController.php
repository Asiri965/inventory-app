<?php

namespace App\Http\Controllers;

use App\Models\InventoryTransaction;
use App\Models\Item;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $totalItems = Item::count();

        $totalStock = Item::sum('quantity');

        $lowStockItems = Item::select('id', 'name', 'quantity')
            ->where('quantity', '<', 10)
            ->where('quantity', '>', 0)
            ->orderBy('quantity')
            ->limit(5)
            ->get();

        $outOfStockCount = Item::where('quantity', '<=', 0)->count();

        $recentTransactions = InventoryTransaction::with(['item', 'user'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        $todayTransactions = InventoryTransaction::whereDate('created_at', today())->count();

        return Inertia::render('Dashboard', [
            'stats' => [
                'totalItems' => $totalItems,
                'totalStock' => number_format($totalStock, 2),
                'lowStockCount' => $lowStockItems->count(),
                'outOfStockCount' => $outOfStockCount,
                'todayTransactions' => $todayTransactions,
            ],
            'lowStockItems' => $lowStockItems,
            'recentTransactions' => $recentTransactions,
            'totalItems' => $totalItems,
        ]);
    }
}
