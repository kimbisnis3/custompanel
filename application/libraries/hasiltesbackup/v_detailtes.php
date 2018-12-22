<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
  $this->load->Helper('id_date');
  $this->load->Helper('lulus');
  $this->load->Helper('diterima');
  ?>
  <!--tambahkan custom css disini-->
  <style type="text/css">
  td.details-control {
          background: url('<?php echo base_url(); ?>assets/details_open.png') no-repeat center center;
          cursor: pointer;
        }
        tr.shown td.details-control {
          background: url('<?php echo base_url(); ?>assets/details_close.png') no-repeat center center;
        }
        
  </style>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css ">
  <!-- Date Picker -->
  <link href="<?php echo base_url('assets/lte/plugins/datepicker/datepicker3.css') ?>" rel="stylesheet" type="text/css" />
  <!-- Daterange picker -->
  <link href="<?php echo base_url('assets/lte/plugins/daterangepicker/daterangepicker.css') ?>" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="<?php echo base_url('assets/lte/plugins/datepicker/datepicker3.css') ?>">
 <?php
  $this->load->view('template/topbar');
  $this->load->view('template/sidebar');
  ?>
        <section class="content-header">
          <h1>
            <?php echo $title; ?>
          </h1>
          <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $title; ?></li>
          </ol>
        </section>
       <!-- MODAL INPUT-->
        <!-- Modal -->
        <div class="modal fade" id="modal-hr" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <div class="box-body pad">
                  <table id="tablehr" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="1%">No.</th>
                          <th>Pertanyaan</th>
                          <th>Jawaban</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                    </table>
                </div>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
              </div>
            </div>
          </div>
          </div>
          <!-- MODAL INPUT-->
        <!-- Modal -->
          <div class="modal fade" id="modal-user" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <div class="box-body pad">
                  <table id="tableuser" class="table table-striped table-bordered" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th width="1%">No.</th>
                          <th>Pertanyaan</th>
                          <th>Jawaban</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                    </table>
                </div>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Kembali</button>
              </div>
            </div>
          </div>
          </div> 
          <div class="modal fade" id="modal-dir" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Penilaian HR</h4>
              </div>
              <div class="modal-body">
                <div class="box-body pad">
                  <form id="form-dir">
                      <input type="hidden" class="form-control" placeholder="ID" id="id" name="id" style="width: 15%;" value="" readonly="true">
                      <div class="form-group">
                        <label>Persetujuan</label>
                        <select class="form-control"  name="approvaldir" id="approvaldir">
                        <option name="p" value="">- -</option>
                        <option value="t">Disetujui</option>
                        <option value="f">Tidak Disetujui</option>
                      </select>
                      </div>
                      <div class="form-group">
                        <label>Rekomendasi Dir</label>
                        <select class="form-control" style="width: 100%; border-radius: 0px" name="rekomendasidir" id="rekomendasidir">
                            <option name="p" value="">- -</option>
                            <?php foreach ($lowongan as $p) {
                             ?>
                              <option value="<?php echo $p->kode ?>"><?php echo $p->posisi ?></option>
                            <?php }  ?>
                            </select>
                      </div>
                      <div class="form-group">
                        <textarea class="form-control" name="disposisi" id="disposisi" rows="10"></textarea>
                      </div>
                    </form>
                </div>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          <button type="button" id="btn-dir" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
          </div>
          <div class="modal fade" id="modal-rekomendasi" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
              </div>
              <div class="modal-body">
                <div class="box-body pad">
                  <form id="form-rekomendasi">
                      <input type="hidden" class="form-control" placeholder="ID" id="idrekomendasi" name="id" style="width: 15%;" value="" readonly="true">
                      <div class="form-group">
                        <label>Disarankan</label>
                        <select class="form-control" style="width: 100%; border-radius: 0px" name="disarankan" id="disarankan">
                            <option name="p" value="">- -</option>
                            <?php foreach ($lowongan as $p) {
                             ?>
                              <option value="<?php echo $p->kode ?>"><?php echo $p->posisi ?></option>
                            <?php }  ?>
                            </select>
                      </div>
                      <div class="form-group">
                        <label>Kesediaan</label>
                        <select class="form-control"  name="kesediaan" id="kesediaan">
                        <option value="">- -</option>
                        <option value="t">Bersedia</option>
                        <option value="f">Tidak Bersedia</option>
                      </select>
                      </div>
                    </form>
                </div>
              </div>
              <div class="modal-footer">
          <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
          <button type="button" id="btn-rekomendasi" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>
          </div> 
        <section class="content">
          <div class="row">
            <div class="col-md-5">
            <div class="row">
              <div class="col-md-12">
              <div class="box box-primary">
              <div class="box-header">
                  <h4>Data Pelamar</h4>
                </div>
                <div class="box-body pad">
        <table id="example1" class="table table-bordered table-striped">
          <tbody>
            <?php foreach ($datapelamar as $p) { ?>
            <input type="hidden" name="identitiy" id="identitiy" value="<?php echo $p->idhasil ?>">
            <tr>
              <th>Posisi</th><td><?php echo $p->posisi ?></td>
            </tr>
            <tr>
              <th>Tanggal Melamar</th><td><?php echo id_date($p->tglmasuk) ?></td>
            </tr>
            <tr>
              <th>Tanggal Tes</th><td><?php echo id_date($p->tgltes) ?></td>
            </tr>
            <tr>
              <th>Nama Depan</th><td><?php echo $p->nama ?></td>
            </tr>
            <tr>
              <th>Jenis Kelamin</th><td><?php echo $p->kelamin ?></td>
            </tr>
            <tr>
              <th>Alamat Rumah</th><td><?php echo $p->alamat ?></td>
            </tr>
            <tr>
              <th>Domisili</th><td><?php echo $p->domisili ?></td>
            </tr>
            <tr>
              <th>Tanggal Lahir</th><td><?php echo id_date($p->tanggallahir) ?></td>
            </tr>
            <tr>
              <th>Tempat Lahir</th><td><?php echo $p->tempatlahir ?></td>
            </tr>
            <tr>
              <th>Status Kawin</th><td><?php echo $p->statuskawin ?></td>
            </tr>
            <tr>
              <th>Agama</th><td><?php echo $p->agama ?></td>
            </tr>
            <tr>
              <th>Nomer HP</th><td><?php echo $p->notelp ?></td>
            </tr>
            <tr>
              <th>Email</th><td><?php echo $p->email ?></td>
            </tr>
            <?php }  ?>
          </tbody>

        </table>
      </div>
              </div>
              
              </div>
              <div class="col-md-12">
                <div class="box box-warning">
                <div class="box-header">
                  <h4>Rekomendasi</h4>
                </div>
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <tbody>
                      <!-- Creates the bootstrap modal where the image will appear -->
                      <tr>
                        <th>Posisi</th><td><div id="vposisi"></div></td>
                      </tr>
                      <tr>
                        <th>Disarankan</th><td><div id="vdisarakan"></div></td>
                      </tr>
                      <tr>
                        <th>Kesediaan</th><td><div id="vkesediaan"></div></td>
                      </tr>
                    </tbody>

                  </table>
                </div>
                <div class="box-footer">
                  <?php foreach ($datapelamar as $p) { ?>
                  <button <?php echo $get_u_button ?> class="btn btn-info pull-right" onclick="penempatan(<?php echo $p->idhasil; ?>)">Ubah</button>
                <?php } ?>
                </div>
                </div>
              </div>


              </div>
              </div>

              <div class="col-md-7">
              <div class="row">
              <div class="col-md-12">
                <div class="box box-info">
                <div class="box-header">
                  <h4>Hasil Penilaian (HR)</h4>
                </div>
                <div class="box-body">
                  <table id="tablehr" class="table table-bordered table-striped">
                    <tbody>

                      <?php foreach ($datapelamar as $p) { ?>
                      <tr>
                        <th>Hasil Tes Tertulis</th><td><?php echo $p->teshr ?></td>
                      </tr>
                      <tr>
                        <th>Hasil Wawancara</th><td><button class="btn btn-sm btn-primary" id="btn-hr" onclick="load_hr(<?php echo $p->idhasil ?>)"><i class="fa fa-table" aria-hidden="true"></i></button></td>
                      </tr>
                      <tr>
                        <th>Disarankan Diterima / Tidak</th><td><?php echo diterima($p->lulus) ?></td>
                      </tr>
                      <tr>
                        <th>Komentar</th><td><?php echo $p->komentarhr ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
                <div class="box-footer">
                  <?php foreach ($datapelamar as $p) { ?>
                  <button type="button" class="btn btn-success pull-right" onclick="printhr(<?php echo $p->idhasil; ?>)"><i class="fa fa-print"></i> Cetak</button>
                  <?php } ?>
                </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header">
                  <h4>Hasil Penilaian (User)</h4>
                </div>
                <div class="box-body">
                  <table id="tableuser" class="table table-bordered table-striped">
                    <tbody>
                      
                      <?php foreach ($datapelamar as $p) { ?>
                      <tr>
                        <th>Hasil Tes</th><td><?php echo $p->tesuser ?></td>
                      </tr>
                      <tr>
                        <th>Hasil Wawancara</th><td><button class="btn btn-sm btn-primary" id="btn-user" onclick="load_user(<?php echo $p->idhasil ?>)"><i class="fa fa-table" aria-hidden="true"></i></button></td>
                      </tr>
                      <tr>
                        <th>Disarankan Diterima / Tidak</th><td><?php echo diterima($p->lulususer) ?></td>
                      </tr>
                      <tr>
                        <th>Komentar</th><td><?php echo $p->komentaruser ?></td>
                      </tr>
                      <?php } ?>
                    </tbody>

                  </table>
                </div>
                <div class="box-footer">
                  <?php foreach ($datapelamar as $p) { ?>
                  <button type="button" class="btn btn-success pull-right" onclick="printuser(<?php echo $p->idhasil; ?>)"><i class="fa fa-print"></i> Cetak</button>
                  <?php } ?>
                </div>
                </div>
              </div>

              <div class="col-md-12">
                <div class="box box-danger">
                  <div class="box-header">
                  <h4>Approval Dir</h4>
                </div>
                <div class="box-body">
                  <table id="approval" class="table table-bordered table-striped">
                    <tbody>
                      <tr>

                        <th>Persetujuan</th>
                        <td><div id="vapproval"></div></td>

                        

                      </tr>
                      <tr>
                        
                        <th>Rekomendasi</th>
                        <td><div id="vrekomendasi"></div></td>

                      </tr>

                      <tr>
                        
                        <th>Keterangan</th>
                        <td><div id="vdisposisi"></div></td>

                      </tr>
                    </tbody>

                  </table>
                </div>
                <div class="box-footer">
                <?php foreach ($datapelamar as $p) { ?>
                  <button <?php echo $get_o_button ?> class="btn btn-info pull-right" onclick="approvaldirshow(<?php echo $p->idhasil; ?>)">Ubah</button>
                <?php } ?>
                </div>
              </div>
              </div>
              </div>
              </div>
              
          </div><!-- ROW -->
        </section>
    <?php
        $this->load->view('template/js');
        ?>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js "></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js "></script>
        <script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
        <script src="<?php echo base_url(); ?>assets/lte/bootstrap/js/moment.min.js"></script>
        <script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
        
        <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
        <script>
        $(document).ready(function() {
            valuerekomendasi();
            valuepaneldir();
        });
        function load_hr(id)
        {
          $('.modal-title').text('Hasil Interview HR');
          $('#modal-hr').modal('show');
          tablehr = $('#tablehr').DataTable({ 
                "destroy": true,
                "processing": true, 
                "ajax": {
                    "url": "<?php echo site_url('Hr/hasiltes/setViewHrDataOnly'); ?>/"+id ,
                    "type": "POST",
                },
                "language": {
                "emptyTable": "Data Kosong"
              },
                "columns": [
                  { "data": "no" },
                  { "data": "pertanyaan" },
                  { "data": "jawaban" }
                ]
              });
        }

        function load_user(id)
        {
          $('.modal-title').text('Hasil Interview User');
          $('#modal-user').modal('show');
          tableuser = $('#tableuser').DataTable({ 
                "destroy": true,
                "processing": true, 
                "ajax": {
                    "url": "<?php echo site_url('Hr/hasiltes/setViewUserDataOnly'); ?>/"+id ,
                    "type": "POST",
                },
                "language": {
                "emptyTable": "Data Kosong"
              },
                "columns": [
                  { "data": "no" },
                  { "data": "pertanyaan" },
                  { "data": "jawaban" }
                ]
              });
        }

        function approvaldirshow(id)
        {
          $('#form-dir')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help-block').empty(); 
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/load_approval')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          
          $('#id').val(id);
          $('#approvaldir').val(data.approvaldir);
          $('#rekomendasidir').val(data.rekomendasidir);
          $('#disposisi').val(data.disposisi);
          $('#modal-dir').modal('show'); 
          $('#btn-dir').attr('onclick','approvaldir()');
          $('.modal-title').text('Persetujuan Direktur'); 

          },
          error: function (jqXHR, textStatus , errorThrown)
          {
          alert('Error get data from ajax');
          }
          });
        }

        function approvaldir()
        {
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/approvaldir')?>",
          type: "POST",
          data: $('#form-dir').serialize(),
          dataType: "JSON",
          success: function(data)
          {
          if(data.sukses) 
          {
          showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
          $('#modal-dir').modal('hide'); 
          valuepaneldir();
          }}
          });
        }

        function penempatan(id)
        {
          $('#form-rekomendasi')[0].reset();
          $('.form-group').removeClass('has-error');
          $('.help-block').empty(); 
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/load_approval')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          
          $('#idrekomendasi').val(id);
          $('#posisi').val(data.posisi);
          $('#disarankan').val(data.rekomendasihr);
          $('#kesediaan').val(data.kesediaan);
          $('#modal-rekomendasi').modal('show'); 
          $('#btn-rekomendasi').attr('onclick','penempatanrekomendasi()');
          $('.modal-title').text('Persetujuan Pelamar'); 

          },
          error: function (jqXHR, textStatus , errorThrown)
          {
          alert('Error get data from ajax');
          }
          });
        }

        function penempatanrekomendasi()
        {
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/penempatan')?>",
          type: "POST",
          data: $('#form-rekomendasi').serialize(),
          dataType: "JSON",
          success: function(data)
          {
          if(data.sukses) 
          {
          showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
          $('#modal-rekomendasi').modal('hide'); 
          valuerekomendasi();
          }}
          });
        }

        function valuerekomendasi()
        {
          id = $('#identitiy').val();
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/load_approval')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          
          if (data.kesediaan == 't') {
          $('#vkesediaan').html('<span class="label bg-green">Bersedia</small>');
          $('#vposisi').html(data.posisi);
          $('#vdisarakan').html(data.rekhr);
          } 
          if (data.kesediaan == 'f')
          {
          $('#vkesediaan').html('<span class="label bg-red">Tidak Bersedia</small>');
          $('#vposisi').html(data.posisi);
          $('#vdisarakan').html(data.rekhr);
          }

          },
          error: function (jqXHR, textStatus , errorThrown)
          {
          alert('Error get data from ajax');
          }
          });
        }

        function valuepaneldir()
        {
          id = $('#identitiy').val();
          $.ajax({
          url : "<?php echo site_url('Hr/hasiltes/load_approval')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          
          if (data.approvaldir == 't') {
          $('#vapproval').html('<span class="label bg-green">Disetujui</small>');
          $('#vrekomendasi').html(data.rekdir);
          $('#vdisposisi').html(data.disposisi);
          } 
          if (data.approvaldir == 'f')
          {
          $('#vapproval').html('<span class="label bg-red">Tidak Disetujui</small>');
          $('#vrekomendasi').html(data.rekdir);
          $('#vdisposisi').html(data.disposisi);
          }
          if (data.approvaldir == '')
          {
          $('#vapproval').html('<span class="label bg-orange">Pending</small>');
          $('#vrekomendasi').html(data.rekdir);
          $('#vdisposisi').html(data.disposisi);
          }

          },
          error: function (jqXHR, textStatus , errorThrown)
          {
          alert('Error get data from ajax');
          }
          });
        }

        function printhr(id){
          window.open("<?php echo site_url('Hr/hasiltes/printhr')?>/"+id);
        }

        function printuser(id){
          window.open("<?php echo site_url('Hr/hasiltes/printuser')?>/"+id);
        }

        </script>
        <?php
        $this->load->view('template/sidebar_theme');
        ?>

  </body>
</html>