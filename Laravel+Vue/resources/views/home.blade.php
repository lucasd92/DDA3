@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Dispositivos registrados:</h4></div>

                <div class="card-body">
                    <lista-disp /> 
                </div>
            </div>
        </div>

        <div class="col-md-8 m-1">
            <lista-log />
        </div>

        <div class="col-md-8 m-1">
            <graficos />
        </div>

        <div class="col-md-8 m-1">
            <div class="card">
                <div class="card-header"><h4>Dispositivos No registrados:</h4></div>
                <div class="card-body">
                    <lista-disp-inac />
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
