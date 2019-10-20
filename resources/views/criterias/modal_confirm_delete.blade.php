<!-- Modal Find ID -->
<div id="confirmDeleteCriteriaModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title float-left">Delete Criteria?</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                {!! Form::open(['url'=>'/criteria', 'method'=>'delete']) !!}
                <div class="modal-body">
                    <p>
                        Are you sure you want to delete this criteria? <br>
                        <span id="criteria_name"></span>
                    </p>
                    <input type="hidden" name="id" id="criteria_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Delete Criteria</button>
                </div>
                {!! Form::close() !!}
                </form>
            </div>
        </div>
    </div>
