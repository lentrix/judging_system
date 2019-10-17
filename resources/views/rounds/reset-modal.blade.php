<!-- Modal Find ID -->
<div id="resetRoundModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left">Add Round</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                {!! Form::open(['url'=>"/round/reset", 'method'=>'post']) !!}
                <div class="modal-body">
                    <strong>Warning!!!</strong><br>
                    <p>Resetting a round will delete all the scores from all the
                    judges and contestants from this round.</p>
                    <p>Are your sure about resetting this round?</p>
                    {{Form::hidden('round_id', $round->id)}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reset Round</button>
                </div>
                {!! Form::close() !!}
                </form>
            </div>
        </div>
    </div>
