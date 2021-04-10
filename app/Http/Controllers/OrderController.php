<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Session;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('backend.order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('backend.order.show')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order_details = OrderDetail::where('order_id', $order->id)->get();
        // foreach ($order_details as $order_detail) {
        //     $attribute = Attribute::find($order_detail->attribute_id);
        //     $attribute->qty = $attribute->qty - $order_detail->qty;
        //     $attribute->save();
        // }
        $order->status = 2;
        $order->save();

        Session::flash('success', 'Chuyển trạng thái đơn hàng thành công!');

        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        OrderDetail::where('order_id', $order->id)->delete();
        $order->delete();

        Session::flash('success', 'Xóa đơn hàng thành công!');
        
        return redirect()->route('orders.index');
    }
}
