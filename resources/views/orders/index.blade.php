@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components.message')
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Партнер</th>
                        <th scope="col">Стоимость</th>
                        <th scope="col">Состав</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>

                    @forelse($orders as $order)
                        <tr>
                            <th scope="row">
                                <a href="{{route('orders.edit', $order->getId())}}" target="_blank">
                                    {{$order->getId()}}
                                </a>
                            </th>
                            <td>{{$order->partner->name}}</td>
                            <td>{{$order->getSum()}}</td>
                            <td>
                                @foreach($order->products as $product)
                                    <p>{{$product->name}} = {{$product->pivot->quantity}} шт.</p>
                                @endforeach
                            </td>
                            <td>{{$order->getStatus()}}</td>
                        </tr>
                    @empty
                        <tr>Заказов нет</tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
