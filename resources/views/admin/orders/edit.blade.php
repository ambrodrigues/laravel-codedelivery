@extends('app')

@section('content')


    <div class="container">
    <h2>Pedido #{{$order->id}} - R$ {{$order->total}}</h2>
    <h3>Cliente: {{$order->client->user->name}}</h3>
    <h4>Data: {{$order->created_at->format('d/m/Y H:i:s')}}</h4>

        <p>
            <b>Entregar em:</b> {{$order->client->address}} - {{$order->client->city}} - {{$order->client->state}}
        </p>


        <br>

        {!! Form::model($order,['route'=>['admin.orders.update',$order->id]]) !!}


        <div class="form-group">
            {!!Form::label('Status','Status:') !!}
            {!!Form::select('status',$listStatus,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!!Form::label('Entregador','Entregador:') !!}
            {!!Form::select('user_deliveryman_id',$deliveryMan,null,['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

</div>

@endsection