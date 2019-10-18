<!-- Modal Find ID -->
<div id="deleteRoundModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left">Delete Round?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                {{Form::open(['url'=>"/round", 'method'=>'delete'])}}

                <div class="modal-body">
                    <input type="hidden" name="id" id="round_id" value="">
                    Are you sure you want to delete this round? <br>
                    <strong id="round_name"></strong>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="submit">Delete</button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                </div>

                {{Form::close()}}

            </div>
        </div>
    </div>
