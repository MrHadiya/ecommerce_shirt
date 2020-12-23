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
    <link rel="stylesheet" href="../assets/admin/plugins/bootstrap/css/bootstrap-multiselect.css">
    <style>
        div.multibtngroup div.btn-group {width:100%}
    </style>
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
                                            <span class="m-0 font-weight-bold text-primary">Products</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addProduct">Add Product</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Product Name</th>
                                                    <th>Product Code</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($product_list['status'] == 'true' && count($product_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $product_list['data'] as $key => $value ) {
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $value->product_name; ?></td>
                                                    <td><?php echo $value->product_code; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <a onclick="return modal_load(this);" data-href="../admin/product/loadEditProductForm/<?php echo $value->product_id; ?>"><span class="btn bg-info btn-sm text-white">Edit</i></a>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->product_id; ?>" data-href="../admin/product/deleteProduct">Delete</span>
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
    
    <?php include 'pages/product/view_product_add.php'; ?>
    
    <div class="modal fade" id="modal-editProduct">
        <div class="modal-editProduct-content"></div>
    </div>
    
    <?php include 'include/js.php'; ?>
    <script src="../assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
    <script src="../assets/admin/plugins/bootstrap/js/bootstrap-multiselect.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        
        $(function () {
            $('.textarea').summernote()
        });
        
        $(document).ready(function() {
            $('#example-multiselect-fallback').multiselect({
                includeSelectAllOption: true
                //selectedClass: "active multiselect-active-item-fallback"
            });
        });

        function delItemRow(e)
        {
            var tr = $("#itemTable > tbody > tr").length;
            if( tr > 1 ) {
                var ap = e.parentNode.parentNode;
                ap.parentNode.removeChild(ap);
            }
        }
        
        function modal_load(obj)
        {
            var modalURL = obj.dataset.href;
            $(".modal-editProduct-content").load(modalURL, function() {
                $("#modal-editProduct").modal({show:true});
            });
        }
    </script>
</body>
</html>
