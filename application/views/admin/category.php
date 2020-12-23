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
                                            <span class="m-0 font-weight-bold text-primary">Category</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addCategory">Add Category</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Image</th>
                                                    <th>Category Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($category_list['status'] == 'true' && count($category_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $category_list['data'] as $key => $value ) {
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $value->image; ?></td>
                                                    <td><?php echo $value->category_name; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <a onclick="return modal_load(this);" data-href="../admin/category/loadEditCategoryForm/<?php echo $value->category_id; ?>"><span class="btn bg-info btn-sm text-white">Edit</i></a>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->category_id; ?>" data-href="../admin/category/deleteCategory">Delete</span>
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
    <?php include 'pages/category/view_category_add.php'; ?>
    
    <div class="modal fade" id="modal-editCategory">
        <div class="modal-editCategory-content"></div>
    </div>
    
    <?php include 'include/js.php'; ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        
        function modal_load(obj)
        {
            var modalURL = obj.dataset.href;
            $(".modal-editCategory-content").load(modalURL, function() {
                $("#modal-editCategory").modal({show:true});
            });
        }
    </script>
</body>
</html>
