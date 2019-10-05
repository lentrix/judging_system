<div class="form-group">
    {{Form::label('name')}}
    {{Form::text('name',null,['class'=>'form-control','required'])}}
</div>

<div class="form-group">
    {{Form::label('username')}}
    {{Form::text('username',null,['class'=>'form-control','required'])}}
</div>

<div class="form-group">
    {{Form::label('password')}}
    {{Form::password('password',['class'=>'form-control','required'])}}
</div>


