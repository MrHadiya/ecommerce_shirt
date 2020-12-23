<?php
if( !$this->session->has_userdata('adminid') ) {
    header("Location: ../admin/login");
}
?>
<!DOCTYPE html>
<html>
<head>
    <?php include 'include/head.php'; ?>
    <title><?php echo $meta['title']; ?></title>
    <link rel="stylesheet" href="../assets/admin/plugins/summernote/summernote-bs4.css">
</head>
<body id="page-top">
    <div id="wrapper">
        <?php include 'include/side_bar.php'; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include 'include/top_bar.php'; ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span class="m-0 font-weight-bold text-primary">Banners</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addBanner">Add Banner</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Banner</th>
                                                    <th>Banner Title</th>
                                                    <th>Banner Link</th>
                                                    <th>Sort Order</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $rootPath = realpath($_SERVER['DOCUMENT_ROOT']);
                                                $baseUrl = $rootPath."/ecommerce_shirt/";
                                                if($banner_list['status'] == 'true' && count($banner_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $banner_list['data'] as $key => $value ) {
                                                        $image = '<img src="../'.$value->image.'" width="100px" heidht="50px" />';
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $image; ?></td>
                                                    <td><?php echo $value->banner_title; ?></td>
                                                    <td><?php echo $value->link; ?></td>
                                                    <td><?php echo $value->sort_order; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <a onclick="return modal_load(this);" data-href="../admin/banner/loadEditBannerForm/<?php echo $value->banner_id; ?>"><span class="btn bg-info btn-sm text-white">Edit</i></a>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->banner_id; ?>" data-href="../admin/banner/deleteBanner">Delete</span>
                                                    </td>
                                                </tr>
                                                        <?php
                                                        $srNo++;
                                                    }
                                                }
                                            ?>  
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'pages/banner/view_banner_add.php'; ?>
    
    <div class="modal fade" id="modal-editBanner">
        <div class="modal-editBanner-content"></div>
    </div>
    
    <?php include 'include/js.php'; ?>
    <script src="../assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        
        $(function () {
            $('.textarea').summernote()
        });
        
        function modal_load(obj)
        {
            var modalURL = obj.dataset.href;
            $(".modal-editBanner-content").load(modalURL, function() {
                $("#modal-editBanner").modal({show:true});
            });
        }
    </script>
</body>
</html>
