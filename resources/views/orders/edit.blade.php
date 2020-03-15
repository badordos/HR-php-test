@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                @include('components.errors')
                <h2>Редактирование заказа №{{$order->getId()}}</h2>
                <form action="{{route('orders.update', $order)}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email клиента</label>
                        <input type="email" class="form-control" id="exampleFormControlInput1"
                               placeholder="name@example.com"
                               name="client_email" value="{{$order->getClientEmail()}}">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Партнер</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="partner">
                            @foreach($partners as $partner)
                                <option value="{{$partner->getId()}}"
                                        @if($partner->getId() === $order->getPartnerId()) selected @endif>
                                    {{$partner->getName()}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <h4>Продукты</h4>
                    @foreach($order->products as $product)
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{$product->getName()}}, количество:</label>
                            <input type="number" class="form-control" id="exampleFormControlInput1"
                                   name="products[{{$product->getId()}}][quantity]" value="{{$product->pivot->quantity}}">
                            <input type="hidden" name="products[{{$product->getId()}}][price]" value="{{$product->getPrice()}}">
                        </div>
                    @endforeach
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Статус</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="status">
                            @foreach($statuses as $key => $status)
                                <option value="{{$key}}"
                                        @if($status === $order->getStatus()) selected @endif>
                                    {{$status}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Стоимость</label>
                        {{$order->getSum()}}
                    </div>
                    <button type="submit" class="btn btn-primary">Обновить данные</button>
                </form>
            </div>
        </div>
    </div>
@endsection
