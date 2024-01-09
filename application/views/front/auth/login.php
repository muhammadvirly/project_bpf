<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-sm-12 col-lg-12">
    </div>
    <div class="col-lg-12"><h1>LOGIN</h1>
			<div class="row">
			  <div class="col-lg-12">
					<?php echo $message;?>
					<?php echo form_open("auth/login");?>
						<div class="form-group has-feedback"><label>Email</label>
							<?php echo form_input($identity) ?>
							<span class="form-control-feedback"></span>
						</div>
						<div class="form-group has-feedback"><label>Password</label>
							<?php echo form_password($password); ?>
							<span class="form-control-feedback"></span>
						</div>
						Belum punya akun?<a href="<?php echo base_url('auth/register') ?>">Daftar</a><hr>
						<div class="form-group">
							<button type="submit" name="submit" class="btn btn-primary">Login</button>
							<button type="reset" name="reset" class="btn btn-danger">Reset</button>
						</div>
					<?php echo form_close();?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('front/footer'); ?>
