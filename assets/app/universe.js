    var table;
    var idx = -1;

    $(document).ready(function() {

        table = $('#table').DataTable({
            "processing": true,
            "ajax": {
                "url": "<?php echo site_url('armada/setView'); ?>",
                "type": "POST",
                "data": {}
            },
            "columns": [{
                "data": "no"
            }, {
                "data": "kode"
            }, {
                "data": "title"
            }, {
                "data": "image"
            }, {
                "data": "artikel"
            }, {
                "data": "ket"
            }, {
                "data": "action"
            }]
        });


    });

    function reload_table() {
        table.ajax.reload(null, false);
        idx = -1;
    }

    function add_data() {
        save_method = 'add';
        $('#form-data')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();
        $('#modal-data').modal('show');
        $('.modal-title').text('Tambahkan Data');
    }

    function edit_data(id) {
        save_method = 'update';
        $('#form-data')[0].reset();
        $('.form-group').removeClass('has-error');
        $('.help-block').empty();

        $.ajax({
            url: "<?php echo site_url('armada/edit')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id"]').val(data.id);
                $('[name="kode"]').val(data.kode);
                $('[name="title"]').val(data.title);
                $('[name="artikel"]').val(data.artikel);
                $('[name="ket"]').val(data.ket);
                $('[name="path"]').val('.' + data.image);

                $('#modal-data').modal('show');

                $('.modal-title').text('Edit Data');

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('saving...');
        $('#btnSave').attr('disabled', true);
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('armada/tambah')?>"
            notif = showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success');
        } else {
            url = "<?php echo site_url('armada/update')?>";
            notif = showNotif('Sukses', 'Data Berhasil Diubah', 'success');
        }
        // ajax adding data to database
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
                if (data.sukses) //if success close modal and reload ajax table
                {
                    $('#modal-data').modal('hide');
                    reload_table();
                    notif;
                }

                $('#btnSave').text('Save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable

            }
        });
    }

    function unduh_data(id) {

        $.ajax({
            url: "<?php echo site_url('armada/unduh')?>/" + id,
            type: "POST",
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

            }
        });

    }

    function hapus(id) {

        $('.modal-title').text('Yakin Hapus Data ?');
        $('#modal-konfirmasi').modal('show');
        $('#btnHapus').attr('onclick', 'delete_data(' + id + ')');

    }

    function delete_data(id) {
        // ajax delete data to database
        $.ajax({
            url: "<?php echo site_url('armada/hapus')?>/" + id,
            type: "POST",
            dataType: "JSON",
            success: function(data) {
                //if success reload ajax table
                $('#modal-konfirmasi').modal('hide');
                showNotif('Sukses', 'Data Berhasil Dihapus', 'success');
                reload_table();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error deleting data');
            }
        });

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

    }