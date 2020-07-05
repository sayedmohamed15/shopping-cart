<?php

namespace App\Http\Controllers;

//use App\CartSession;
use App\Item;
use App\Cart;
use App\User;
use Illuminate\Http\Request;
//use Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public $totalQty ;
    public $totalPrice;


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userCart= User::find(auth()->id())->cartsInfo()->get()->toArray();
        if(!empty($userCart)){
            $cart['items'] = $userCart;
            foreach ($cart['items'] as $itemValue){
                $this->totalQty += $itemValue['pivot']['quantity'];
                $this->totalPrice +=$itemValue['price'] * $itemValue['pivot']['quantity'];
            }
            $cart['totalPrice']=$this->totalPrice;
            $cart['totalQty']=$this->totalQty;
            $this->getTotalQuantity();
        } else {
            $cart = null;
        }



        return view('cart.index', compact('cart'));
//
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
    public function store(Item $item)
    {
       $qty = 1;
       $condition = array('user_id'=>auth()->id(),'item_id'=>$item->id);

        $cart = Cart::where($condition)->first();
        if ($cart !=null) {

            Cart::where($condition)->update(['quantity'=>$cart->quantity+1]);

        }else{
            $itemData = array('user_id'=>auth()->id(),'item_id'=>$item->id,'quantity'=>$qty);
            Cart::firstOrCreate($itemData);
        }

        $this->getTotalQuantity();


        return redirect()->route('items.index')->with('success', 'Product was added');



    }

    public function getTotalQuantity(){
        $totalQ = Cart::selectRaw('sum(quantity) AS totalQ')->where('user_id', '=', auth()->id())->get()->toArray();
        $this->totalQty=$totalQ[0]['totalQ'];
        session()->put('cart', $this->totalQty);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CartSession  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CartSession  $cart
     * @return \Illuminate\Http\Response
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CartSession  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1|max:500'
        ]);

        Cart::find($cart->id)->update(['quantity'=>$request->qty]);


      $this->getTotalQuantity();
        return redirect()->route('cart.index')->with('success', 'Cart updated');
    }

    public function checkout($amount)
    {

        return view('cart.checkout', compact('amount'));
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CartSession  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        Cart::destroy($cart->id);
        $this->getTotalQuantity();
        return redirect()->route('cart.index')->with('success', 'Cart was deleted');
    }
}
