// $(document).ready(function () {

var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

var table = $('#example2').DataTable({
    // destroy     : true,
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: 'kelas/dataKelas',
    columns: [
        {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, sortable: false},
        {data: 'idKelas', name: 'idKelas'},
        {data: 'namaKelas', name: 'namaKelas'},
        {data: 'action', name: 'action', searchable: false, orderable: false}
    ]

});

// simpanDataKelas
$('#formSimpanKelas').on('submit', function (e) {
    e.preventDefault();
    var method = $(this).attr("method");
    var url = $(this).attr("action");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url,
        dataType: 'JSON',
        data: new FormData($('#formSimpanKelas')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                clearSave();
                alertSukses.show().html('<p> Berhasil Menambahkan Data ' + response.sukses.idKelas + '</p>');
                table.draw();
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);
        }

    });

});


$('#formEditKelas').on('submit', function (e) {
    e.preventDefault();
    var method = $(this).attr("method");
    var url = $(this).attr("action");
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: method,
        url: url,
        dataType: 'JSON',
        data: new FormData($('#formEditKelas')[0]),
        contentType: false,
        cache: false,
        processData: false,
        success: function (response) {
            console.log(response);
            if (response.valid) {
                $('#modaleditkelas').modal('hide');
                table.draw();
            } else {
                alertDanger.hide();
                alertSukses.hide();
                $.each(response.errors, function (key, value) {
                    alertDanger.show().append('<p>' + value + '</p>');
                });
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert(errorThrown + xhr + textStatus);

        }
    });
});

function deleteDataKelas(id) {
    if (confirm('Apakah Anda Yakin Menghapus Data ' + id)) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/kelas/hapusDataKelas',
            data: {
                _method: 'DELETE',
                _token: $('input[name=_token]').val(),
                idKelas: id
            },
            success: function (response) {
                console.log(response);
                table.draw();
            }, error: function (xhr, textStatus, errorThrown) {
                alert(xhr + textStatus + errorThrown);
            }

        });
    }
}

// });


function showDetail(id, nama) {
    clearEdit();
    $('#txtOldIdKelas').val(id);
    $('#txtIdKelasEdit').val(id);
    $('#txtNamaKelasEdit').val(nama);
    $('#modaleditkelas').modal('show');
}

function clearSave() {
    $('#txtIdKelas').val('');
    $('#txtNamaKelas').val('');
    alertDanger.hide();
    alertSukses.hide();
    alertSukses.hide();
}

function clearEdit() {
    $('#txtIdKelasEdit').val('');
    $('#txtNamaKelasEdit').val('');
    alertDanger.hide();
    alertSukses.hide();
}
