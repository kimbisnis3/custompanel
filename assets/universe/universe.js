var table;
var idx = -1;
var urlmaindata = "<?php echo site_url('') ?>" + controller + '/setView';
var urledit = "<?php echo site_url('')?>" + controller + '/edit';
var urlsave = "<?php echo site_url('')?>" + controller + '/tambah';
var urlsavefile = "<?php echo site_url('')?>" + controller + '/tambahfile';
var urlupdate = "<?php echo site_url('')?>" + controller + '/update';
var urlupdatefile = "<?php echo site_url('')?>" + controller + '/updatefile';
var urlhapus = "<?php echo site_url('')?>" + controller + '/hapus';
var urlunduh = "<?php echo site_url('')?>" + controller + '/unduh';

paceOptions = {
  elements: false,
  restartOnPushState: false,
  restartOnRequestAfter: false,
  elements: {
    selectors: ['html'],
  },
}

function conpage(titlepage, menu, groupmenu) {
    $(".title").append(titlepage);
    $("." + menu).addClass("active");
    $("." + groupmenu).addClass("active");
}

function dtb(idtb, url, data, col, des = false) {
    idtb = $('#' + idtb).DataTable({
        // "processing": true,
        // "serverSide": true,
        // "destroy": des,
        "ajax": {
            "url": url,
            "type": "POST",
            "data": data
        },
        "columns": col,
        "initComplete": function(settings, json) {
            console.log( 'Finish.' );
          }
    });
}

function reload_table(idtb) {;
    $('#' + idtb).DataTable().ajax.reload(null, false);
    idx = -1;
}

function inputmodal(modal, formname, id) {

    if (savemethod == 'add') {
        $('#' + formname)[0].reset();
        $('#' + modal).modal('show');
        $('.modal-title').text('Tambahkan Data');
    }
}

function editmodal(id, url, data, modal) {
    get = ['judul', 'artikel', 'ket'];
    $.ajax({
        url: url,
        type: "POST",
        data: data,
        dataType: "JSON",
        success: function(data) {
            $(function() {
                $.each(get, function(i, item) {
                    $('[name="' + item + '"]').val(data.item);
                });
            });
            $('#modal-data').modal('show');

            $('.modal-title').text('Edit Data');

        },
        error: function(jqXHR, textStatus, errorThrown) {
            alert('Error on process');
        }
    });
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

function save(urladd, urledit, method, data, itb) {

    if (save_method == 'add') {
        url = urladd;
    } else {
        url = urledit;
    }

    $.ajax({
        url: url,
        type: method,
        data: data,
        dataType: "JSON",
        success: function(data) {
            if (data.message = 'sukses') {
                showNotif('Sukses', 'Data Berhasil Ditambahkan', 'success');
                reload_table(idtb);
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error on process');
        }
    });
}

function savex() {
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

// minilib.get('area/', param, function(res) {
//     if (res.status == "success") {
//         $scope.area = res.data;
//     } else {
//         minilib.customAlert(500);
//     }
// })

// this.get = function(u, d, r = function() {}, i = true, rjson = true) {
//     var autorhization;
//     if ($localStorage.currentUser) {
//         autorhization = {
//             'Authorization': 'Bearer ' + $localStorage.currentUser.token
//                 /*'Authorization': $localStorage.currentUser.token*/
//         };
//         d["clId"] = $localStorage.currentUser.cl;
//         d["areaId"] = $localStorage.currentUser.area;
//         d["userId"] = $localStorage.currentUser.user;
//     } else {
//         autorhization = {};
//     }
//     $http({
//             headers: autorhization,
//             method: 'GET',
//             url: apiUrl + u,
//             ignoreLoadingBar: (!i),
//             params: d,

//         })
//         .then(function(res) {
//             if (rjson) {
//                 let mydata = RJSON.unpack(res.data);
//                 r(mydata);
//             } else {
//                 r(res.data);
//             }
//         }, function(err) {
//             switch (err.status) {
//                 case (500):
//                     customAlert("Kesalahan", "Kesalahan pengolahan data, Mohon hubungi pihak Developer.");
//                     break;
//                 case (401):
//                     customAlert("Sesi Berakhir", "Sesi login anda telah berakhir, silakan login ulang.");
//                     $rootScope.keluar();
//                     break;
//             }
//         })
// }

// $(function() {
//     CKEDITOR.replace('artikelx')
//         //$('#tugas').wysihtml5()
// })

//   $(function(){
//   $.each(column, function (i, item) {
//       $("#repeat").append("<th class='sorting' tabindex='0' aria-controls='table' rowspan='1' colspan='1' style='width: 226px;' aria-sort='ascending' aria-label=': activate to sort column descending'>"+item.field+ "</th>");
//     });
// });