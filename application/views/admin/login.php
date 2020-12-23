<?php
if( isset($page) && count($page) > 0 ) {
    //print_r($page);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1 shrink-to-fit=no">
    <title><?php echo $meta['title']; ?></title>
    <link rel="stylesheet" href="../assets/admin/plugins/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="../assets/admin/plugins/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container h-100 d-flex flex-column justify-content-center mt-4 pt-4">
        <div class="row justify-content-center">
            <div class="col-md-auto col-lg-4 mt-4 pt-4">
                <div class="card shadow mt-4">
                    <div class="card-header text-center">
                        <h3>SIGN IN</h3>
                    </div>
                    <div class="card-body">
                        <form name="frmLogin" method="POST" action="" onsubmit="return submittedForm(this);" enctype="multipart/form-data" data-href="../admin/auth/login" id="frmLogin">
                            <div class="input-group mb-4">
                                <input type="text" name="username" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required placeholder="Email" class="form-control" />
                            </div>
                            <div class="input-group mb-4">
                                <input type="password" name="password" value="" required class="form-control" placeholder="Password" />
                            </div>
                            <div class="input-group mb-4">
                                <span class="error-msg text-danger"></span>
                            </div>
                            <div class="row">
                                <div class="col align-self-center">
                                    <input type="submit" name="login" value="Sign In" class="btn btn-primary btn-block">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../assets/admin/plugins/jquery/jquery.min.js"></script>
    <script>
        function submittedForm(obj)
        {
            var formId = obj.id;
            var request_method = obj.method;
            var url = obj.dataset.href; 
            var form = $('#'+formId)[0];
            var formData = new FormData(form);

            this.event.preventDefault();

            $.ajax({
                url: url,
                type: request_method,
                enctype: 'multipart/form-data',
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                //timeout: 100000,
                success: function(response) {
                    //alert(response);
                    console.log(response);
                    output = JSON.parse(response);
                    if( output.status == 'true' ) {
                        alert(output.message);
                        window.location=output.link;
                    }
                    else {
                        $('.error-msg').text(output.message);
                    }
                },
                error: function(response) {
                    console.log("Error");
                    console.log(response);
                }
            },'json');
        }
    </script>
</body>
</html>
