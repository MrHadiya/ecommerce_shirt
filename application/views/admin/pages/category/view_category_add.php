<div class="modal fade" id="modal-addCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmAddCategory" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/category/addCategory" id="frmAddCategory">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Add Category</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Category Name*</label>
                            <input type="text" name="categoryName" placeholder="Category Name" required class="form-control" />
                        </div>
                    </div>
<!--                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Image</label>
                            <input type="file" name="categoryImage" class="form-control" />
                        </div>
                    </div>-->
                    <div class="row col-12">
                        <div class="form-group col-6">
                            <label>Status*</label>
                            <select name="status" required class="form-control">
                                <option value="">Select Status </option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnAddCategory" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
