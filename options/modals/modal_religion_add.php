<div class="modal fade" id="modal_religion_add" tabindex="-1" role="dialog" aria-labelledby="modalAddReligion" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddReligion"><strong>Add Religion</strong></h5>
            </div>
            <form action="javascript:void(0);" method="post">
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-12">
                            <label for="txt_religion" class="form-label">Religion</label>
                            <input type="text" class="form-control" id="txt_religion" required value="" name="religion">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" id="btn_close_modal" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn_add_religion">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>