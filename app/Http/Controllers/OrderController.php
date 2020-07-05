<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()->orders->toArray();

//        dd($orders);
        return view('order.index')->with('orders', $orders);

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
         $request->validate([
            'total' => 'required',
            'address' => 'required|string',
            'tel' => 'required|max:13',
        ]);
        if($request->total <= auth()->user()->store_credit){
            $orderData = [
                'user_id'=>auth()->id(),
                'total'=>$request->total,
                'address'=>$request->address,
                'telephone'=>$request->tel
            ];
            Order::firstOrCreate($orderData);
            Cart::where(['user_id'=>auth()->id()])->delete();
            session()->forget('cart');
            return redirect()->route('items.index')->with('success', 'Payment Done successfully ');


        }else{
//            return redirect()->route('cart.index')->with('success', 'Cart was deleted');
            return redirect()->route('cart.index')->with('faild', 'Your Credit not enough ');


        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }


    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'total' => 'required',
            'address' => 'required|string',
            'tel' => 'required|max:13',
        ]);
    }
}
