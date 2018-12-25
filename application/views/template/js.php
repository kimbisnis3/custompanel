</div><!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b></b>
  </div>
  <strong>Copyright &copy; 2018 <a href="">My Panel </a>.</strong> All rights reserved.
</footer>
</div>
<div class="control-sidebar-bg"></div>
<script src="<?php echo base_url('assets/lte/plugins/jQuery/jQuery-2.2.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/lte/dist/js/demo.js')?>"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/notify/bootstrap-notify.js"></script>
<script src="<?php echo base_url('assets/lte/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/lte/plugins/slimScroll/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>
<script src='<?php echo base_url('assets/lte/plugins/fastclick/fastclick.min.js') ?>'></script>
<script src="<?php echo base_url('assets/lte/dist/js/app.min.js') ?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/lte/plugins/datatables/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/lte/plugins/datatables/dataTables.bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?php echo base_url('assets/lte/plugins/ajaxupload/jquery.ajaxfileupload.js')?>">
</script>
<script src="<?php echo base_url('assets/lte/plugins/select2/select2.full.min.js')?>"></script>
<script src="<?php echo base_url('assets/lte/plugins/datepicker/bootstrap-datepicker.js')?>"></script>
<script src="<?php echo base_url(); ?>assets/lte/plugins/ckeditor/ckeditor.js"></script>
<script src="<?php echo base_url('') ?>assets/lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

<script type="text/javascript">

var table;
var idx = -1;
var urlmaindata = "<?php echo site_url('') ?>" + controller + '/json';
var urledit = "<?php echo site_url('')?>" + controller + '/edit';
var urlsave = "<?php echo site_url('')?>" + controller + '/tambah';
var urlsavefile = "<?php echo site_url('')?>" + controller + '/tambahfile';
var urlupdate = "<?php echo site_url('')?>" + controller + '/update';
var urlupdatefile = "<?php echo site_url('')?>" + controller + '/updatefile';
var urlhapus = "<?php echo site_url('')?>" + controller + '/hapus';
var urlunduh = "<?php echo site_url('')?>" + controller + '/unduh';

     $(".<?php echo $aktifgrup ?>").addClass("active");
     $(".<?php echo $aktifmenu ?>").addClass("active");

    $(document).ready(function() {
    
        $('[data-toggle="tooltip"]').tooltip();

        table = $('#table').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": urlmaindata,
                "type": "POST",
                "data": {}
            },
            "columns": column 
        });


    });

    function reload_table() {
        table.ajax.reload(null, false);
        idx = -1;
    }

    function add_data() {
        save_method = 'add';
        $('#form-data')[0].reset();
        CKEDITOR.instances.artikelx.setData('');
        $('#modal-data').modal('show');
        $('.modal-title').text('Tambahkan Data');
    }

    function edit_data(id) {
        save_method = 'update';
        $('#form-data')[0].reset();

        $.ajax({
            url: urledit,
            type: "POST",
            data: {
                id: id,
            },
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="judul"]').val(data.judul);
                //$('[name="artikel"]').val(data.artikel);
                $('[name="ket"]').val(data.ket);
                $('[name="path"]').val('.' + data.gambar);
                CKEDITOR.instances.artikelx.setData(data.artikel);

                $('#modal-data').modal('show');

                $('.modal-title').text('Edit Data');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error on process');
            }
        });
    }

    function save() {
        var url;
        artikel = CKEDITOR.instances['artikelx'].getData();
        $('#artikel').val(artikel);
        if (save_method == 'add') {
            url = urlsave;
            notif = showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success');
        } else {
            url = urlupdate;
            notif = showNotif('Sukses', 'Data Berhasil Diubah', 'success');
        }

        $.ajax({
            url: url,
            type: "POST",
            data: $('#form-data').serialize(),
            dataType: "JSON",
            success: function(data) {
                if (data.sukses) {
                    $('#modal-data').modal('hide');
                    reload_table();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error on process');
            }
        });
    }

    function savefile() {

        var url;
        artikel = CKEDITOR.instances['artikelx'].getData();
        $('#artikel').val(artikel);
        if (save_method == 'add') {
            url = urlsavefile;
            notif = showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success');
        } else {
            url = urlupdatefile;
            notif = showNotif('Sukses', 'Data Berhasil Diubah', 'success');
        }

        var formData = new FormData($('#form-data')[0]);

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            mimeType: "multipart/form-data",
            contentType: false,
            cache: false,
            processData: false,

            success: function(data) {
                if (data.sukses)

                {
                    $('#modal-data').modal('hide');
                    reload_table();
                    notif;
                }

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error on process');
            }
        });
    }

    function unduh_data(id) {

        $.ajax({
            url: urlunduh,
            type: "POST",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(data) {
                var unduhdata = (data.unduh);
                if (data.sukses) {
                    showNotif('Sukses', 'File Di Unduh', 'success');
                    window.open("<?php echo site_url('')?>" + unduhdata);
                } else {
                    showNotif('Perhatian', 'File Tidak Ada', 'danger');
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error on process');
            }
        });

    }

    function hapus_data(id) {

        $('.modal-title').text('Yakin Hapus Data ?');
        $('#modal-konfirmasi').modal('show');
        $('#btnHapus').attr('onclick', 'delete_data(' + id + ')');

    }

    function delete_data(id) {
        $.ajax({
            url: urlhapus,
            type: "POST",
            dataType: "JSON",
            data: {
                id: id,
            },
            success: function(data) {
                $('#modal-konfirmasi').modal('hide');
                showNotif('Sukses', 'Data Berhasil Dihapus', 'success');
                reload_table();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error on process');
            }
        });

    }

    function showNotif(title, msg, jenis) {
        $.notify({
            title: '<strong>' + title + '</strong>',
            message: msg
        }, {
            type: jenis,
            z_index: 2000,
            allow_dismiss: true,
            delay: 10,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
        }, );
    };

    $(function() {
        CKEDITOR.replace('artikelx')
            //$('#tugas').wysihtml5()
    })

    //   $(function(){
//   $.each(column, function (i, item) {
//       $("#repeat").append("<th class='sorting' tabindex='0' aria-controls='table' rowspan='1' colspan='1' style='width: 226px;' aria-sort='ascending' aria-label=': activate to sort column descending'>"+item.field+ "</th>");
//     });
// });

</script>      