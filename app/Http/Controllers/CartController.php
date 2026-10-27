<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   //تشخیص کاربر
use App\Models\Order;

class CartController extends Controller  //مدیریت سبد خرید و ثبت سفارش
{
    public function store(Request $request, $productId)  //اضافه کردن محصول به سبد خرید
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $existing = CartItem::where('user_id', Auth::id())
            ->where('product_id', $productId)
            ->first();

        if ($existing) {
            $existing->update(['quantity' => $existing->quantity + $request->quantity]);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $productId,
                'quantity' => $request->quantity,
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

    public function checkout()  //بررسی سبد و آدرس، ساخت سفارش و ثبت اقلام آن
    {
        $cartItems = CartItem::where('user_id', Auth::id())
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'سبد خرید خالی است.');
        }

        $address = Auth::user()->address;

        if (!$address) {
            return back()->with('error', 'لطفاً ابتدا آدرس خود را ثبت کنید.');
        }

        $subtotal = $cartItems->sum(fn($item) => $item->quantity * $item->product->price);

        $shippingCost = 50000;
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'user_id' => Auth::id(),
            'address_id' => $address->id,
            'shipping_cost' => $shippingCost,
            'total_price' => $total,
            'status' => 'pending',
            'ordered_at' => now(),
        ]);

        foreach ($cartItems as $item) {
            $order->orderItems()->create([
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
            ]);
        }

        CartItem::where('user_id', Auth::id())->delete();

        return redirect('/orders')->with('success', 'پرداخت با موفقیت انجام شد.');
    }
}
