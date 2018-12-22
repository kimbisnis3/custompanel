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
  </style>
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
<section class="content">
  <div class="row">
    <div class="col-xs-4">
      <div class="box box-primary">
        <div class="box-header">
          <h4>Logo</h4>
        </div>
        <div class="box-body box-profile setlogo">
          
        </div>
        <div class="box-body" id="form-ubah" style="display: none;">
          <form id="form-ubahlogo">
          <div class="input-group">
                <input type="file" class="form-control" name="image">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger pull-right" onclick="savelogo()">Simpan</button>
                </div>
                <!-- /btn-group -->
              </div>
              <input type="text" name="path" id="pathlogo">
              <input type="hidden" name="namalogo" id="namalogo">
            </form>
        </div>
        <div class="box-footer">
          <button type="button" class="btn btn-warning btn-flat" onclick="showformlogo()" ><i class="glyphicon glyphicon-pencil"></i> Ubah Logo</button>
        </div>
      </div>
    </div>
    <div class="col-xs-8">
        <div class="box box-primary">
        <div class="box-header">
          <h4>Gambar Header</h4>
        </div>
        <div class="box-body box-profile setgambarheader">
          
        </div>
        <div class="box-body" id="form-ubah-gambarheader" style="display: none;">
          <form id="form-gambarheader">
          <div class="input-group">
                <input type="file" class="form-control" name="image">
                <div class="input-group-btn">
                  <button type="button" class="btn btn-danger pull-right" onclick="savegambarheader()">Simpan</button>
                </div>
                <!-- /btn-group -->
              </div>
              <input type="hidden" name="path" id="pathgambarheader">
              <input type="hidden" name="namagambarheader" id="namagambarheader">
            </form>
        </div>
        <div class="box-footer">
          <button type="button" class="btn btn-warning btn-flat" onclick="showformgambarheader()" ><i class="glyphicon glyphicon-pencil"></i> Ubah Gambar Header</button>
        </div>
      </div>
    </div>
  </div>
