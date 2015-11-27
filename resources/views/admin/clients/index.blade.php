@extends('app')

@section('content')

    <div class="container">
        <h3>Clientes</h3>

        <a href="{{route('admin.clients.create')}}" class="btn btn-default">Novo Cliente</a>

        
        <table class="table">
            <thead>
            <th>ID</th>
            <th>Nome</th>
            <th>Acao</th>
            </thead>
            <tbody>
            @foreach($clients as $client)
             <tr>
                 <td>{{$client->id}}</td>
                 <td>{{$client->user->name}}</td>
                 <td><a href="{{route('admin.clients.edit',['id'=>$client->id])}}" class="btn btn-default btn-sm">Editar</a> </td>
             </tr>
            @endforeach
            </tbody>
        </table>
        {!! $clients->render() !!}

    </div>

@endsection