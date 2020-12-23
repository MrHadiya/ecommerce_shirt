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
                                            <span class="m-0 font-weight-bold text-primary">Sizes</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addSize">Add Size</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Size Name</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($size_list['status'] == 'true' && count($size_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $size_list['data'] as $key => $value ) {
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><?php echo $value->size_name; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <a onclick="return modal_load(this);" data-href="../admin/size/loadEditSizeForm/<?php echo $value->size_id; ?>"><span class="btn bg-info btn-sm text-white">Edit</i></a>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->size_id; ?>" data-href="../admin/size/deleteSize">Delete</span>
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
    <?php include 'pages/size/view_size_add.php'; ?>
    
    <div class="modal fade" id="modal-editSize">
        <div class="modal-editSize-content"></div>
    </div>
    
    <?php include 'include/js.php'; ?>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        
        function modal_load(obj)
        {
            var modalURL = obj.dataset.href;
            $(".modal-editSize-content").load(modalURL, function() {
                $("#modal-editSize").modal({show:true});
            });
        }
    </script>
</body>
</html>
