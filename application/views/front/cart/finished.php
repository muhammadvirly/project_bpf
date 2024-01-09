<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

<div class="container">
	<div class="row">
    <div class="col-lg-12"><h1>Telah Booking</h1><hr>
			<!-- <h4>INVOICE NO. <?php echo $cart_finished_row->id_invoice ?> (<font color='red'>BELUM LUNAS</font>)</h4> -->
			<?php echo form_close() ?>
			<br>
			<div class="row">
			  <div class="col-lg-12">
          <div class="box-body table-responsive padding">
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
									<th style="text-align: center">No.</th>
                  <th style="text-align: center">Lapangan</th>
									<th style="text-align: center">Harga Per Jam</th>
									<th style="text-align: center">Tanggal</th>
                  <th style="text-align: center">Mulai</th>
									<th style="text-align: center">Durasi</th>
									<th style="text-align: center">Selesai</th>
                  <th style="text-align: center">Total</th>
                </tr>
              </thead>
              <tbody>
              <?php $no=1; foreach ($cart_finished as $cart){ ?>
                <tr>
                  <td style="text-align:center"><?php echo $no++ ?></td>
                  <td style="text-align:left"><?php echo $cart->nama_lapangan ?></td>
									<td style="text-align:center"><?php echo number_format($cart->harga_jual) ?></td>
									<td style="text-align:center"><?php echo tgl_indo($cart->tanggal) ?></td>
                  <td style="text-align:center"><?php echo $cart->jam_mulai ?></td>
									<td style="text-align:center"><?php echo $cart->durasi ?></td>
									<td style="text-align:center"><?php echo $cart->jam_selesai ?></td>
                  <td style="text-align:right"><?php echo number_format($cart->total) ?></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
  			  </div>
  			</div>
  		</div>

<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
            <tbody>
                <tr>
                    <th scope="row">SubTotal</th>
                    <td align="right">Rp</td>
                    <td align="right"><?php echo number_format($cart_finished_row->subtotal) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>	

<?php $this->load->view('front/footer'); ?>
