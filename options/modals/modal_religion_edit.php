<div class="modal fade" id="modal_religion_edit" tabindex="-1" role="dialog" aria-labelledby="modalEditReligion" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditReligion"><strong>Edit Religion</strong></h5>
            </div>
            <form action="javascript:void(0);" method="post">
                <input type="hidden" name="religion_id" id="religion_id" required>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="edit_txt_religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="edit_txt_religion" required value="" name="religion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_update_religion">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>