var alertSukses = $(".alert-success");
var alertDanger = $(".alert-danger");

var table = $("#example2").DataTable({
    lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
    autowidth: true,
    serverSide: true,
    processing: false,
    ajax: "/admin/transaksi/dataTransaksi",
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            searchable: false,
            orderable: false
        },
        { data: "noTrans", name: "noTrans" },
        { data: "idCustomer", name: "idCustomer" },
        { data: "total", name: "total" },
        { data: "tanggal", name: "tanggal" },
        { data: "batasPembayaran", name: "batasPembayaran" },
        { data: "status_bayar", name: "status_bayar" },
        { data: "status_terima", name: "status_terima" },
        {
            data: "action",
            name: "action",
            searchable: false,
            orderable: false
        }
    ],
    columnDefs: [
        { targets: [8], width: "70px", orderable: false },
        {
            targets: [0, 1, 3],
            className: "text-center"
        }
    ],
    scrollX: false
});
