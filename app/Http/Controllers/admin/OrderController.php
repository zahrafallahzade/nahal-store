<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller{

    public function index()  //نمایش فهرست سفارش ها
    {
        $orders = Order::with(['user', 'orderItems.product'])
            ->whereNotIn('status', ['delivered', 'cancelled'])->latest()->get();

        return view('admin.orders', compact('orders'));
    }

    public function show($id){   //نمایش جزئیات یک سفارش

        $order = Order::with(['user', 'orderItems.product'])->findOrFail($id);

        return view('admin.order-detail', compact('order'));
    }

    public function bulkUpdate(Request $request){  //تغییر وضعیت جند سفارش

        $request->validate([
            'order_ids' => 'required|array',
            'status' => 'required|string',
        ]);

        Order::whereIn('id', $request->order_ids)->update(['status' => $request->status]);

        return redirect('/admin/orders');
    }
}
