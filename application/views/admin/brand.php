<?php
if( isset($page) && count($page) > 0 ) {
    //print_r($page);
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
                                            <span class="m-0 font-weight-bold text-primary">Brands</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addBrand">Add Brand</span>
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
                                                    <th>Brand Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($brand_list['status'] == 'true' && count($brand_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $brand_list['data'] as $key => $value ) {
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $value->image; ?></td>
                                                    <td><?php echo $value->brand_name; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->brand_id; ?>" data-href="../admin/brand/deleteBrand">Delete</span>
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
    <?php include 'pages/brand/view_brand_add.php'; ?>
    
    <?php include 'include/js.php'; ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
</body>
</html>
