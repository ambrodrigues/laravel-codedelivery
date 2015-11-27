<div class="form-group">
    {!!Form::label('name','Nome') !!}
    {!!Form::text('name',null,['class'=>'form-control','id'=>'name']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
</div>