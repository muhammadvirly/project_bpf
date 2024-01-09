<?php $this->load->view('front/header'); ?>
<?php $this->load->view('front/navbar'); ?>

	<div class="container">
		<div class="row">
	    </div>
	    <div class="col-lg-12"><h1>DETAIL RIWAYAT TRANSAKSI</h1><hr>
       		 <h4>
					<?php if($history_detail_row->status == '1'){ ?>
		        <font color='red'>(BELUM LUNAS)</font>
		      <?php }elseif($history_detail_row->status == '2'){ ?>
		        <font color='green'>(LUNAS)</font>
		      <?php } ?>
				</h4>
				<br>
				<div class="row">
				  <div class="col-lg-12">
	          <div class="box-body table-responsive padding">
              <table id="datatable" class="table table-striped table-bordered">
                <thead>
                  <tr>
										<th style="text-align: center">No.</th>
										<th style="text-align: center">Lapangan</th>
										<th style="text-align: center">Harga</th>
										<th style="text-align: center">Tanggal</th>
	                  					<th style="text-align: center">Jam Mulai</th>
										<th style="text-align: center">Durasi</th>
										<th style="text-align: center">Jam Selesai</th>
	                  					<th style="text-align: center">Total</th>
                </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach ($history_detail as $history){ ?>
                  <tr>
					<td style="text-align:center"><?php echo $no++ ?></a></td>
                    <td style="text-align:left"><?php echo $history->nama_lapangan ?></a></td>
					<td style="text-align:center"><?php echo $history->harga_jual ?></td>
                    <td style="text-align:center"><?php echo tgl_indo($history->tanggal) ?></td>
                    <td style="text-align:center"><?php echo $history->jam_mulai ?></td>
                    <td style="text-align:center"><?php echo $history->durasi ?></td>
                    <td style="text-align:center"><?php echo $history->jam_selesai ?></td>
					<td style="text-align:center"><?php echo number_format($history->total) ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              </table>
	  			  </div>
	  			</div>
				</div>
		  </div>

			<div class="col-lg-12">
				<table class="table table-striped table-bordered">
		      <tbody>
						<tr>
							<th scope="row">SubTotal</th>
							<td align="right">Rp</td>
							<td align="right"><?php echo number_format($history_detail_row->subtotal) ?></td>
						</tr>
		      </tbody>
		    </table>
			</div>

	