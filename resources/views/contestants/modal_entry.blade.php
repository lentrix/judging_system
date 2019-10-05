<div id="addContestantModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Add Contestant</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['url'=>'/contestant', 'method'=>'post']) !!}
            <div class="modal-body">
                <div class='form-group'>
                    {{Form::label('name')}}
                    {{Form::text('name',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('details')}}
                    {{Form::text('details',null,['class'=>'form-control'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('remarks')}}
                    {{Form::text('remarks',null,['class'=>'form-control'])}}
                </div>
                {{Form::hidden('round_id', $round->id)}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add Contestant</button>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
</div>
