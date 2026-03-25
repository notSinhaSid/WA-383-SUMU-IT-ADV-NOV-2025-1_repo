jQuery('#addCategoryForm').on('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);
    let messageDiv = jQuery('#formMessage');

    jQuery.ajax({
        url: '../controllers/categoryController.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(result) {
            if(result.status === 'success') {
                messageDiv.removeClass('text-danger text-warning text-success').addClass('text-success');
                messageDiv.text(result.message);
                jQuery('#addCategoryForm')[0].reset();
                setTimeout(() => {
                    window.location.href = 'category.php';
                }, 1000);
            }
            else if(result.status === 'warning') {
                messageDiv.removeClass('text-danger text-success').addClass('text-warning');
                messageDiv.text(result.message);
                jQuery('#addCategoryForm')[0].reset();
            }
            else{
                messageDiv.removeClass('text-success').addClass('text-danger');
                messageDiv.text(result.message);
            }
        },
        error: function(){
            messageDiv.removeClass('text-success').addClass('text-danger');
            messageDiv.text('Something went wrong, Try again!!');
        }
    });
});