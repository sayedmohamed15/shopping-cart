@extends('layouts.app')


@section('content')



    <div class="container">
        <div class="row">
            @if($orders)
                <div class="col-md-9">
                    <div class="card mb-3">
                        <div class="card-body">

                            <table class="table table-striped mt-2 mb-2">
                                <thead>
                                <tr>

                                    <th scope="col">#ID</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Telephone</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">status</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{$total=0}}
                                @foreach($orders as $order)
                                    <tr>

                                        <td>{{$order['id'] }}</td>
                                        <td>{{$order['address'] }}</td>
                                        <td>{{$order['telephone'] }}</td>
                                        <td>$ {{$order['total'] }}</td>
                                        <td> Paid</td>
                                    </tr>
                                    {{$total +=$order['total'] }}
                                @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                <p class="badge badge-pill badge-info mb-4 p-4 text-white"><strong>Total Price : $ {{$total}}</strong></p>
            </div>
            @else
                <p>There are no Orders yet</p>
            @endif
        </div>
    </div>

@endsection
