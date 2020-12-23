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
                                            <span class="m-0 font-weight-bold text-primary">Colors</span>
                                        </div>
                                        <div class="col-sm-6">
                                            <span type="button" class="btn btn-primary btn-sm float-right" data-toggle="modal" data-target="#modal-addColor">Add Color</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Sr. No</th>
                                                    <th>Color</th>
                                                    <th>Color Name</th>
                                                    <th>Color Code</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                if($colors_list['status'] == 'true' && count($colors_list['data']) > 0 ) {
                                                    $srNo = 1;
                                                    foreach( $colors_list['data'] as $key => $value ) {
                                                        ?>
                                                <tr>
                                                    <td><?php echo $srNo; ?></td>
                                                    <td><div class="d-block p-2 text-whitecol-sm-12" style="background: <?php echo $value->color_code; ?>">&nbsp;</div></td>
                                                    <td><?php echo $value->color_name; ?></td>
                                                    <td><?php echo $value->color_code; ?></td>
                                                    <td><?php echo $value->status; ?></td>
                                                    <td>
                                                        <span type="button" class="btn btn-danger btn-sm" onclick="return del_record(this);" data-value="<?php echo $value->color_id; ?>" data-href="../admin/colors/deleteColor">Delete</span>
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
    <?php include 'pages/colors/view_color_add.php'; ?>
    
    <?php include 'include/js.php'; ?>
    <script src="../assets/admin/plugins/ntc/ntc.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        
        $(document).ready(function () {
            $('#favcolor').on('change', function() {
                val = $('#favcolor').val();
                let result = ntc.name(val);
                
                let rgb_value = result[0];      // #6495ed         : RGB value of closest match
                let specific_name = result[1];  // Cornflower Blue : Color name of closest match
                let shade_value = result[2];    // #0000ff         : RGB value of shade of closest match
                let shade_name = result[3];     // Blue            : Color name of shade of closest match
                let is_exact_match = result[4];
                
                $('#colorName').val(specific_name);
            });
        });
        
        //favcolor
    </script>
</body>
</html>
