$('#loginForm').on('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const messageDiv = $('#formMessage');

    $.ajax({
        url: '../controllers/UserController.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function (result) {
            if (result.status === 'success') {
                messageDiv.removeClass('text-danger').addClass('text-success');
                messageDiv.text(result.message);

                // redirect based on role returned from controller
                setTimeout(() => {
                    window.location.href = result.redirect;
                }, 1000);

            } else {
                messageDiv.removeClass('text-success').addClass('text-danger');
                messageDiv.text(result.message);
            }
        },
        error: function () {
            messageDiv.removeClass('text-success').addClass('text-danger');
            messageDiv.text('Something went wrong. Please try again.');
        },
        dataType: 'json'
    });
});