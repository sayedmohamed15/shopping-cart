@extends('layouts.app')

@section('content')

   <div class="container">
       <div class="section">
           <div class="jumbotron">
               <h1 class="display-4">Hello, world!</h1>
               <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
               <hr class="my-4">
               <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
               <a class="btn btn-primary btn-lg" href="{{route('items.index')}}" role="button">More Items</a>
           </div>
       </div>
       <section>
           <div class="row">
               @foreach($latestItems as $item)
                   <div class="col-md-4">
                       <div class="card">
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
