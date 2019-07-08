var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/tentor/dataTentor',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'namaTentor', name: 'namaTentor' },
        { data: 'tanggalLahir', name: 'tanggalLahir' },
        { data: 'biodata', name: 'biodata' },
        { data: 'foto', name: 'foto' },
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

function showTambahTentor() {
    $(".alert").hide();
    $(".form").attr("id", "simpan");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan')
    $('#modalTentor').modal('show');
}

function showEditTentor(idTentor, namaTentor, tanggalLahir, biodata, foto, e) {
    event.preventDefault();
    $(".alert").hide();
    $(".form").attr("id", "edit");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Update');
    $('#idTentor').val(idTentor);
    $('#namaTentor').val(namaTentor);
    $('#tanggalLahir').val(tanggalLahir);
    $('#biodata').val(biodata);
    $('#foto').val(foto);
    $('#modalTentor').modal('show');
}

function clearField() {
    $('#idTentor').val('');
    $('#namaTentor').val('');
    $('#biodata').val('');
    $('#foto').val('');
}

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/tentor/simpanTentor',
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
        url: '/admin/tentor/editTentor',
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
                    $('#modalTentor').modal('hide');
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
            url: '/admin/tentor/deleteTentor',
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
