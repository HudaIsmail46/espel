<div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Peruntukan Semasa</h2>
          <a href="<?=base_url("peruntukan/initial")?>" class="btn btn-primary pull-right" role="button">Initial Peruntukan</a>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <?php if(appsess()->getFlashSession()):?>
          <?php if(appsess()->getFlashSession('success')):?>
          <div class="alert alert-success alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>INFO!</strong> Proses telah berjaya dilaksanakan.
          </div>
          <?php else:?>
          <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
            </button>
            <strong>RALAT!</strong> Proses tidak berjaya dilaksanakan.
          </div>
          <?php endif?>
          <?php endif?>
          <?php if(count($list_peruntukan)):?>
          <div class="table-responsive">
              <table id="datatable" class="table table-striped table-bordered jambo_table">
                <thead>
                  <tr class="headings">
                    <th>Pusat Tanggungjawab (PTJ)</th>
                    <th>Jenis Peruntukan</th>
                    <th>Jumlah (RM)</th>
                    <th style="text-align:center">Operasi</th>
                  </tr>
                </thead>


                <tbody>
                    <?php foreach($list_peruntukan as $peruntukan):?>
                  <tr>
                    <td><?=$peruntukan->jabatan->nama?></td>
                    <td><?=$peruntukan->jns_peruntukan->nama?></td>
                    <td>RM<?=number_format($peruntukan->jumlah,2,'.',',')?></td>
                    <td align="center">
                        <a href="<?=base_url("mockup/admin/peruntukan/transaksi")?>" type="button" class="btn btn-round btn-info btn-xs" data-toggle="tooltip" title="Transaksi Peruntukan"><i class="fa fa-file-o"></i></a>
                        <a href="<?=base_url("mockup/admin/peruntukan/tolak")?>" type="button" class="btn btn-round btn-danger btn-xs" data-toggle="tooltip" title="Tolak Peruntukan"><i class="fa fa-minus"></i></a>
                    </td>
                  </tr>
                  <?php endforeach?>
                 </tbody>
              </table>
            </div>
          </div>
          <?php else:?>
          <div class="alert alert-warning " role="warning">
            <strong>INFO!</strong> Tiada rekod
          </div>
          <?php endif?>
        </div>
      </div>
    </div>
  </div>
</div>
