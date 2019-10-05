

<div class="form-group">
    {{Form::label('title')}}
    {{Form::text('title', null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('schedule')}}
    {{Form::text('schedule', null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    {{Form::label('venue')}}
    {{Form::text('venue', null, ['class'=>'form-control'])}}
</div>

<div class="form-group">
    <button class="btn btn-primary float-right" type="submit">Save Contest</button>
</div>



