<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   //تشخیص کاربر
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class CartController extends Controller  //مدیریت سبد خرید و ثبت سفارش
{
    public function store(Request $request, $productId)  //اضافه کردن محصول به سبد خرید
    {
        $product = Product::where('is_active', true)->findOrFail($productId);

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ], [], [
            'quantity' => 'تعداد',
        ]);

        $existing = CartItem::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        $newQuantity = ($existing ? $existing->quantity : 0) + $request->quantity;

        if ($newQuantity > $product->stock) {
            return back()->with('error', 'موجودی این محصول کافی نیست.');
        }

        if ($existing) {
            $existing->update(['quantity' => $newQuantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => $newQuantity,
            ]);
        }

        return back()->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    public function index()   //نمایش سبد خرید و محاسبه مبلغ‌ها
    {
        $cartItems = CartItem::where('user_id', Auth::id())->with('product')->get();

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);
        $shippingCost = 50000;
        $total = $subtotal + $shippingCost;

        return view('shop.cart', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function checkout()  //بررسی سبد و آدرس، ساخت سفارش، ذخیره قیمت اقلام و کم کردن موجودی
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'سبد خرید خالی است.');
        }

        $address = Auth::user()->address;

        if (!$address) {
            return back()->with('error', 'لطفاً ابتدا آدرس خود را ثبت کنید.');
        }

        $shippingCost = 50000;

        try {
            DB::transaction(function () use ($cartItems, $address, $shippingCost) {

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'address_id' => $address->id,
                    'shipping_cost' => $shippingCost,
                    'total_price' => 0,
                    'status' => 'pending',
                    'ordered_at' => now(),
                ]);

                $subtotal = 0;

                foreach ($cartItems as $item) {
                    $product = Product::where('is_active', true)->lockForUpdate()->find($item->product_id);

                    if (!$product || $product->stock < $item->quantity) {
                        throw new \RuntimeException('موجودی یکی از محصولات سبد خرید کافی نیست یا این محصول دیگر فعال نیست.');
                    }

                    $order->orderItems()->create([
                        'product_id' => $product->id,
                        'quantity' => $item->quantity,
                        'price' => $product->price,
                    ]);

                    $product->decrement('stock', $item->quantity);

                    $subtotal += $item->quantity * $product->price;
                }

                $order->update(['total_price' => $subtotal + $shippingCost]);

                CartItem::where('user_id', Auth::id())->delete();
            });
        } catch (\RuntimeException $e) {
            return back()->with('error', $e->getMessage());
        }

        return redirect('/orders')->with('success', 'سفارش شما با موفقیت ثبت شد.');
    }
}
