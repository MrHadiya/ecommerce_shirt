<?php
    $editCatInfo = ($edit_categoryData['status'] == 'true' && count($edit_categoryData['data']) > 0 ) ? $edit_categoryData['data'][0] :  '';
?>
<!--<div class="modal fade" id="modal-addCategory">-->
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmEditCategory" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/category/editCategory" id="frmEditCategory">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Edit Category</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Category Name*</label>
                            <input type="text" name="categoryName" value="<?php echo (isset($editCatInfo->category_name)) ? $editCatInfo->category_name : ""; ?>" placeholder="Category Name" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-6">
                        <?php $statusArray = array('1'=>'Active', '2'=>'Inactive'); ?>
                            <label>Status*</label>
                            <select name="status" required class="form-control">
                            <?php
                                foreach( $statusArray as $key => $value ) {
                                    if( $key == $editCatInfo->status ) {
                                        echo '<option value="'.$key.'" selected>'.$value.'</option>';
                                    }
                                    else {
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="categoryId" value="<?php echo($editCatInfo->category_id); ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnEditCategory" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
<!--</div>-->
