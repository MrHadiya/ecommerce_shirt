<div class="modal fade" id="modal-addBanner">
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmAddBanner" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/banner/addBanner" id="frmAddBanner">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Add Banner</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Title*</label>
                            <input type="text" name="bannerTitle" placeholder="Banner Title" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Image*</label>
<!--                            <input type="file" name="bannerImage" required class="form-control" />-->
                            <div class="imageOuter">
                                <div class="bannerImage"></div>
                                <img src="../uploads/images/other/photo.png"  class="image-choose-icon" />
                                <div class="image-choose-icon">
                                    <input type="file" name="bannerImage" accept="image/*" required id="bannerImage" class="rounded inpt-img" onChange="showPreviewImage(this);" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Link</label>
                            <input type="text" name="bannerLink" placeholder="Banner Link" class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Description</label>
                            <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-6">
                            <label>Sort Order</label>
                            <input type="number" name="sortOrder" class="form-control" />
                        </div>
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
                    <input type="submit" name="btnAddBanner" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
