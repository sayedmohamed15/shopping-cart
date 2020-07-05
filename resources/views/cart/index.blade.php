@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row">
            @if($cart['items'])
                <div class="col-md-8">
                    @if( session()->has('faild'))
                        <div class="alert alert-success">{{ session()->get('faild') }}</div>
                    @endif
                    @foreach( $cart['items'] as $item)
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">
                                    {{ $item['name'] }}
                                </h5>
                                <div class="card-text">
                                    ${{ $item['price'] }}
                                    <form action="{{ route('cart.update',$item['pivot']['id'])}}" method="post">
                                        @csrf
                                        @method('put')
                                        <input type="text" name="qty" id="qty" value={{$item['pivot']['quantity']}}>
                                        <button type="submit" class="btn btn-secondary btn-sm">Change</button>

                                    </form>

                                    <form action="{{ route('cart.delete',$item['pivot']['id'] )}}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm ml-4 float-right" style="margin-top: -30px;">Remove</button>


                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <p><strong>Total : ${{$cart['totalPrice']}}</strong></p>

                </div>

                <div class="col-md-4">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h3 class="card-titel">
                                Your Cart
                                <hr>
                            </h3>
                            <div class="card-text">
                                <p>
                                    Total Amount is ${{$cart['totalPrice']}}
                                </p>
                                <p>
                                    Total Quantities is {{$cart['totalQty']}}
                                </p>
{{--                                <a href="{{ route('cart.checkout', $cart->totalPrice)}}" class="btn btn-info">Checkout</a>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="summary-footer">
                   <div class="container">
                       <a href="{{ route('items.index')}}" class="btn btn-info"> <span class="label ">Continue Shopping</span></a>
                       <a href="{{ route('cart.checkout',$cart['totalPrice'])}}" class="btn btn-info">  <span class="label ">Continue to Checkout</span></a>
                   </div>
                </div>
            @else
                <p>There are no items in the cart</p>

            @endif
        </div>
    </div>

@endsection
