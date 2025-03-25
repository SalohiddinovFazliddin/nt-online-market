<?php

namespace App\Http\Controllers;

use App\Models\ProductStatus;
use Illuminate\Http\Request;

class ProductStatusesController extends Controller
{
    // Wishlistni o‘zgartirish
    public function toggleWishlist(Request $request)
    {
        $status = ProductStatus::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($status) {
            $status->like = !$status->like; // mavjud bo‘lsa, holatni o‘zgartiramiz
            $status->save();
        } else {
            $status = ProductStatus::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'like' => true,
                'shopping' => false, // default
            ]);
        }

        return response()->json(['message' => 'Wishlist yangilandi', 'status' => $status]);
    }

    // Cartni o‘zgartirish
    public function toggleCart(Request $request)
    {
        $status = ProductStatus::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($status) {
            $status->shopping = !$status->shopping; // mavjud bo‘lsa, holatni o‘zgartiramiz
            $status->save();
        } else {
            $status = ProductStatus::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'shopping' => true,
                'like' => false, // default
            ]);
        }

        return response()->json(['message' => 'Cart yangilandi', 'status' => $status]);
    }

    // Wishlistdagi mahsulotlarni olish
    public function wishlist()
    {
        $wishlist = ProductStatus::where('user_id', auth()->id())
            ->where('like', true)
            ->with('product')
            ->get();

        return response()->json($wishlist);
    }

    // Cartdagi mahsulotlarni olish
    public function cart()
    {
        $cart = ProductStatus::where('user_id', auth()->id())
            ->where('shopping', true)
            ->with('product')
            ->get();

        return response()->json($cart);
    }
}
