jQuery('#adminLoginForm').on('submit', function(e) {
    e.preventDefault();

    let adminFormData = new FormData(this);
    let messageDiv = jQuery('#formMessage');

    jQuery.ajax({
        url: '../controllers/userController.php',
        method: 'POST',
        data: adminFormData,
        contentType: false,
        processType: false,
        success: function(result) {
            if(result.status === 'success') {
                messageDiv.removeClass('text-danger').addClass('text-success');
                messageDiv.text(result.message);

                setTimeout(() => {
                    window.location.href = result.redirect; //gets the redirect location form the usercontroller
                }, 1000); // 1sec
            }
            else{
                messageDiv.removeClass('text-success').addClass('text-danger');
                messageDiv.text(result.message);
            }
        },
        dataType: 'json',
    });
});