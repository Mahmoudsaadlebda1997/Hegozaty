<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a listing of the users
    public function index()
    {
        $active ='orders';
        $orders = Order::paginate(5);
        return view('admin.orders.index', compact('orders','active'));
    }

    // Display the specified user
    public function show(Order $order)
    {
        $active ='orders';
        return view('admin.orders.show', compact('order','active'));
    }
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:paid,cancelled,pending,delivered',
        ]);

        $order->status = $request->input('status');
        $order->save();

        return redirect()->route('orders.show', $order->id)->with('success', 'تم تحديث حالة الاوردر بنجاح');
    }

    // Remove the specified user from the database
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('categories.index')->with('success', 'تم مسح الاوردر بنجاح');
    }
}
