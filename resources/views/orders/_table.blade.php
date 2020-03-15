<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Партнер</th>
        <th scope="col">Стоимость</th>
        <th scope="col">Состав</th>
        <th scope="col">Статус</th>
        <th scope="col">Доставка</th>
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
            <td>{{$order->partner->getName()}}</td>
            <td>{{$order->getSum()}}</td>
            <td>
                @foreach($order->products as $product)
                    <p>{{$product->getName()}} = {{$product->pivot->quantity}} шт.</p>
                @endforeach
            </td>
            <td>{{$order->getStatus()}}</td>
            <td>{{$order->getDeliveryTime()}}</td>
        </tr>
    @empty
        <tr><td>Заказов нет</td></tr>
    @endforelse
    </tbody>
</table>