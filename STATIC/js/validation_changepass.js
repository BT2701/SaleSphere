$(document).ready(function(){
    $('#submit1').click(function(event){
        event.preventDefault();

    var formData={
        'IdProfile': $('#IdProfile1').val(),
        'Oldpass': $('#oldpass').val(),
        'Newpass': $('#newpass').val(),
        'cNewpass': $('#cnewpass').val()        
    };
    $.ajax({
        type: 'POST',
        url: '/SaleSphere/VIEWS/profile/validate_changepass.php',
        data: formData,
        dataType: 'json',
        encode: true
    })
    .done(function(response){
        if(!response.success){
            if (response.errors.username6) {
                $('#errorOldpass').text(response.errors.username6);
            }
            else {
                if(response.errors.username5)
                {
                    $('#errorOldpass').text(response.errors.username5);    
                }
                else
                    $('#errorOldpass').text('');
            }
            if (response.errors.password9) {
                $('#errorNewpass').text(response.errors.password9);
            } else {
                if(response.errors.password7)
                {
                    $('#errorNewpass').text(response.errors.password7);
                }
                else{
                    if(response.errors.password8)
                    {
                        $('#errorNewpass').text(response.errors.password8);
                    }
                    else
                    $('#errorNewpass').text('');
                }
                
            }
            if (response.errors.cPassword10) {
                $('#errorcNewpass').text(response.errors.cPassword10);
            } else {
                $('#errorcNewpass').text('');
            }
        }else
        {
            $('#MyForm').submit();
        }
    });
    });
});