<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Attribute;
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
        foreach ($order_details as $order_detail) {
            $attribute = Attribute::find($order_detail->attribute_id);
            $attribute->qty = $attribute->qty - $order_detail->qty;
            $attribute->save();
        }
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

    public function filterOrderByDate(Request $request)
    {
        if($request->date_from && $request->date_to){
            $date_from = date('Y-m-d', strtotime($request->date_from));
            $date_to = date('Y-m-d', strtotime($request->date_to));
            $total = Order::where('status', 2) ->whereBetween('created_at',[$date_from,$date_to])->sum('total_price');
    		$orders = Order::where('status', 2)
                                ->whereBetween('created_at',[$date_from,$date_to])
                                ->paginate(10);                                
    		return view('backend.report.date',compact('orders', 'date_from', 'date_to', 'total'));
    	}
        $orders = Order::where('status', 2)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
        $total = Order::where('status', 2)->sum('total_price');
        return view('backend.report.date',compact('orders','total'));
    }
}
