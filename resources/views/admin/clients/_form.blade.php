<div class="form-group">
    {!!Form::label('Name','Nome') !!}
    {!!Form::text('user[name]',null,['class'=>'form-control']) !!}

</div><div class="form-group">
    {!!Form::label('Email','Email') !!}
    {!!Form::text('user[email]',null,['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit('Salvar', ['class'=>'btn btn-primary']) !!}
</div>