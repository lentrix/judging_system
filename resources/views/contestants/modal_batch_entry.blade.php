<div id="batchAddContestantModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Add a Batch of Contestants</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['url'=>'/contestant/batch', 'method'=>'post']) !!}
            <div class="modal-body">

                <div class='form-group'>
                    {{Form::label('name','Generic Name')}}
                    {{Form::text('name',null,['class'=>'form-control'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('number')}}
                    {{Form::text('number',null,['class'=>'form-control'])}}
                </div>
                {{Form::hidden('round_id', $round->id)}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Contestants</button>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
</div>
