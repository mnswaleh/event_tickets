<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid pt-5">
	<h1 class="text-center pb-2 mt-4 mb-2 border-bottom">Active Reservations - 0</h1>
	<div class="row">
		<div class="col-sm-2"></div>
		<div class="col-sm-8">
            <table class="table table-striped table-info">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Event</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Date</th>
                        <th scope="col">VIP</th>
                        <th scope="col">Regular</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; foreach ($reservations as $reservation):?>
                        <tr>
                            <th scope="row"><?php echo $i; ?></th>
                            <td><?php echo $reservation['eventTitle']; ?></td>
                            <td><?php echo $reservation['venue']; ?></td>
                            <td><?php echo $reservation['eventDate']; ?></td>
                            <td><?php echo $reservation['vip']; ?></td>
                            <td><?php echo $reservation['regular']; ?></td>
                            <td><?php echo ($reservation['vip'] + $reservation['regular']); ?></td>
                        </tr>
                    <?php $i++; endforeach;?>
                </tbody>
            </table>
		</div>
        <div class="col-sm-2"></div>
        <div class="col-sm-5"></div>
        <div class="col-sm-2"><a href="<?php echo site_url('events/') ?>" class="btn btn-primary btn-large btn-block"><i class="fa fa-plus"></i> Add Reservation</a></div>
        <div class="col-sm-5"></div>
	</div>
</div>