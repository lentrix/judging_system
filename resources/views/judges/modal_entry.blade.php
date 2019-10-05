<!-- Modal Find ID -->
<div id="addJudgeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Add Judge</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                {!! Form::open(['url'=>'/judge', 'method'=>'post']) !!}
                <div class='form-group'>
                    {{Form::label('name')}}
                    {{Form::text('name',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('username')}}
                    {{Form::text('username',null,['class'=>'form-control', 'required'])}}
                </div>
                <div class='form-group'>
                    {{Form::label('password')}}
                    {{Form::password('password',['class'=>'form-control', 'required'])}}
                </div>
                {{Form::hidden('contest_id', $contest->id)}}
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Add New Judge</button>
                </div>
                {!! Form::close() !!}

                <hr>

                {!! Form::open(['url'=>'/judge', 'method'=>'patch']) !!}
                <div class="form-group">
                    {{Form::label("user_id","Add Existing Judge")}}
                    {{Form::select('user_id',\App\User::list(),null,['class'=>'form-control','placeholder'=>'Select judge'])}}
                </div>
                {{Form::hidden('contest_id', $contest->id)}}
                <div class="form-group">
                    <button class="btn btn-primary">Add Existing Judge</button>
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

            </div>
            </form>
        </div>
    </div>
</div>
