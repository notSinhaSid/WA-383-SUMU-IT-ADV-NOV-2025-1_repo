jQuery('#updateBtn').on('click', function(e) {
    e.preventDefault();
    console.log('Update button clicked');

    let formData = new FormData(jQuery('#createPostForm')[0]);
    let messageDiv = jQuery('#formMessage');

    jQuery.ajax({
        url: '../controllers/postController.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function(result) {
            if(result.status === 'success') {
                messageDiv.removeClass('alert alert-danger').addClass('alert alert-success').attr('role', 'alert');
                messageDiv.text(result.message);
                
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1500);
            }
            else{
                messageDiv.removeClass('alert alert-success').addClass('alert alert-danger').attr('role', 'alert');
                messageDiv.text(result.message);
            }
        },
        error: function(xhr){
            console.log('raw response:' , xhr.responseText);
            messageDiv.removeClass('alert alert-success').addClass('text-danger');
            messageDiv.text('Something went wrong, Please Try again 🙏');
        },

    });
});