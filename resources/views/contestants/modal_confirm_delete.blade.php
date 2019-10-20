<div id="confirmDeleteContestantModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title float-left">Delete Contestant?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            {!! Form::open(['url'=>'/contestant', 'method'=>'delete']) !!}
            <div class="modal-body">
                <p>
                    Are you sure you want to delete this Contestant? <br>
                    <span id="contestant_name"></span>
                </p>
                <input type="hidden" name="id" id="contestant_id">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Delete Contestant</button>
            </div>
            {!! Form::close() !!}
            </form>
        </div>
    </div>
</div>
