<?php
    $editProductInfo = ($edit_productData['status'] == 'true' && count($edit_productData['data']) > 0 ) ? $edit_productData['data'][0] :  '';
?>
<!--<div class="modal fade" id="modal-addProduct">-->
    <div class="modal-dialog modal-xl" style="max-width:80%">
        <div class="modal-content">
            <form name="frmEditProduct" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/product/editProduct" id="frmEditProduct">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Edit Product</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Product Name*</label>
                            <input type="text" name="productName" value="<?php echo (isset($editProductInfo->product_name)) ? $editProductInfo->product_name : ""; ?>" placeholder="Product Name" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12 col-sm-3">
                        <?php
                            $CI = &get_instance();
                            $res_productCode = $CI->generateProductCode();
                        ?>
                            <label>Product Code*</label>
                            <input type="text" name="productCode" value="<?php echo (isset($editProductInfo->product_code)) ? $editProductInfo->product_code : ""; ?>" readonly placeholder="Product Code" required class="form-control" />
                        </div>
                        <div class="form-group col-6 col-sm-3">
                        <?php
                            $CI = &get_instance();
                            $res_category_list = $CI->getCategoryByValue(array('status'=>'1'));
                            $category_list = json_decode($res_category_list, true);
                        ?>
                            <label>Category*</label>
                            <select name="category" required class="form-control">
                                <option value="<?php echo isset($editProductInfo->category_id) ? $editProductInfo->category_id : ''; ?>" selected><?php echo $editProductInfo->category_name; ?></option>
                            <?php
                                if( $category_list['status'] == 'true' && count($category_list['data']) > 0 ) {
                                    //echo '<option value="" selected> -- select -- </option>';
                                    foreach( $category_list['data'] as $key => $value ) {
                                        if( $value['category_id'] != $editProductInfo->category_id ) {
                                            echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
                                        }
                                    }
                                }
                                else {
                                    echo '<option value="" selected>'.$category_list['message'].'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-3 multibtngroup">
                        <?php
                            $edit_sizeIds = (isset($editProductInfo->size_ids)) ? $editProductInfo->size_ids : "";
                            $edit_sizeIdsArray = ( !empty($edit_sizeIds) ) ? explode(',', $edit_sizeIds) : '';
                            
                            $CI = &get_instance();
                            $res_size_list = $CI->getSizeByValue(array('status'=>'1'));
                            $size_list = json_decode($res_size_list, true);
                        ?>
                            <label>Select Sizes*</label>
                            <select name="sizes[]" required id="edit-multiselect-size" class="form-control" multiple="multiple">
                            <?php
                                if( $size_list['status'] == 'true' && count($size_list['data']) > 0 ) {
                                    //echo '<option value="" selected> -- select -- </option>';
                                    foreach( $size_list['data'] as $key => $value ) {
                                        if(in_array($value['size_id'], $edit_sizeIdsArray)) {
                                            echo '<option value="'.$value['size_id'].'" selected>'.$value['size_name'].'</option>';
                                        }
                                        else {
                                            echo '<option value="'.$value['size_id'].'">'.$value['size_name'].'</option>';
                                        }
                                    }
                                }
                                else {
                                    echo '<option value="" selected>'.$size_list['message'].'</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-3">
                        <?php
                            $CI = &get_instance();
                            $res_color_list = $CI->getColorByValue(array('status'=>'1'));
                            $color_list = json_decode($res_color_list, true);
                        ?>
                            <label>Select Color Colde*</label>
                            <select name="color" required class="form-control">
                                <option value="<?php echo isset($editProductInfo->color_id) ? $editProductInfo->color_id : ''; ?>" selected><?php echo $editProductInfo->color_code; ?></option>
                            <?php
                                if( $color_list['status'] == 'true' && count($color_list['data']) > 0 ) {
                                    //echo '<option value="" selected> -- select -- </option>';
                                    foreach( $color_list['data'] as $key => $value ) {
                                        if( $value['color_id'] != $editProductInfo->color_id ) {
                                            echo '<option value="'.$value['color_id'].'">'.$value['color_code'].'</option>';
                                        }
                                    }
                                }
                                else {
                                    echo '<option value="" selected>'.$color_list['message'].'</option>';
                                }
                            ?>
                            </select>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12 col-sm-3">
                            <label>Product MRP*</label>
                            <input type="text" name="mrp" value="<?php echo (isset($editProductInfo->mrp)) ? $editProductInfo->mrp : ""; ?>" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label>Product SP*</label>
                            <input type="text" name="sp" value="<?php echo (isset($editProductInfo->sp)) ? $editProductInfo->sp : ""; ?>" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label>Stock*</label>
                            <input type="text" name="stock" value="<?php echo (isset($editProductInfo->stock)) ? $editProductInfo->stock : ""; ?>" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                        <?php $statusArray = array('1'=>'Active', '2'=>'Inactive'); ?>
                            <label>Status*</label>
                            <select name="status" required class="form-control">
                            <?php
                                foreach( $statusArray as $key => $value ) {
                                    if( $key == $editProductInfo->status ) {
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
                    <div class="row col-12">
                        <div class="form-group col-12 col-sm-3">
                        <?php
                            $edit_productImg = (isset($editProductInfo->image)) ? $editProductInfo->image : "";
                            $edit_productImgArray = ( !empty($edit_productImg) ) ? explode('/', $edit_productImg) : '';
                            $editImageName = ( count($edit_productImgArray) > 0 ) ? end($edit_productImgArray) : '';
                        ?>
                            <label>Product Image</label>
                            <div class="imageOuter">
                                <div class="edit-productImage">
                                    <img src="<?php echo '../'.$edit_productImg; ?>" width="80%" height="100px" class="upload-preview" />
                                </div>
                                <img src="../uploads/images/other/photo.png"  class="image-choose-icon" />
                                <div class="image-choose-icon">
                                    <input type="file" name="image" value="<?php echo (isset($editImageName)) ? $editImageName : ""; ?>" id="edit-productImage" accept="image/*" class="rounded inpt-img" onChange="showPreviewImage(this);" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-9">
                            <label>Description</label>
                            <textarea name="description" class="edit-textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                <?php echo (isset($editProductInfo->description)) ? $editProductInfo->description : ""; ?>
                            </textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <input type="hidden" name="productId" value="<?php echo($editProductInfo->product_id); ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnEditProduct" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
<!--</div>-->
<script>
    $(function () {
        $('.edit-textarea').summernote()
    });
    $(document).ready(function() {
        $('#edit-multiselect-size').multiselect({
            includeSelectAllOption: true
            //selectedClass: "active multiselect-active-item-fallback"
        });
    });
</script>
