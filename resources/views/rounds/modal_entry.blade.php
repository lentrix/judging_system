<!-- Modal Find ID -->
<div id="addRoundModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Find ID Number</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['url'=>'/round', 'method'=>'post']) !!}
            <div class="modal-body">
                <div class='form-group'>
                    {{Form::label('name')}}
                    {{Form::text('name',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('description')}}
                    {{Form::text('description',null,['class'=>'form-control', 'required'])}}
                </div>
                {{Form::hidden('contest_id', $contest->id)}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Round</button>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
</div>
