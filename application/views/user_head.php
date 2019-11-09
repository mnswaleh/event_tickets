<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container pt-5">
  <div class="btn-group float-right">
    <button type="button" class="btn btn-large btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Musa Juma
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="<?php echo site_url('reservations') ?>"> Reservations</a>
        <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>"><i class="fa fa-power-off text-danger"></i> Logout</a>
    </div>
  </div>
</div>