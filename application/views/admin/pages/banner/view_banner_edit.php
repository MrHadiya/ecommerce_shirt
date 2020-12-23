<?php
    $editBannerInfo = ($edit_bannerData['status'] == 'true' && count($edit_bannerData['data']) > 0 ) ? $edit_bannerData['data'][0] :  '';
?>
<!--<div class="modal fade" id="modal-addBanner">-->
    <div class="modal-dialog">
        <div class="modal-content">
            <form name="frmEditBanner" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/banner/editBanner" id="frmEditBanner">
                <div class="modal-header card-header">
                    <span class="modal-title m-0 font-weight-bold text-primary">Edit Banner</span>
<!--                    <h4 class="modal-title text-primary m-0">Add Color</h4>-->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Title*</label>
                            <input type="text" name="bannerTitle" value="<?php echo (isset($editBannerInfo->banner_title)) ? $editBannerInfo->banner_title : ""; ?>" placeholder="Banner Title" required class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                        <?php
                            $edit_bannerImg = (isset($editBannerInfo->image)) ? $editBannerInfo->image : "";
                            $edit_bannerImgArray = ( !empty($edit_bannerImg) ) ? explode('/', $edit_bannerImg) : '';
                            $editImageName = ( count($edit_bannerImgArray) > 0 ) ? end($edit_bannerImgArray) : '';
                        ?>
                            <label>Image*</label>
<!--                            <input type="file" name="bannerImage" required class="form-control" />-->
                            <div class="imageOuter">
                                <div class="bannerImage">
                                    <img src="<?php echo '../'.$edit_bannerImg; ?>" width="80%" height="100px" class="upload-preview" />
                                </div>
                                <img src="../uploads/images/other/photo.png"  class="image-choose-icon" />
                                <div class="image-choose-icon">
                                    <input type="file" name="bannerImage" value="<?php echo (isset($editImageName)) ? $editImageName : ""; ?>" accept="image/*" id="bannerImage" class="rounded inpt-img" onChange="showPreviewImage(this);" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Link</label>
                            <input type="text" name="bannerLink" value="<?php echo (isset($editBannerInfo->link)) ? $editBannerInfo->link : ""; ?>" placeholder="Banner Link" class="form-control" />
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-12">
                            <label>Banner Description</label>
                            <textarea name="description" class="edit-textarea" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                <?php echo (isset($editBannerInfo->description)) ? $editBannerInfo->description : ""; ?>
                            </textarea>
                        </div>
                    </div>
                    <div class="row col-12">
                        <div class="form-group col-6">
                            <label>Sort Order</label>
                            <input type="number" name="sortOrder" value="<?php echo (isset($editBannerInfo->sort_order)) ? $editBannerInfo->sort_order : ""; ?>" class="form-control" />
                        </div>
                        <div class="form-group col-6">
                        <?php $statusArray = array('1'=>'Active', '2'=>'Inactive'); ?>
                            <label>Status*</label>
                            <select name="status" required class="form-control">
                            <?php
                                foreach( $statusArray as $key => $value ) {
                                    if( $key == $editBannerInfo->status ) {
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
                    <input type="hidden" name="bannerId" value="<?php echo($editBannerInfo->banner_id); ?>" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnEditBanner" value="Save" class="btn btn-success">
                </div>
            </form>
        </div>
    </div>
<!--</div>-->
<script>
    $(function () {
        $('.edit-textarea').summernote()
    });
</script>
