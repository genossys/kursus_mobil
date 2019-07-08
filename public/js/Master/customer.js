var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: '/admin/customer/dataCustomer',
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
        { data: 'username', name: 'username' },
        { data: 'email', name: 'email' },
        { data: 'nohp', name: 'nohp' },
        { data: 'alamat', name: 'alamat' },
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

function showTambahCustomer() {
    $(".form").attr("id", "simpan");
    $("#iconbtn").text(' Simpan');
    $('#modalCustomer').modal('show');
}

function showEditCustomer(username, email, nohp, alamat, e) {
    event.preventDefault();
    $(".alert").hide();
    $(".form").attr("id", "edit");
    $("#iconbtn").text(' Simpan');
    $('#oldusername').val(username);
    $('#username').val(username);
    $('#email').val(email);
    $('#alamat').val(alamat);
    $('#nohp').val(nohp);
    $('#modalCustomer').modal('show');
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
        url: '/admin/customer/simpanCustomer',
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
        url: '/admin/customer/editCustomer',
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
                    $('#modalCustomer').modal('hide');
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
            url: '/admin/customer/deleteCustomer',
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