</section>  
<?php
$this->load->view('template/js');
?>

    <script type="text/javascript">
    var table;
    var idx     = -1;

    $(document).ready(function() {

      table = $('#table').DataTable({  
          "processing": true, 
          "ajax": {
              "url": "<?php echo site_url('element/setView'); ?>",
              "type": "POST",
              "data": {
              }
          },
          "columns": [
            { "data": "no" },
            { "data": "kode" },
            { "data": "nama" },
            { "data": "warna" },
            { "data": "teks" },
            { "data": "icon" },
            { "data": "ket" },
            { "data": "action" }
          ]
        });  

      setlogo();
      setgambarheader();

      });

    function reload_table(){
        table.ajax.reload(null, false); 
        idx = -1;
    }

    function showformlogo(){
      $('#form-ubah').toggle();
    }

    function setlogo()
        {
          $.ajax({
          url : "<?php echo site_url('element/setlogo')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          $('.setlogo').html('<img class=" img-responsive" style="height: 100px ";  src=".'+data.image+'"</img>');
          //$('#namalogo').val('logo');
          $('#pathlogo').val('.'+data.image);
          }
          });
        }

    function savelogo()
    {

    var formData = new FormData($('#form-ubahlogo')[0]);

    $.ajax({
    url : "<?php echo site_url('element/updatelogo')?>",
    type: "POST",
    data: formData,
    dataType: "JSON",
    mimeType: "multipart/form-data",
    contentType: false,
    cache: false,
    processData: false,

    success: function(data)
    {
    setlogo();
    showformlogo();
    }
    });
    }

    function showformlogo(){
      $('#form-ubah').toggle();
    }

    function setgambarheader()
        {
          $.ajax({
          url : "<?php echo site_url('element/setgambarheader')?>",
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
          $('.setgambarheader').html('<img class=" img-responsive" style="height: 100px ;"  src=".'+data.image+'"</img>');
          $('#namagambarheader').val('gambarheader');
          $('#pathgambarheader').val(data.image);
          }
          });
        }

    function savegambarheader()
    {

    var formData = new FormData($('#form-gambarheader')[0]);

    $.ajax({
    url : "<?php echo site_url('element/updategambarheader')?>",
    type: "POST",
    data: formData,
    dataType: "JSON",
    mimeType: "multipart/form-data",
    contentType: false,
    cache: false,
    processData: false,

    success: function(data)
    {
    setgambarheader();
    showformgambarheader();
    }
    });
    }

    function showformgambarheader(){
      $('#form-ubah-gambarheader').toggle();
    }

    function add_data()
    {
    save_method = 'add';
    $('#form-data')[0].reset();
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal-data').modal('show'); // show bootstrap modal
    $('.modal-title').text('Tambahkan Data Berkas'); // Set Title to Bootstrap modal title
    }

    function edit_data(id)
    {
    save_method = 'update';
    $('#form-data')[0].reset(); 

    $('.form-group').removeClass('has-error'); 

    $('.help-block').empty(); 

    $.ajax({
    url : "<?php echo site_url('element/edit')?>/" + id,
    type: "GET",
    dataType: "JSON",
    success: function(data)
    {
    $('[name="id"]').val(data.id);
    $('[name="nama"]').val(data.nama);
    $('[name="ket"]').val(data.keterangan);
    $('[name="path"]').val(data.path);
    $('#modal-data').modal('show'); 

    $('.modal-title').text('Edit Data Berkas'); 
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error get data from ajax');
    }
    });
    }

    function save()
    {
    $('#btnSave').text('saving...');
    $('#btnSave').attr('disabled',true);
    var url;
    
    if(save_method == 'add') {
    url   = "<?php echo site_url('element/tambah')?>"
    notif = showNotif('Sukses' ,'Data Berhasil Ditambahkan', 'success');
    } else {
    url = "<?php echo site_url('element/update')?>";
    notif = showNotif('Sukses' ,'Data Berhasil Diubah', 'success');
    }
    // ajax adding data to database
    var formData = new FormData($('#form-data')[0]);

    $.ajax({
    url : url,
    type: "POST",
    data: formData,
    dataType: "JSON",
    mimeType: "multipart/form-data",
    contentType: false,
    cache: false,
    processData: false,

    success: function(data)
    {
    if(data.sukses) //if success close modal and reload ajax table
    {
    $('#modal-data').modal('hide');
    reload_table();
    notif;
    }
    
    $('#btnSave').text('Save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    alert('Error adding / update data');
    $('#btnSave').text('save'); //change button text
    $('#btnSave').attr('disabled',false); //set button enable
    
    }
    });
    }

    function unduh_data(id){

    $.ajax({
    url : "<?php echo site_url('element/unduh')?>/"+id,
    type: "POST",
    dataType: "JSON",
    success: function(data)
    {
    var unduhdata = (data.unduh);
    if (data.sukses){
    showNotif('Sukses' ,'File Di Unduh', 'success');
    window.open("<?php echo site_url('')?>"+unduhdata);
    }else{
    showNotif('Perhatian' ,'File Tidak Ada', 'danger');
    }
    },
    error: function (jqXHR, textStatus , errorThrown)
    {
    
    }
    });

    }

    function hapus(id){

    $('.modal-title').text('Yakin Hapus Data ?');
    $('#modal-konfirmasi').modal('show');
    $('#btnHapus').attr('onclick','delete_data('+id+')');

    }

    function delete_data(id)
    {
    // ajax delete data to database
    $.ajax({
    url : "<?php echo site_url('element/hapus')?>/"+id,
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
          $( ".<?php echo $aktifgrup ?>" ).addClass( "active" );
        </script>
        <script>
          $( ".<?php echo $aktifmenu ?>" ).addClass( "active" );
        </script>
          <script>
            $(".select2").select2({
              placeholder: "-  -"
            });
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