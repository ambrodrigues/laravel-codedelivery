@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Produto {{$product->name}}</h3>

        {!! Form::model($product,['route'=>['admin.products.update',$product->id]]) !!}

        @include('admin.products._form')

        {!! Form::close() !!}
    </div>

@endsection