jQuery('.delete-btn').on('click', function(e) {
    e.preventDefault();

    const confirmation = confirm('Are you sure you want to delete this post ?');
    if(!confirmation)
        return;

    const postId = jQuery(this).data('id');
    const card = jQuery(this).closest('.col-md-4');

    jQuery.ajax({
        url: '../controllers/postController.php',
        method: 'POST',
        data: {
            action: 'delete',
            postId: postId,
        },
        dataType: 'json',
        success: function(result) {
            if(result.status === 'success'){
                card.remove();
                // creating toast
                const toastElement = new bootstrap.Toast(document.getElementById('deleteToast'));
                toastElement.show();
            }else{
                alert(result.message);
            }
        },
        error: function(xhr){
            console.log('raw response : ', xhr.responseText);
            alert('Something went wrong, Please try again!');
        }
    });
});