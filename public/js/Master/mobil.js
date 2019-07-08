var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/mobil/dataMobil',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'merkMobil', name: 'merkMobil' },
        { data: 'typeMobil', name: 'typeMobil' },
        { data: 'tahun', name: 'tahun' },
        { data: 'noPol', name: 'noPol' },
        { data: 'gambar', name: 'gambar' },
        { data: 'action', name: 'action', searchable: false, orderable: false }
    ],
     columnDefs: [
        { targets: [0], width:'5%', orderable: false},
        {
            targets: [0, 1, 3],
            className: 'text-center'
        },
    ],
    "scrollX": true

});

$(document).ready(function () {

        $('[data-toggle="tooltip"]').tooltip();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('#btnSimpan').on('click', function (e) {
            var FormID = $(".form").attr("id");
            e.preventDefault();
            if (FormID == 'simpan') {
               simpanData();
            } else {
                editData();
            }
        });

});

function showTambahMobil() {
    $(".alert").hide();
    $(".form").attr("id", "simpan");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan')
    $('#modalMobil').modal('show');
}

function showEditMobil(idMobil, merkMobil, typeMobil, tahun, noPol,gambar, e) {
    event.preventDefault();
    $(".alert").hide();
    $(".form").attr("id", "edit");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Update');
    $('#idMobil').val(idMobil);
    $('#merkMobil').val(merkMobil);
    $('#typeMobil').val(typeMobil);
    $('#tahun').val(tahun);
    $('#noPol').val(noPol);
    $('#gambar').val(gambar);
    $('#modalMobil').modal('show');
}

function clearField() {
    $('#idMobil').val('');
    $('#merkMobil').val('');
    $('#typeMobil').val('');
    $('#tahun').val(tahun);
    $('#noPol').val('');
    $('#gambar').val('');
}

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/mobil/simpanMobil',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    clearField();
                    alertSukses.show().append('<p>Data Berhasil Di Tambahkan</p>');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                alertDanger.html('');
                alertSukses.html('');
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }

        },
        error: function (response) {
            console.log(response);
            alert('gagal \n' + response.responseText);
        }

    });
}

function editData() {
    var formData = new FormData($('#edit')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/mobil/editMobil',
        dataType: 'JSON',
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                if (response.sqlResponse) {
                    alert('Berhasil Merubah Data!');
                    $('#modalMobil').modal('hide');
                    table.draw();
                } else {
                    alert(response.data);
                }
            } else {
                alertDanger.hide();
                alertSukses.hide();
                alertDanger.html('');
                alertSukses.html('');
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (response) {
            alert(response.responseText);
        }

    });
}

function hapus(id, e) {
    e.preventDefault();
    if (confirm('Apakah Anda Yakin Menghapus Data ' + id + '? ')) {

        $.ajax({
            type: 'POST',
            url: '/admin/mobil/deleteMobil',
            data: {
                _method: 'DELETE',
                _token: $('input[name=_token]').val(),
                id: id
            },
            success: function (response) {
                console.log(response);
                if (response.sqlResponse) {
                    alert('Data Berhasil Di Hapus');
                    table.draw();
                } else {
                    alert(response.sqlResponse);
                }
            },
            error: function (response) {
                alert(response.responseText);
            }

        });
    }
}
