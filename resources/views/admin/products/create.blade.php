@extends('app')

@section('content')

    <div class="container">
        <h3>Novo Produto</h3>

        {!! Form::open(['route'=>'admin.products.store']) !!}

        @include('admin.products._form')

        {!! Form::close() !!}
    </div>

@endsection