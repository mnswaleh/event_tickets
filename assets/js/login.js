$(() => {
    $('#formLogin').submit(e=>{
        const curr_form = $(e.target);
        const curr_btn = curr_form.find(":submit");
        post_start(curr_btn);
        e.preventDefault()
        $('.all-error').attr('hidden', 'hidden');
        $.post( site_url + 'auth/login', curr_form.serialize())
        .done((data)=> {
            const response = JSON.parse(data);
            if (response){
                location.reload();
            }else {
                $('.all-error').removeAttr('hidden');
            }
            post_finish(curr_btn);
        });
    });

    $('#btnSign').click((e)=>{
        const curr_btn = $(e.target);
        post_start(curr_btn);
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
                post_finish(curr_btn);
            }
        });
    });
});
