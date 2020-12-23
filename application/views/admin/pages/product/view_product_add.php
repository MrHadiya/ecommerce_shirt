<div class="modal fade" id="modal-addProduct">
    <div class="modal-dialog modal-xl" style="max-width:80%">
        <div class="modal-content">
            <form name="frmAddProduct" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/product/addProduct" id="frmAddProduct">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Add Product</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Product Name*</label>
                            <input type="text" name="productName" placeholder="Product Name" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12 col-sm-3">
                        <?php
                            $CI = &get_instance();
                            $res_productCode = $CI->generateProductCode();
                        ?>
                            <label>Product Code*</label>
                            <input type="text" name="productCode" value="<?php echo (isset($res_productCode)) ? trim($res_productCode) : ""; ?>" placeholder="Product Code" required class="form-control" />
                        </div>
                        <div class="form-group col-6 col-sm-3">
                        <?php
                            $CI = &get_instance();
                            $res_category_list = $CI->getCategoryByValue(array('status'=>'1'));
                            $category_list = json_decode($res_category_list, true);
                        ?>
                            <label>Category*</label>
                            <select name="category" required class="form-control">
                            <?php
                                if( $category_list['status'] == 'true' && count($category_list['data']) > 0 ) {
                                    echo '<option value="" selected> -- select -- </option>';
                                    foreach( $category_list['data'] as $key => $value ) {
                                        echo '<option value="'.$value['category_id'].'">'.$value['category_name'].'</option>';
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
                            $CI = &get_instance();
                            $res_size_list = $CI->getSizeByValue(array('status'=>'1'));
                            $size_list = json_decode($res_size_list, true);
                        ?>
                            <label>Select Sizes*</label>
                            <select name="sizes[]" required id="example-multiselect-fallback" class="form-control" multiple="multiple">
                            <?php
                                if( $size_list['status'] == 'true' && count($size_list['data']) > 0 ) {
                                    //echo '<option value="" selected> -- select -- </option>';
                                    foreach( $size_list['data'] as $key => $value ) {
                                        echo '<option value="'.$value['size_id'].'">'.$value['size_name'].'</option>';
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
                            <?php
                                if( $color_list['status'] == 'true' && count($color_list['data']) > 0 ) {
                                    echo '<option value="" selected> -- select -- </option>';
                                    foreach( $color_list['data'] as $key => $value ) {
                                        echo '<option style="color:'.$value['color_code'].' ;" value="'.$value['color_id'].'">'.$value['color_name'].' ( '.$value['color_code'].' )</option>';
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
                            <input type="text" name="mrp" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label>Product SP*</label>
                            <input type="text" name="sp" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label>Stock*</label>
                            <input type="text" name="stock" placeholder="xxxxx" required class="form-control" />
                        </div>
                        <div class="form-group col-12 col-sm-3">
                            <label>Status*</label>
                            <select name="status" required class="form-control">
                                <option value="">Select Status </option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12 col-sm-3">
                            <label>Product Image</label>
                            <div class="imageOuter">
                                <div class="productImage"></div>
                                <img src="../uploads/images/other/photo.png"  class="image-choose-icon" />
                                <div class="image-choose-icon">
                                    <input type="file" name="image" id="productImage" accept="image/*" class="rounded inpt-img" onChange="showPreviewImage(this);" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-9">
                            <label>Description</label>
                            <textarea name="description" class="textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnAddProduct" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
</div>
