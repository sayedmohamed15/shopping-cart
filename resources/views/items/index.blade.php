@extends('layouts.app')

@section('content')

    <div class="container">
        <section>
            @if( session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
            @endif
            @if( session()->has('faild'))
                <div class="alert alert-success">{{ session()->get('faild') }}</div>
            @endif
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">{{$item->description}}.</p>
                                <p><strong> $ {{ $item->price }}</strong></p>
                                <a href="{{route('cart.store',$item->id)}}" class="btn btn-primary">Buy</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

@endsection
