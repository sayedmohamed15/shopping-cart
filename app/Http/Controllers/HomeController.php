<?php

namespace App\Http\Controllers;

use App\Item;
use App\Cart;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('store');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalQ = Cart::selectRaw('sum(quantity) AS totalQ')->where('user_id', '=', auth()->id())->get()->toArray();
        $this->totalQty=$totalQ[0]['totalQ'];
        session()->put('cart', $this->totalQty);
        return view('home');
    }

    public function store()
    {
        $latestItems = Item::latest()->take(3)->get();

        return view('store',compact('latestItems'));

    }
}
