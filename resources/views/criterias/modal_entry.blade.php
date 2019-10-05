<!-- Modal Find ID -->
<div id="addCriterionModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Add Criteria</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['url'=>'/criteria', 'method'=>'post']) !!}
            <div class="modal-body">
                <div class='form-group'>
                    {{Form::label('criteria')}}
                    {{Form::text('criteria',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('description')}}
                    {{Form::text('description',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('max')}}
                    {{Form::number('max',null,['class'=>'form-control', 'required'])}}
                </div>
                {{Form::hidden('round_id', $round->id)}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Criteria</button>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
</div>
