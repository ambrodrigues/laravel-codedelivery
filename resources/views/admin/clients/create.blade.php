@extends('app')

@section('content')

    <div class="container">
        <h3>Novo Cliente</h3>

        {!! Form::open(['route'=>'admin.clients.store']) !!}

        @include('admin.clients._form')

        {!! Form::close() !!}
    </div>

@endsection