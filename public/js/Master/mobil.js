var alertSukses = $(".alert-success");
var alertDanger = $(".alert-danger");

var table = $("#example2").DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: "/admin/mobil/dataMobil",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable: false,
            orderable: false
        },
        { data: "merkMobil", name: "merkMobil" },
        { data: "typeMobil", name: "typeMobil" },
        { data: "tahun", name: "tahun" },
        { data: "noPol", name: "noPol" },
        { data: "gambar", name: "gambar" },
        { data: "action", name: "action", searchable: false, orderable: false }
    ],
    columnDefs: [
        { targets: [0], width: "5%", orderable: false },
        {
            targets: [0, 1, 3],
            className: "text-center"
        }
    ],
    scrollX: true
});

$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });
});




function hapus(id, e) {
    e.preventDefault();
    if (confirm("Apakah Anda Yakin Menghapus Data " + id + "? ")) {
        $.ajax({
            type: "POST",
            url: "/admin/mobil/deleteMobil",
            data: {
                _method: "DELETE",
                _token: $("input[name=_token]").val(),
                id: id
            },
            success: function(response) {
                console.log(response);
                if (response.sqlResponse) {
                    alert("Data Berhasil Di Hapus");
                    table.draw();
                } else {
                    alert(response.sqlResponse);
                }
            },
            error: function(response) {
                alert(response.responseText);
            }
        });
    }
}
