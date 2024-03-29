<?php $this->load->view('back/meta') ?>
  <div class="wrapper">
    <?php $this->load->view('back/navbar') ?>
    <?php $this->load->view('back/sidebar') ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1><?php echo $title ?></h1>
      </section>
      <!-- Main content -->
      <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-12">
						<div class="box box-primary">
              <div class="box-body">
								<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                <div class="table-responsive no-padding">
									<table id="datatable" class="table table-striped">
										<thead>
											<tr>
                        <th style="text-align: center">No.</th>
                        <th style="text-align: center">Atas Nama</th>
      									<th style="text-align: center">Dibuat</th>
      									<th style="text-align: center">Grand Total</th>
      									<th style="text-align: center">Status</th>
                        <th style="text-align: center">Aksi</th>
											</tr>
										</thead>
                    <?php $no=1; foreach ($get_all as $data){ ?>
                      <tr>
                        <td style="text-align:center"><?php echo $no++ ?></td>
                        <td style="text-align:center"><?php echo $data->name ?></a></td>
      									<td style="text-align:center"><?php echo tgl_indo($data->created_date) ?></td>
      									<td style="text-align:center"><?php echo number_format($data->grand_total) ?></a></td>
      									<td style="text-align:center">
                          <?php if($data->status == '0'){ ?>
      		                  <button type="button" name="status" class="btn btn-primary"></i> BELUM CHECKOUT</button>
      		                <?php } elseif($data->status == '1'){ ?>
      		                  <button type="button" name="status" class="btn btn-warning"></i> BELUM LUNAS</button>
      		                <?php } elseif($data->status == '2'){ ?>
      		                  <button type="button" name="status" class="btn btn-success"></i> LUNAS</button>
      		                <?php } elseif($data->status == '3'){ ?>
      		                  <button type="button" name="status" class="btn btn-danger"></i> EXPIRED</button>
      		                <?php } ?>
      									</td>
      									<td style="text-align:center">
                          <?php if($data->status != '2'){ ?>
                            <a href="<?php echo base_url('admin/transaksi/set_lunas/').$data->id_trans ?>">
                              <button name="update" class="btn btn-success"> Set Lunas</button>
                            </a>
                          <?php } ?>
                          <a href="<?php echo base_url('admin/transaksi/detail/').$data->id_trans ?>">
                            <button name="update" class="btn btn-primary"></i> Detail</button>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                    </tbody>
									</table>
                </div>
							</div>
						</div>
          </div><!-- ./col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <?php $this->load->view('back/footer') ?>
  </div><!-- ./wrapper -->
  <?php $this->load->view('back/js') ?>
	<!-- DATA TABLES-->
  <link href="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="<?php echo base_url('assets/plugins/') ?>datatables/dataTables.bootstrap.min.js" type="text/javascript"></script>
  </script>
</body>
</html>
