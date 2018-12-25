<?php
  $this->load->view('template/head');
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
<div class="modal fade" id="modal-data" role="dialog" data-backdrop="static">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <div class="box-body pad">
          <form id="form-data">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Judul</label>
                  <input type="hidden" name="id">
                  <input type="text" class="form-control" name="judul">
                </div>
                <div class="form-group">
                  <label>Gambar</label>
                  <input type="file" class="form-control" name="gambar" id="gambar" >
                </div>
                <div class="form-group">
                  <label>Artikel</label>
                  <textarea class="form-control" rows="7" name="artikelx" id="artikelx"></textarea>
                </div>
                <div class="form-group" style="display : none;">
                  <label>Artikel</label>
                  <textarea class="form-control" rows="7" name="artikel" id="artikel"></textarea>
                </div>
                <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" class="form-control" name="ket" >
                </div>
                <div class="form-group">
                  <input type="hidden" name="path" id="path">
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Batal</button>
        <button type="button" id="btnSave" onclick="savefile()" class="btn btn-primary btn-flat">Simpan</button>
      </div>
    </div>
  </div>
  </div>  <!-- END MODAL INPUT-->
  <div id="modal-konfirmasi" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"></h4></center>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-warning btn-flat" data-dismiss="modal">Tidak</button>
          <button type="button" id="btnHapus"  class="btn btn-danger btn-flat">Ya</button>
        </div>
      </div>
    </div>
  </div>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box box-info">
        <div class="box-header">
        </form>
        <button class="btn btn-success btn-flat" onclick="reload_table()"  title="Cek Data"><i class="glyphicon glyphicon-refresh"></i> Refresh</button>
        <button class="btn btn-warning btn-flat"onclick="add_data()" ><i class="fa fa-plus"></i> Tambah</button>
      </div>
      <div class="box-body">
        <div class="table-responsive mailbox-messages">
          <table id="table" class="table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
              <tr id="repeat">
                <th>Judul</th>
                <th>Artikel</th>
                <th>Keterangan</th>
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

<script type="text/javascript">
  var controller = 'artikel';

  var column  = [
                {
                    "data": "judul",
                    "field": "Judul"
                },
                {
                    "data": "artikel",
                    "field": "Artikel"
                },
                {
                    "data": "ket",
                    "field": "Keterangan"
                }, 
                {
                    "data": "option",
                    "field": "Opsi"
                }
            ];


</script>
        

  </body>
</html>