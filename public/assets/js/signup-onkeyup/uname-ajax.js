$('#uname').on('keyup', function() {
    var username = $(this).val();
    $.ajax({
        type: 'POST',
        url: 'signup.php',
        data: { field: 'uname', value: username },
        success: function(response) {
            $('#unameError').text(response);
        }
    });
});
