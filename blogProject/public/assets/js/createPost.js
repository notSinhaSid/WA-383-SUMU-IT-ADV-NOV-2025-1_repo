ClassicEditor
    .create(document.querySelector('#postContent'))
    .then(editor => {
        console.log('Editor ready', editor);
    })
    .catch(error => {
        console.error(error);
    });

$('#publishBtn').on('click', function (e) {
    e.preventDefault();
    console.log('button clicked');

    const formData = new FormData($('#createPostForm')[0]);
    const messageDiv = $('#formMessage');

    $.ajax({
        url: '../controllers/postController.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json', // ← uncomment this
        success: function (result) {
            // remove the JSON.parse line, result is already parsed
            console.log('result', result);
            if (result.status === 'success') {
                messageDiv.removeClass('text-danger').addClass('text-success');
                messageDiv.text('Post created successfully!');
                $('#createPostForm')[0].reset();
                setTimeout(() => {
                    window.location.href = 'dashboard.php';
                }, 1500);
            } else {
                messageDiv.removeClass('text-success').addClass('text-danger');
                messageDiv.text(result.message);
            }
        },
        error: function (xhr) {
            console.log('raw response:', xhr.responseText);
            messageDiv.removeClass('text-success').addClass('text-danger');
            messageDiv.text('Something went wrong. Please try again.');
        }
    });
});