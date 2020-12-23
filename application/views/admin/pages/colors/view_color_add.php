<div class="modal fade" id="modal-addColor">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmAddColor" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/colors/addColor" id="frmAddColor">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Add Color</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Select Color*</label>
<!--                            <input type="text" name="colorCode" placeholder="Color Code" required class="form-control" />-->
                            <input type="color" name="colorCode" id="favcolor" required name="favcolor" value="#000000" style="height: 45px; width: 100px">
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Color Name*</label>
                            <input type="text" name="colorName" id="colorName" placeholder="Color Name" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-6">
                            <label>Status*</label>
                            <select name="status" required  class="form-control">
                                <option value="">Select Status </option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnAddColor" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
