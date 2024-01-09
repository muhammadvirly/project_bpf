<?php $this->load->view('back/meta') ?>
  <div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
          </div><!-- /.col -->
        </div>
        <br>
        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="text-align: center">No.</th>
                    <th style="text-align: center">Nama Lapangan</th>
                    <th style="text-align: center">Harga</th>
                    <th style="text-align: center">Tanggal</th>
                    <th style="text-align: center">Jumlah Mulai</th>
                    <th style="text-align: center">Durasi</th>
                    <th style="text-align: center">Jam Selesai</th>
                    <th style="text-align: center">Total</th>
                  </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($cart_finished as $cart){ ?>
                  <tr>
                    <td style="text-align:center"><?php echo $no++ ?></td>
                    <td style="text-align:left"><?php echo $cart->nama_lapangan ?></td>
                    <td style="text-align:center"><?php echo number_format($cart->harga_jual) ?></td>
                    <td style="text-align:center"><?php echo $cart->tanggal ?></td>
                    <td style="text-align:center"><?php echo $cart->jam_mulai ?></td>
                    <td style="text-align:center"><?php echo $cart->durasi ?></td>
                    <td style="text-align:center"><?php echo $cart->jam_selesai ?></td>
                    <br>
                    <td style="text-align:right"><?php echo number_format($cart->subtotal) ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-xs-12">
            <div class="table-responsive">
              <table class="table">
                <tr>
    							<th>SubTotal</th>
                  <td align="right">Rp</td>
    							<td colspan="2" align="right"><?php echo number_format($cart_finished_row->subtotal) ?></td>
    						</tr>
              </table>
            </div>
          
      </section><!-- /.content -->
      <div class="clearfix"></div>
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div>
  <?php $this->load->view('back/js') ?>
</body>
</html>
