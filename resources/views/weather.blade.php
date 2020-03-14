@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Погода в Брянске</div>

                    <div class="panel-body">
                       <p>Температура (по цельсию): {{$data->temp}}</p>
                       <p>Ощущается как: {{$data->feels_like}}</p>
                       <p>Ветер (м/с): {{$data->wind_speed}}</p>
                       <p>Давление (мм): {{$data->pressure_mm}}</p>
                       <p>Влажность (%): {{$data->humidity}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
