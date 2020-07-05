<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartCollection;
use Illuminate\Http\Request;
use App\Http\Resources\Cart as CartResource;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new CartCollection(Cart::where(['user_id'=>1])->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //        return response()->json([],201);
        $data =$request->validate([
            'item_id' => 'required|integer',
            'user_id' => 'required|integer',
            'quantity' => 'required|integer',
        ]);
        $product=Cart::firstOrCreate($data);
//        return redirect($product->path());
        return response()->json(new CartResource($product),201);


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $cart=Cart::findOrfail($id);
//        $data = $this->validateRequest($request);
//        $cart=$cart->update($data);
        $cart->update([
            'quantity'=>$request->quantity,

        ]);
        return response()->json(new CartResource($cart));


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $cart=Cart::findOrfail($id);
        $cart->delete();
        return response()->json(null,204);


    }
}
