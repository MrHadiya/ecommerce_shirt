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
                alert(output.message);``
                window.location.reload();
            }
            else {
                alert(output.message);
                if( output.code == 440 ) {
                    window.location=output.link;
                }
            }
        },
        error: function(response) {
            console.log("Error");
            console.log(response);
        }
    },'json');
}

function del_record(obj)
{
    var url = obj.dataset.href;
    var value = obj.dataset.value;
    //var action = obj.dataset.action;
    var isConform = confirm("Do you really want to delete record ?");
    
    if( isConform == true ) {
        if( value != "" ) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {value: value},
                success: function(response) {
                    //alert(response);
                    output = JSON.parse(response);
                    if( output.status == 'true' ) {
                        alert(output.message);
                        window.location.reload();
                    }
                    else {
                        alert(output.message);
                        if( output.code == 440 ) {
                            window.location=output.link;
                        }
                    }
                },
                error: function(response) {
                    console.log("Error");
                    console.log(response);
                }            
            },'json');
        }
    }
}

function showPreviewImage(obj)
{
    var img = obj.files[0];
    var id = obj.id;
    if( img ) {
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("."+id).html('<img src="'+e.target.result+'" width="80%" height="100px" class="upload-preview" />');
        }
        fileReader.readAsDataURL(img);
    }
}

$(document).ready(function () {
    $('.logout').on('click', function() {
        var url = $(this).data("href");
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                window.location.href = "../admin/login";
            }
        });
    });
});
