@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Заказы</h2>
                @include('components.message')

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#all">Все</a></li>
                    <li><a data-toggle="tab" href="#overdue">Просроченные</a></li>
                    <li><a data-toggle="tab" href="#current">Текущие</a></li>
                    <li><a data-toggle="tab" href="#new">Новые</a></li>
                    <li><a data-toggle="tab" href="#done">Законченные</a></li>
                </ul>

                <div class="tab-content">
                    <div id="all" class="tab-pane fade in active">
                        @include('orders._table', ['orders' => $allOrders])
                    </div>
                    <div id="overdue" class="tab-pane fade">
                        @include('orders._table', ['orders' => $overdueOrders])
                    </div>
                    <div id="current" class="tab-pane fade">
                        @include('orders._table', ['orders' => $currentOrders])
                    </div>
                    <div id="new" class="tab-pane fade">
                        @include('orders._table', ['orders' => $newOrders])
                    </div>
                    <div id="done" class="tab-pane fade">
                        @include('orders._table', ['orders' => $doneOrders])
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
