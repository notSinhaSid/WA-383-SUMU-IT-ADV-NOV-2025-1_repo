/* CRUD operation code below */

function fetchStudent() {
    $.get('operation.php?action=fetch', function(data) {
        const users = JSON.parse(data);

        let html = '';
        users.forEach(element => {
            html += '<tr><td>' + element.userName + '</td><td>' + element.userEmail + '</td><td><img src="uploads/' + element.userPic + '"/></td>';
            html += '<td><button onclick="editStudent(' + element.userId + ')">Edit</button> ';
            html += '<button onclick="deleteStudent(' + element.userId + ')">Delete</button></td></tr>'; 
        });
        $('#blogForm').html(html);
    });
}


/* form action handled here */

$('#blogForm').submit(function (response){
    response.preventDefault();

    let isValid = true;
    let userName = $('#userName').val().trim();
    let userEmail = $('#userEmail').val().trim();

    let errors = [];

    if(userName === '') {
        isValid = false;
        errors.push("Name is required");
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (userEmail === '') {
        isValid = false;
        errors.push("Email is required.");
    } else if (!emailPattern.test(userEmail)) {
        isValid = false;
        errors.push("Please enter a valid email address.");
    }

    if(isValid === true) {
        const formData = new FormData(this);
        $.ajax({
            url: 'includes/operation.php',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $('#blogForm')[0].reset();

                $('#blogForm').val('create');
                fetchStudent();

                const userVar = JSON.parse(data);

                if(userVar.status === 'success') {
                    alert('Post Added ✅');
                    // jQuery("#display_msg").html('Post added ✅');
                }
                else if(userVar.status === 'updated') {
                    alert('Post Updated ✅');
                    // jQuery('#display_msg').html('Post Updated ✅');
                    $('#display_img').html('');
                }
                else {
                    alert('Failed ❌');
                    // jQuery('#display_msg').html('<span style="color:red;">Failed ❌</span>');
                }


            }
        });
    }
});