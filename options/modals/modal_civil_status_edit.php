<div class="modal fade" id="modal_civil_status_edit" tabindex="-1" role="dialog" aria-labelledby="modalEditCivilStatus" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditCivilStatus"><strong>Edit Civil Status</strong></h5>
            </div>
            <form action="javascript:void();" method="post">
                <input type="hidden" name="civil_status" id="civil_status_id" required>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="edit_txt_civil_status" class="form-label">Civil Status</label>
                            <input type="text" class="form-control" id="edit_txt_civil_status" required value="" name="civil_status">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_update_civil_status">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>