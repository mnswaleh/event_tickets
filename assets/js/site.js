const post_start = (curr_btn) => {
    curr_btn.append("<i class='fa fa-spinner fa-spin'></i>")
    curr_btn.prop("disabled", true)
}

const post_finish = (curr_btn) => {
    $('.fa-spinner').remove();
    curr_btn.prop("disabled", false);
}