<?php

namespace App\Http\Controllers\Api;

use App\Models\WishlistItem;
use Illuminate\Http\Request;

class WishlistController
{
    public function index(Request $request)
    {
        $wishlistItems = WishlistItem::with('product.category')
            ->where('user_id', $request->user()->id)
            ->get();
        return response()->json($wishlistItems);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlistItem = WishlistItem::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'product_id' => $request->product_id,
            ]
        );

        return response()->json($wishlistItem, 201);
    }

    public function destroy(Request $request, $id)
    {
        $wishlistItem = WishlistItem::where('user_id', $request->user()->id)
            ->where('product_id', $id)
            ->firstOrFail();

        $wishlistItem->delete();

        return response()->json(['message' => 'Removed from wishlist']);
    }
}
