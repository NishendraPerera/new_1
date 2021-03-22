<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\PaymentMethod;
use App\DeliveryMethod;
use App\AdLanguage;

use Auth;
use DB;

class OrderController extends Controller
{
    public function home()
    {
        return view('order.all');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Auth::user()->role_id == 3 ? $where_array = ['users.id' => Auth::user()->id] : $where_array = [];

        $orders = Order::join('ad_languages', 'orders.ad_language_id', '=', 'ad_languages.id')
                ->join('delivery_methods', 'orders.delivery_method_id', '=', 'delivery_methods.id')
                ->join('payment_methods', 'orders.payment_method_id', '=', 'payment_methods.id')
                ->join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.id', 'ad_languages.name as language', DB::raw("DATE_FORMAT(orders.date, '%Y-%m-%d') as date"), 'users.name as user', 'delivery_methods.name as delivery_method', 'payment_methods.name as payment_method', DB::raw("FORMAT(qty,0) as qty"))
                ->where($where_array)
                ->get();

        return response()->json(array("data" => $orders))->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payment_methods = PaymentMethod::select('id', 'name')->get();
        $delivery_methods = DeliveryMethod::select('id', 'name')->get();
        $languages = AdLanguage::select('id', 'name')->get();

        return view('order.new', compact('payment_methods', 'delivery_methods', 'languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->date = $request->date;
        $order->ad_language_id = $request->language;
        $order->delivery_method_id = $request->delivery_method;
        $order->payment_method_id = $request->payment_method;
        $order->qty = $request->qty;
        $order->save();

        $request->session()->flash('success', 'New order successfully placed!');

        return "Success";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::join('users', 'orders.user_id', '=', 'users.id')
                ->select('orders.id', 'ad_language_id as language', DB::raw("DATE_FORMAT(orders.date, '%Y-%m-%d') as date"), 'users.name as user', 'delivery_method_id as delivery_method', 'payment_method_id as payment_method', DB::raw("FORMAT(qty,0) as qty"))
                ->where('orders.id', $id)
                ->first();

        $payment_methods = PaymentMethod::select('id', 'name')->get();
        $delivery_methods = DeliveryMethod::select('id', 'name')->get();
        $languages = AdLanguage::select('id', 'name')->get();

        return view('order.edit', compact('payment_methods', 'delivery_methods', 'languages', 'order'));
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
        $order->date = $request->date;
        $order->ad_language_id = $request->language;
        $order->delivery_method_id = $request->delivery_method;
        $order->payment_method_id = $request->payment_method;
        $order->qty = $request->qty;
        $order->save();

        $request->session()->flash('success', 'Order successfully edited!');

        return "Success";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Order::where('id', $request->id)->delete();

        $request->session()->flash('warning', 'Order successfully deleted!');

        return "Success";
    }
}
