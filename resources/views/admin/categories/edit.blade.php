@extends('app')

@section('content')

    <div class="container">
        <h3>Editando Categoria {{$category->name}}</h3>

        {!! Form::model($category,['route'=>['admin.categories.update',$category->id]]) !!}

        @include('admin.categories._form')

        {!! Form::close() !!}
    </div>

@endsection