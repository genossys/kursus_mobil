var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/paket/dataPaket',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'namaPaket', name: 'namaPaket' },
        { data: 'typeMobil', name: 'typeMobil' },
        { data: 'kaliPertemuan', name: 'kaliPertemuan' },
        { data: 'jadwalBuka', name: 'jadwalBuka' },
        { data: 'jadwalTutup', name: 'jadwalTutup' },
        { data: 'harga', name: 'harga' },
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

function showTambahPaket() {
    $(".alert").hide();
    $(".form").attr("id", "simpan");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Simpan')
    $('#modalPaket').modal('show');
}

function showEditPaket(idPaket, namaPaket, typeMobil, kaliPertemuan, jadwalBuka,jadwalTutup,harga, e) {
    event.preventDefault();
    $(".alert").hide();
    $(".form").attr("id", "edit");
    $("#btnSimpan").html('<i class="fa fa-floppy-o" aria-hidden="true"></i> Update');
    $('#idPaket').val(idPaket);
    $('#namaPaket').val(namaPaket);
    $('#typeMobil').val(typeMobil);
    $('#kaliPertemuan').val(kaliPertemuan);
    $('#jadwalBuka').val(jadwalBuka);
    $('#jadwalTutup').val(jadwalTutup);
    $('#harga').val(harga);
    $('#modalPaket').modal('show');
}

function clearField() {
    $('#oldusername').val('');
    $('#username').val('');
    $('#email').val('');
    $('#alamat').val('');
    $('#nohp').val('');
}

function simpanData() {
    var formData = new FormData($('#simpan')[0]);
    $.ajax({
        type: 'POST',
        url: '/admin/paket/simpanPaket',
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
        url: '/admin/paket/editPaket',
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
                    $('#modalPaket').modal('hide');
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
    Swal.fire({
        title: "Anda yakin?",
        text: "data ini akan di hapus!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus saja!"
    }).then(result => {
        if (result.value) {
            $.ajax({
                    type: 'POST',
                    url: '/admin/paket/deletePaket',
                    data: {
                        _method: 'DELETE',
                        _token: $('input[name=_token]').val(),
                        id: id
                    },
                success: function(response) {
                    console.log(response);

                    if (response.sqlResponse) {
                        Swal.fire(
                            "Deleted!",
                            "Data berhasil di hapus",
                            "success"
                        );
                        table.draw();
                    } else {
                        alert(response.sqlResponse);
                    }
                },
                error: function(response) {
                    alert("gagal \n" + response.responseText);
                }
            });
        }
    });
}
