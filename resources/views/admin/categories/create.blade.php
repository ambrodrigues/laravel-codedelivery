@extends('app')

@section('content')

    <div class="container">
        <h3>Nova Categorias</h3>

        {!! Form::open(['route'=>'admin.categories.store']) !!}

        @include('admin.categories._form')

        {!! Form::close() !!}
    </div>

@endsection