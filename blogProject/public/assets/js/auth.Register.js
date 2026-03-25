// form register
jQuery('#registerForm').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let messageDiv = jQuery('#formMessage');

    jQuery.ajax({
        url: '../controllers/userController.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(result) {
            if(result.status === 'success') {
                messageDiv.removeClass('text-danger').addClass('text-success');
                jQuery('#registerForm')[0].reset();

                setTimeout(() => {
                    window.location.href = 'login.php';
                }, 2000);
            }
            else{
                messageDiv.removeClass('text-success').addClass('text-warning');
                messageDiv.text(result.message);

                if(result.redirect) {
                    setTimeout(() => {
                        window.location.href = result.redirect;
                    }, 1500);
                }
            }
        },
        error: function() {
            messageDiv.removeClass('text-success').addClass('text-danger');
            messageDiv.text('Something went wrong. Please try again.');
        },

        dataType: 'json',
    });
});