@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Продукты</h2>

                <!-- Modal -->
                <div class="modal fade" id="priceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Редактировать цену продукта</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="update_form">
                                    <p id="product_name"></p>
                                    <input type="number" id="product_price" value="">
                                    <input type="hidden" id="product_id" value="">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button id="update_price" type="button" class="btn btn-primary">Обновить</button>
                            </div>
                        </div>
                    </div>
                </div>

                @include('components.message')
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Наименование</th>
                        <th scope="col">Поставщик</th>
                        <th scope="col">Цена</th>
                        <th scope="col">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td>{{$product->getId()}}</td>
                            <td>{{$product->getName()}}</td>
                            <td>{{$product->vendor->getName()}}</td>
                            <td id="{{$product->getId()}}">
                                {{$product->getPrice()}}
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm edit-price"
                                        data-toggle="modal" data-target="#priceModal"
                                        data-id="{{$product->getId()}}" data-name="{{$product->getName()}}"
                                        data-price="{{$product->getPrice()}}" id="btn_{{$product->getId()}}">
                                    Редактировать
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>Продуктов нет</tr>
                    @endforelse
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
