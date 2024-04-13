$(document).ready(function(){
    $('#submit1').click(function(event){
        event.preventDefault();

    var formData={
        'email': $('#Email').val(),
        'phone_number': $('#Phone_Number').val(),   
    };
    $.ajax({
        type: 'POST',
        url: '/web2/VIEWS/profile/validate_fixprofile.php',
        data: formData,
        dataType: 'json',
        encode: true
    })
    .done(function(response){
        if(!response.success){
            if (response.errors.email11) {
                $('#errorEmail').text(response.errors.email11);
            } else {
                if(response.errors.email10){
                    $('#errorEmail').text(response.errors.email10);
                }else
                $('#errorEmail').text('');
            }
            if (response.errors.phone_number11) {
                $('#errorPhoneNumber').text(response.errors.phone_number11);
            } else {
                if(response.errors.phone_number10){
                    $('#errorPhoneNumber').text(response.errors.phone_number10);
                }
                else
                $('#errorPhoneNumber').text('');
            }
        }else
        {
            $('#MyForm').submit();
        }
    });
    });
});