  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>LAPORAN SENARAI ANGGOTA YANG TIDAK MENJAWAB BORANG A <?= $tahun ?></h2>
          <button id="cmdWord" data-cmd="3" class="btn btn-default btn-sm pull-right" title="Cetak Word"><i class="fa fa-file-word-o"></i></button>
          <button id="cmdXls" data-cmd="2" class="btn btn-default btn-sm pull-right" title="Cetak Excel"><i class="fa fa-file-excel-o"></i></button>
          <button id="cmdPdf" data-cmd="1" class="btn btn-default btn-sm pull-right" title="Cetak PDF"><i class="fa fa-file-pdf-o"></i></button>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <table class="table table-striped table-bordered jambo_table datatable">
              <thead>
                <tr>
                  <th style="width:5%;">Bil</th>
                  <th style="width:20%;">Nama</th>
                  <th style="width:20%;">Jabatan</th>
                  <th style="width:20%;">Kumpulan Gred</th>
                  <th style="width:20%;">Skim Perkhidmatan</th>
                  <th style="width:5%;">Gred</th>
                  <th style="width:5%;">Tajuk Kursus</th>
                </tr>
              </thead>
              <tbody>
                <?php $x = 1 ?>
                <?php foreach($sen_anggota as $anggota) : ?>
                <tr>
                    <td><?= $x++ ?></td>
                    <td><?= $anggota->nama ?></td>
                    <td><?= $anggota->title ?></td>
                    <td><?= $anggota->kelas_id ?></td>
                    <td><?= $anggota->skim_id ?></td>
                    <td><?= $anggota->gred_id ?></td>
                    <td><?= $anggota->tajuk ?></td>
                </tr>
                <?php endforeach ?>
              </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
