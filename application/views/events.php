<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid pt-5">
	<h1 class="text-center pb-2 mt-4 mb-2">Upcoming Events</h1>
	<div class="row">
		<div class="col-sm-1"></div>
		<div class="col-sm-10">
            <table class="table table-striped">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Event</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Date</th>
                        <th scope="col">VIP(KSH)</th>
                        <th scope="col">Regular(KSH)</th>
                        <th scope="col">Attendees(MAX)</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (empty($events)){
                            echo '<tr><td colspan="8" class="text-center"> No upcoming events!</td></tr>';
                        }
                        $i=1;
                        foreach ($events as $event):
                    ?>
                      <tr id="<?php echo $event['id']; ?>">
                          <th scope="row"><?php echo $i; ?></th>
                          <td><?php echo $event['eventTitle']; ?></td>
                          <td><?php echo $event['venue']; ?></td>
                          <td><?php echo $event['eventDate']; ?></td>
                          <td><?php echo $event['vip']; ?></td>
                          <td><?php echo $event['regular']; ?></td>
                          <td><?php echo ($event['bookings']) . '/'.$event['maxAttendees']; ?></td>
                          <td>
                            <?php if ($_SESSION['user_role'] == 2){ ?>
                              <button class="btn btn-link btnEdit" data-toggle="modal" data-target="#modalEvent"><i class="fa fa-edit"></i></button>
                              <button class="btn btn-link btnDelete" data-toggle="popover"><i class="fa fa-trash"></i></button>
                            <?php } else{ ?>
                              <button class="btn btn-secondary btnReserve"  data-toggle="modal" data-target="#modalReserve">Reserve</button>
                            <?php } ?>
                          </td>
                      </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
		</div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2">
          <?php if ($_SESSION['user_role'] == 2){ ?>
            <button class="btn btn-primary btn-large btn-block" id="btnCreate" data-toggle="modal" data-target="#modalEvent"><i class="fa fa-plus"></i> Create Event</button>
          <?php } ?>
        </div>
        <div class="col-sm-5"></div>
	</div>
</div>
<div class="modal fade" id="modalEvent" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Create Event</h4>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="formEvent">
            <div class="form-group">
              <label class="font-weight-bold" for="eventTitle">Event Title:</label>
              <input type="text" class="form-control" id="eventTitle" name="eventTitle" aria-describedby="eventTitle" placeholder="Enter Title">
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="venue">Venue:</label>
              <input type="text" class="form-control" id="venue" name="venue" aria-describedby="venue" placeholder="Enter Venue">
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="eventDate">Date:</label>
              <input type="date" class="form-control" id="eventDate" name="eventDate" aria-describedby="eventDate">
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="vip">VIP(KSH):</label>
              <input type="number" min="0" class="form-control" id="vip" name="vip" aria-describedby="vip" placeholder="0.00">
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="regular">Regular(KSH):</label>
              <input type="number" min="0" class="form-control" id="regular" name="regular" aria-describedby="regular" placeholder="0.00">
            </div>
            <div class="form-group">
              <label class="font-weight-bold" for="maxAttendees">Attendees(MAX):</label>
              <input type="number" min="1" class="form-control" id="maxAttendees" name="maxAttendees" aria-describedby="attendees" placeholder="0">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="btnEvent" class="btn btn-success"><i class="fa fa-save"></i> Save</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalReserve" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Reserve Tickets</h4>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-2"><i>Make reservations for "<span id="eTitle"></span>"</i></div>
        <form id="formReserve">
            <small class="form-text text-danger text-center all-error"></small>
            <div class="form-group row justify-content-center">
              <label class="col-sm-3 font-weight-bold" for="regularReservation">Regular:</label>
              <input type="number" min="0" max="5" class="col-sm-3 form-control" id="regularReservation" aria-describedby="regularReservation" value="1">
              <label class="col-sm-3 text-info" id="eRegular">x</label>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-sm-3 font-weight-bold" for="vipReservation">VIP:</label>
              <input type="number" min="0" max="5" class="col-sm-3 form-control" id="vipReservation" aria-describedby="vipReservation" placeholder="0">
              <label class="col-sm-3 text-info" id="eVIP"></label>
            </div>
            <div class="form-group row justify-content-center">
              <label class="col-sm-3 font-weight-bold">TOTAL:</label>
              <label class="col-sm-3" id="eSum">1</label>
              <label class="col-sm-3 text-danger" id="eTotal">KSH 500</label>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="btnReserve" class="btn btn-success"> Reserve</button>
      </div>
    </div>
  </div>
</div>