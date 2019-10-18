<!-- Modal Find ID -->
<div id="deleteJudgeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Delete Judge?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            {{Form::open(['url'=>"/judge", 'method'=>'delete','style'=>'display: inline'])}}

            <div class="modal-body">
                <input type="hidden" name="id" id="contest_judge_id" value="">
                Are you sure you want to remove this judge? <br>
                <strong id="judge_name"></strong>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="submit">Delete</button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
            </div>

            {{Form::close()}}

        </div>
    </div>
</div>
