$(() => {
    let current_url = "";
    $('#btnCreate').click(()=>{
        current_url = site_url + 'events/create_event';
        $('.form-error').remove();
        $('#formEvent input').val('');
        $('#modalEvent .modal-title').text('Create Event');
    });

    $('.btnEdit').click((e)=>{
        const parent_row = $(e.target).closest('tr');
        event_id = parent_row.attr('id');
        current_url = site_url + 'events/update_event/' + event_id;
        let attendees = parent_row.find('td:nth-of-type(6)').text();
        attendees = attendees.split('/')
        $('#modalEvent .modal-title').text('Edit Event');
        $('.form-error').remove();
        $('#eventTitle').val(parent_row.find('td:nth-of-type(1)').text());
        $('#venue').val(parent_row.find('td:nth-of-type(2)').text());
        $('#eventDate').val(parent_row.find('td:nth-of-type(3)').text());
        $('#vip').val(parent_row.find('td:nth-of-type(4)').text());
        $('#regular').val(parent_row.find('td:nth-of-type(5)').text());
        $('#maxAttendees').val(attendees[1]);
    });

    $('#btnEvent').click((e)=>{
        const curr_btn = $(e.target);
        post_start(curr_btn);
        $('.form-error').remove();
        $.post( current_url, $('#formEvent').serialize())
        .done((data)=> {
            const response = JSON.parse(data);
            if (response.success){
                location.reload();
            }else {
                $.each(response, (key, value) => {
                    $("#" + key).after('<small class="form-text text-danger small form-error">' + value + '</small>');
                });
            }
            post_finish(curr_btn);
        });
    });

    let regular_tickets = 0;
    let vip_tickets = 0;
    let vip_cost = 0;
    let regular_cost = 0;
    let event_id = 0;

    const set_total = () => {
        regular_tickets = Number($('#regularReservation').val());
        vip_tickets = Number($('#vipReservation').val());
        const regular_total = $('#eRegular').text() * regular_tickets;
        const vip_total = $('#eVIP').text() * vip_tickets;

        $('#eTotal').text(regular_total + vip_total);
        $('#eSum').text(regular_tickets + vip_tickets);
    }

    $('.btnReserve').click((e) => {
        const parent_row = $(e.target).closest('tr');
        event_id = parent_row.attr('id');
        vip_cost = parent_row.find('td:nth-of-type(4)').text();
        regular_cost = parent_row.find('td:nth-of-type(5)').text();
        $('#eTitle').text(parent_row.find('td:nth-of-type(1)').text());
        $('#eRegular').text(regular_cost);
        $('#eVIP').text(vip_cost);
        set_total()
    });

    $('#formReserve .form-control').on('change, keyup', () => {
        set_total()
    });

    $('#btnReserve').click((e)=>{
        const curr_btn = $(e.target);
        post_start(curr_btn);
        $('.all-error').text('');
        const post_data = {
            eventId: event_id,
            vip: vip_tickets,
            regular: regular_tickets,
            vipPrice: vip_cost,
            regularPrice: regular_cost,
        };
        $.post( site_url + 'reservations/make_reservation', post_data)
        .done((data)=> {
            const response = JSON.parse(data);
            if (response.success){
                window.location.replace(site_url + 'reservations');
            }else {
                $('.all-error').text(response.error);
            }
            post_finish(curr_btn);
        });
    });

    $(".btnDelete").click( (e) => {
        const parent_row = $(e.target).closest('tr');
        event_id = parent_row.attr('id');
    });

    $("body").on('click', '.deleteBtn',  (e) => {
        const curr_btn = $(e.target);
        post_start(curr_btn);
        $.post( site_url + 'events/delete_event/' + event_id)
        .done((data)=> {
            const response = JSON.parse(data);
            if (response.success){
                location.reload();
            }else {
                alert('Server Error!');
            }
            post_finish(curr_btn);
        });
    });

    $('body').on('hidden.bs.popover', (e) => {
        $(e.target).data("bs.popover").inState = { click: false, hover: false, focus: false }
    });

    $(".btnDelete").popover({
        placement: 'top',
        html: true,
        title : 'Confirm delete',
        content : "<div class='row'><div class='col-sm-6'><a class='btn btn-danger deleteBtn'>Delete</a></div><div class='col-sm-6'><a class='btn btn-info dismiss-popover'>cancel</a></div></div>"
    });

    $( "body" ).on('click', '.dismiss-popover', () => {
        $('[data-toggle="popover"]').popover('hide');
    });
});
