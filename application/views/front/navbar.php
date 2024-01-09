<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>">
  <img src="<?php echo base_url('assets/images/company/').$company_data->foto.$company_data->foto_type ?>" alt="<?php echo $company_data->company_name ?>" width="50px" style="margin-top: -14px;">
      </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="<?php if($this->uri->segment(1) == ""){echo "active";} ?>">
          <a href="<?php echo base_url() ?>">Home </a>
        <li><a href="<?php echo base_url('cart/finished') ?>">Riwayat Book</a></li> 
          <!-- <a href="<?php echo base_url('cart/history_detail/' . $cek_cart_history->id); ?>">Detail Riwayat</a>   -->
        </li>
      </ul>

      <?php if($this->session->userdata('usertype') != NULL){ ?>
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hi, <?php echo $this->session->userdata('username') ?> <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('auth/profil') ?>">Profil Saya</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="<?php echo base_url('auth/logout') ?>">Logout</a></li>
            </ul>
          </li>
        </ul>
      <?php }else{ ?>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="<?php echo base_url('auth/register') ?>">Register</a></li>
          <li><a href="<?php echo base_url('auth/login') ?>">Login</a></li>
        </ul>
      <?php } ?>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
