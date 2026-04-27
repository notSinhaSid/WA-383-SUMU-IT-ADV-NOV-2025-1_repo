ClassicEditor
    .create(document.querySelector('#postContent'), {
        // inject custom CSS directly into editor content area
        contentsCss: [
            'body { background-color: #1e293b; color: #f1f5f9; font-family: sans-serif; padding: 16px; }',
            'p, li, h1, h2, h3 { color: #f1f5f9; }'
        ]
    })
    .then(editor => {
        window.editorInstance = editor; // ← save instance globally
        console.log('Editor ready', editor);
    })
    .catch(error => {
        console.error(error);
    });

jQuery('#publishBtn').on('click', function (e) {
    e.preventDefault();
    if (window.editorInstance) {
        jQuery('#postContent').val(window.editorInstance.getData());
    }

    let formData = new FormData(jQuery('#createPostForm')[0]);

    jQuery.ajax({
        url: '../controllers/postController.php',
        method: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function (result) {
            const $toastEl = jQuery('#createToast');
            const $toastBody = $toastEl.find('.toast-body');

            if (result.status === 'success') {
                $toastEl.removeClass('text-bg-danger').addClass('text-bg-success');
                $toastBody.text(result.message);
                jQuery('#createPostForm')[0].reset();

                const toast = new bootstrap.Toast($toastEl);
                toast.show();
            } else {
                $toastEl.removeClass('text-bg-success').addClass('text-bg-danger');
                $toastBody.text(result.message);
                const toast = new bootstrap.Toast($toastEl);
                toast.show();
            }
        },
        error: function (xhr) {
            console.log('raw response:', xhr.responseText);
        }
    });
});