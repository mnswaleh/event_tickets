<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container-fluid pt-5">
	<h1 class="text-center pb-2 mt-4 mb-2 border-bottom">Welcome to Churchill!</h1>
	<div class="row">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<div class="text-center"><i>Please Login</i></div>
			<form id="formLogin" class="clearfix">
				<small class="form-text text-danger text-center all-error" hidden>Invalid Email or Password!</small>
				<div class="form-group">
					<label class="font-weight-bold" for="email">Email:</label>
					<input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
				</div>
				<div class="form-group">
					<label class="font-weight-bold" for="password">Password:</label>
					<input type="password" class="form-control" name="password" placeholder="********">
				</div>
				<button type="submit" class="btn btn-success float-right">Login</button>
			</form>
			<h1 class="text-center">OR</h1>
			<button class="btn btn-primary btn-large btn-block" data-toggle="modal" data-target="#modalSignup">Sign Up</a>
		</div>
		<div class="col-sm-4"></div>
	</div>
</div>

<div class="modal fade" id="modalSignup" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Sign Up</h4>
        <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form id="formSign">
				<div class="form-group">
					<label class="font-weight-bold" for="firstName">First Name:</label>
					<input type="text" class="form-control" id="firstName" name="firstName" aria-describedby="firstName" placeholder="Enter First Name">
                </div>
                <div class="form-group">
					<label class="font-weight-bold" for="lastName">Last Name:</label>
					<input type="text" class="form-control" id="lastName" name="lastName" aria-describedby="emailHelp" placeholder="Enter Last Name">
                </div>
                <div class="form-group">
					<label class="font-weight-bold" for="signEmail">Email:</label>
					<input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
					<label class="font-weight-bold" for="password">Password:</label>
					<input type="password" min="0" class="form-control" id="password" name="password" aria-describedby="Password" placeholder="********">
                </div>
                <div class="form-group">
					<label class="font-weight-bold" for="confirmPass">Confirm Password:</label>
					<input type="password" class="form-control" id="confirmPass" name="confirmPass" aria-describedby="Confirm Password" placeholder="********">
                </div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" id="btnSign" class="btn btn-success"> Sign up</button>
      </div>
    </div>
  </div>
</div>