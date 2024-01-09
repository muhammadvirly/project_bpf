<!DOCTYPE html>
<html>
  <head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8">

  </head>
  <?php $this->load->view('front/header'); ?>
  <div class="container">
	<div class="row">
    <div class="col-sm-12 col-lg-12">
    </div>
    <div class="col-lg-12"><h1>Login Admin</h1>
			<div class="row">
			  <div class="col-lg-12">
					<?php echo $message;?>
					<?php echo form_open("admin/auth/login");?>
						<div class="form-group has-feedback"><label>Email</label>
							<?php echo form_input($identity) ?>
							<span class="form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback"><label>Password</label>
							<?php echo form_password($password); ?>
							<span class="form-control-feedback"></span>
						</div>
            <hr>
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>
        <?php echo form_close();?>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- modal reset password -->
    <div id="pswreset" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- konten modal-->
        <div class="modal-content">
          <!-- body modal -->
          <div class="modal-body">
            <?php echo form_open("admin/auth/forgot_password");?>
              <div class="form-group"><label>Silahkan masukkan Email Anda</label>
                <input class="form-control" name="identity" type="text" id="identity" />
              </div>
              <button type="submit" name="submit" class="btn btn-success">Submit</button>
            <?php echo form_close() ?>
          </div>
          <!-- footer modal -->
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
