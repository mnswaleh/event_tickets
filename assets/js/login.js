$(() => {
    $('#formLogin').submit(e=>{
        e.preventDefault()
        $('.all-error').attr('hidden', 'hidden');
        $.post( site_url + 'auth/login', $('#formLogin').serialize())
        .done((data)=> {
            const response = JSON.parse(data);
            if (response){
                location.reload();
            }else {
                $('.all-error').removeAttr('hidden');
            }
        });
    });

    $('#btnSign').click(()=>{
        $('.form-error').remove();
        $.post( site_url + 'auth/sign_up', $('#formSign').serialize())
        .done((data)=> {
            const response = JSON.parse(data);
            if (response.success){
                location.reload();
            }else {
                $.each(response, (key, value) => {
                    $("#" + key).after('<small class="form-text text-danger small form-error">' + value + '</small>');
                });
            }
        });
    });
});
