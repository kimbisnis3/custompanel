<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <?php
  $this->load->view('template/head');
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
 <?php
  $this->load->view('Hr/hasiltes/m_hasiltes');
?>          
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header bg-green">
                  
                  <div class="pull-right box-tools">
                    <button class="btn btn-default btn-sm pull-right" data-widget="collapse" data-toggle="tooltip" title="Collapse" style="margin-right: 5px;"><i class="fa fa-minus"></i></button>
                  </div>

                  <i class="fa fa-search"></i>
                  <h3 class="box-title">
                    Filter Hasil Tes
                  </h3>
                </div>
                <div class="box-body">
                  <form id="form_filter">
                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Periode Awal:</label>
                          <input type="text" class="form-control tgl" placeholder="Periode Awal" id="awal" name="awal" />
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Sampai dengan:</label>
                          <input type="text" class="form-control tgl" placeholder="Periode Akhir" id="akhir" name="akhir" />
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              <div class="box box-info">
                <div class="box-header">
                  
                        </form>
                        <button  class="btn btn-success " onclick="reload_table()"  title="Cek Data"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
                        <button <?php echo $get_i_button ?> class="btn btn-primary " onclick="load_pelamar()"  title="Cek Data"><i class="glyphicon glyphicon-user"></i> Masukan Data Pelamar</button>
                        <button class="btn " id="getkode" onclick="ambil()"><i class="glyphicon glyphicon-user" ></i> Get Kode</button>
                </div>
                <div class="box-body">               
                  <div class="table-responsive mailbox-messages">

                    <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">

                      <thead>
                        <tr>
                          <th width="2%">No.</th>
                          <th>Kode</th>
                          <th>Nama</th>
                          <th>Tanggal Tes</th>
                          <th>Arahan</th>
                          <th>Rekomendasi HR</th>
                          <th>HR</th>
                          <th>User</th>
                          <th>Rekomendasi Dir</th>
                          <th>Persetujuan</th>
                          <th>Opsi</th>
                        </tr>
                      </thead>
                      <tbody>
                          
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
          </div>
        </section>
    <?php
        $this->load->view('template/js');
        ?>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js "></script>
        <script type="text/javascript" src="//cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js "></script>
        <script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
        <script src="<?php echo base_url(); ?>assets/lte/bootstrap/js/moment.min.js"></script>
        <script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
        <script src="<?php echo base_url('assets/lte/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
        <script src="<?php echo base_url(); ?>assets/lte/plugins/daterangepicker/daterangepicker.js"></script>
        <script>
        $(function () {
          $('.tgl').datepicker({
            singleDatePicker: true,
            format: "dd-mm-yyyy",
            timePicker: false, 
            autoclose : true,
          });

          $('#awal').val(moment().subtract(1, 'months').format('DD-MM-YYYY'));
          $('#akhir').val(moment().format('DD-MM-YYYY'));
        });
    </script>
    <script type="text/javascript">
    var table;
    var tablehr;
    var tableuser;
    var idx     = -1;

    $(document).ready(function() {

      table = $('#table').DataTable({  
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/setView'); ?>",
              "type": "POST",
              "data": {
                awal  : function() { return $('#awal').val() },
                akhir  : function() { return $('#akhir').val() }
              }
          },
          "columns": [
            { "data": "no" },
            { "data": "kode" },
            { "data": "nama" },
            { "data": "tgltes" },
            { "data": "arahan" },
            { "data": "rekomendasihr" },
            { "data": "lulus" },
            { "data": "lulususer" },
            { "data": "rekomendasidir" },
            { "data": "approvaldir" },
            { "data": "action" }
          ]
        });  

      });

    $('#table tbody').on( 'click', 'tr', function () {
            if ( $(this).hasClass('selected') ) {
        $(this).removeClass('selected');
        idx = 0;
            }else {
        table.$('tr.selected').removeClass('selected');
        $(this).addClass('selected');

        if (table.row( this ).index() > -1) {
          idx = table.row( this ).index();
        }
            }
        }); 

    function ambil(){
        if (idx == -1) {

            return false;
        }

        alert(table.cell( idx, 1).data());
    }

    function reload_table(){
        table.ajax.reload(null, false);
        idx = -1;
    }

    function savehasildetail()
    {
    $('#btnSave').text('saving...');
    var url;
    
    if(save_method == 'add') {
    url = "<?php echo site_url('Hr/hasiltes/tambahdetail')?>"
    }

    if ($("#checkelementhr").length > 0){
      notif = showNotif('Sukses' ,'Data Pertanyaan Berhasil Dimuat', 'success');
    }else {
      notif = showNotif('Perhatian !! ' ,'Data Interview HR Kosong', 'danger');
    }

    // ajax adding data to database
    $.ajax({
    url : url,
    type: "POST",
    data: $('#form-ask-hr').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) //if success close modal and reload ajax table
    {
    tablehr.ajax.reload(null, false);
    $('#btnSavehr').attr('disabled','disabled');
    notif;
    }
    $('#btnSave').text('Save'); //change bu
    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasilz[]"]').val(data.kode);
    },
    });
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    $('#btnSave').text('save'); 
    
    }
    });
    }

    function savehasildetailuser()
    {
    var url;
    
    if(save_method == 'add') {
    url = "<?php echo site_url('Hr/hasiltes/tambahdetailuser')?>"
    }

    if ($("#checkelement").length > 0){
      notif = showNotif('Sukses' ,'Data Pertanyaan Berhasil Dimuat', 'success');
    }else {
      notif = showNotif('Perhatian !! ' ,'Data Interview Sesuai Arahan Tidak Ada di Master Interview', 'danger');
    }

    $.ajax({
    url : url,
    type: "POST",
    data: $('#form-ask').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 

    {
    tableuser.ajax.reload(null, false);
    $('#btnSaveuser').attr('disabled','disabled');
    notif;
    }
    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasilz[]"]').val(data.kode);
    },
    });
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    }
    });
    }

    function save_ubah_penilaian()
    {

    $('#btn-ubah-penilaian').text('saving...');

    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/ubah_penilaian')?>/",
    type: "POST",
    data: $('#form-ubah-jawaban').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses)
    {
    $('#modal-data-pertanyaan').modal('hide');
    reload_table();

    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }
    
    $('#btn-ubah-penilaian').text('Save'); //change button text //set button enable
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    }
    });
    }

    function delete_penilaian()
    {

    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/delete_penilaian')?>/",
    type: "POST",
    data: $('#form-ubah-jawaban').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses)
    {
    showtombolhr(id);
    tablehr.ajax.reload(null, false);
    reload_table();

    showNotif('Sukses' ,'Data Berhasil Dihapus', 'success');
    }
    
    $('#btn-ubah-penilaian').text('Save'); 
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    
    }
    });
    }

    function delete_penilaian_user()
    {

    $('#btn-ubah-penilaian').text('saving...');

    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/delete_penilaian_user')?>/",
    type: "POST",
    data: $('#form-ubah-jawaban-user').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses)
    {
    showtomboluser(id);
    tableuser.ajax.reload(null, false);
    reload_table();

    showNotif('Sukses' ,'Data Berhasil Dihapus', 'success');
    }
    
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    
    }
    });
    }

    function save_ubah_penilaian_user()
    {

    $('#btn-ubah-penilaian').text('saving...');

    // ajax adding data to database
    id = $('[name="id-for-getkode"]').val();

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/ubah_penilaian_user')?>/",
    type: "POST",
    data: $('#form-ubah-jawaban-user').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses)
    {
    $('#modal-data-pertanyaan-user').modal('hide');
    reload_table();
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    
    }
    });
    }

    function showtombolhr(id)
    {
      //show button muat pertanyaan
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getshowtombol')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      if(data.show) {
        $('#btnSavehr').removeAttr('disabled','disabled');
      }
      if(data.noshow) {
        $('#btnSavehr').attr('disabled','disabled');
      }
    },
    });
    }

    function showtomboluser(id)
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getshowtomboluser')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
      if(data.show) {
        $('#btnSaveuser').removeAttr('disabled','disabled');
      }
      if(data.noshow) {
        $('#btnSaveuser').attr('disabled','disabled');
      }
    },
    });
    }

    function detail(kode){

    window.open("<?php echo site_url('Hr/hasiltes/detailtes')?>/"+kode);
    }

    function tambah_hasil_hr(id){

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasil[]"]').val(data.kode);

    },
    });
    
    showtombolhr(id);
    $('[name="ref_hasil[]"]').val();

    save_method = 'add';

    //$('#modal-data-pertanyaan').modal('show');

    //$('.modal-title').text('Daftar Hasil');
    $('#tab-ask-hr').attr('style','display : none');
    $('#btn-ubah-penilaian').attr('onclick','save_ubah_penilaian()');
    $('#btn-delete-penilaian').attr('onclick','delete_penilaian()');
    $('[name="id-for-getkode"]').val(''+id+'');

    tablehr = $('#tablehr').DataTable({ 
          "lengthMenu": [[-1], ["All"]],
          "destroy": true,
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/setViewHr'); ?>/" + id,
              "type": "POST",
          },
          "language": {
          "emptyTable": "Nilai Interview belum di Input"
        },
          "columns": [
            { "data": "no" },
            { "data": "pertanyaan" },
            { "data": "jawaban" }
          ]
        });

    tableaskhr = $('#tableaskhr').DataTable({ 
          "lengthMenu": [[-1], ["All"]],
          "destroy": true,
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/getaskhr'); ?>/" + id,
              "type": "POST",
          },
          "columns": [
            { "data": "ref_hasil" },
            { "data": "ref_pertanyaan" },
            { "data": "pertanyaan" }
          ]
        });

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasilz[]"]').val(data.kode);
    
    },
    });

    }

    function tambah_hasil_user(id){

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasiluser[]"]').val(data.kode);

    },
    });

    showtomboluser(id);

    $('[name="ref_hasiluser[]"]').val();

    save_method = 'add';

    //$('#modal-data-pertanyaan-user').modal('show');
    //$('.modal-title').text('Daftar Hasil');
    $('#tab-ask-user').attr('style','display : none');
    $('#btn-ubah-penilaian-user').attr('onclick','save_ubah_penilaian_user()');
    $('#btn-delete-penilaian-user').attr('onclick','delete_penilaian_user()');
    $('[name="id-for-getkode"]').val(''+id+'');

    tableuser = $('#tableuser').DataTable({ 
          "lengthMenu": [[-1], ["All"]],
          "destroy": true,
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/setViewUser'); ?>/" + id,
              "type": "POST",
          },
          "language": {
          "emptyTable": "Nilai Interview belum di Input"
        },
          "columns": [
            { "data": "no" },
            { "data": "pertanyaan" },
            { "data": "jawaban" }
          ]
        });

    tableask = $('#tableask').DataTable({ 
          "lengthMenu": [[-1], ["All"]],
          "destroy": true,
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/getask'); ?>/" + id,
              "type": "POST",
          },
          "columns": [
            { "data": "ref_hasiluser" },
            { "data": "ref_pertanyaanuser" },
            { "data": "pertanyaan" }
          ]
        });

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/getkode')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="ref_hasiluserz[]"]').val(data.kode);
    
    },
    });

    }

    function lulus_hr(id)
    {

    save_method = 'update';
    $('#form-lulus')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/lulus_hr')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    
    $('#id').val(data.id);
    $('#lulus').val(data.lulus);
    $('#teshr').val(data.teshr);
    $('#rekomendasihr').val(data.rekomendasihr);
    $('#komentarhr').val(data.komentarhr);
    $('#koresponden').val(data.koresponden);
    tambah_hasil_hr(id);
    $('#modal-lulus').modal('show');
    $('#save_komentar_hr').attr('onclick','save_komentar_hr()');
    $('#save_koresponden').attr('onclick','save_koresponden()'); 
    $('#save_hr').attr('onclick','save_nilai_hr()');
    //$('.modal-title').text('Penilaian HR'); 
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function save_nilai_hr()
    {
    // ajax adding data to database
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/lulus_hr_update')?>",
    type: "POST",
    data: $('#form-lulus').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 
    {
    table.ajax.reload(null, false);
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    //$('#modal-lulus').modal('hide'); 
    }}
    });
  }

  function load_pelamar()
  {
    $('.modal-title').text('Daftar Pelamar Ikut Tes');
    $('#modal-pelamar').modal('show');
    $('#btn-simpan-pelamar').attr('onclick','simpan_pelamar()');
    tablepelamar = $('#tablepelamar').DataTable({ 
          "lengthMenu": [[-1], ["All"]],
          "destroy": true,
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('Hr/hasiltes/load_pelamar'); ?>/" ,
              "type": "POST",
          },
          "language": {
          "emptyTable": "Data Kosong"
        },
          "columns": [
            { "data": "no" },
            { "data": "nama" },
            { "data": "tglmasuk" },
            { "data": "posisi" },
            { "data": "arahan" },
            { "data": "tgltes" },
            { "data": "action" }
          ]
        });
  }

  function tambahpelamar(id){
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/tambahpelamar')?>/"+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
    showNotif('Sukses' ,'Pelamar Ditambah', 'success');
    reload_table();
    tablepelamar.ajax.reload(null, false);
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error');
    }
    });
  }

    function simpan_pelamar(){

    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/simpanpelamar')?>/",
    type: "POST",
    data: $('#form-tambah-pelamar').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses)
    {
    $('#modal-pelamar').modal('hide');
    reload_table();

    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    
    }
    });

    }

    function lulus_user(id)
    {
    save_method = 'update';
    $('#form-lulus-user')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty(); 
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/lulus_hr')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    
    $('#iduser').val(data.id);
    $('#lulususer').val(data.lulususer);
    $('#tesuser').val(data.tesuser);
    $('#komentaruser').val(data.komentaruser);
    $('#save_komentar_user').attr('onclick','save_komentar_user()');
    $('#modal-lulus-user').modal('show'); 
    tambah_hasil_user(id);
    $('#save_user').attr('onclick','save_nilai_user()');
    //$('.modal-title').text('Penilaian User'); 
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function save_nilai_user()
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/lulus_user_update')?>",
    type: "POST",
    data: $('#form-lulus-user').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 
    {
    table.ajax.reload(null, false);
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    //$('#modal-lulus-user').modal('hide'); 
    }}
    });
    }

    function save_komentar_hr()
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/komentarhr')?>",
    type: "POST",
    data: $('#form-komentar-hr').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 
    {
    table.ajax.reload(null, false);
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }}
    });
    }

    function save_komentar_user()
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/komentaruser')?>",
    type: "POST",
    data: $('#form-komentar-user').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 
    {
    table.ajax.reload(null, false);
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }}
    });
    }

    function save_koresponden()
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/koresponden')?>",
    type: "POST",
    data: $('#form-koresponden').serialize(),
    dataType: "JSON",
    success: function(data)
    {
    if(data.sukses) 
    {
    table.ajax.reload(null, false);
    showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }}
    });
    }

    function hapus(id){

    $('.modal-title').text('Yakin Void Data ?');
    $('#modal-konfirmasi').modal('show');
    $('#btnHapus').attr('onclick','delete_data('+id+')');

    }

    function delete_data(id)
    {
    $.ajax({
    url : "<?php echo site_url('Hr/hasiltes/hapus')?>/"+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
    //if success reload ajax table
    $('#modal-konfirmasi').modal('hide');
    showNotif('Sukses' ,'Data Berhasil Dihapus', 'success');
    reload_table();
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error deleting data');
    }
    });
    
    }  

  </script>
  <script>
  $( "#toggle-hr" ).click(function() {
    $( "#tab-ask-hr" ).toggle();
  });
  $( "#toggle-user" ).click(function() {
    $( "#tab-ask-user" ).toggle();
  });
  </script>
          <script>
            $("#agen").select2({
              placeholder: "- Status -"
            });
        </script>
        <script>
          $( ".<?php echo $aktifmenu ?>" ).addClass( "active" );
        </script>
        <script>
        $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
        });
        </script>
       
        <?php
        $this->load->view('template/sidebar_theme');
        ?>

  </body>
</html>