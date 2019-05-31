
    var template = Handlebars.compile($("#details-template").html());

    var table = $('#example2').DataTable({
        destroy: true,
        lengthMenu: [[5, 10, 15, -1], [5, 10, 15, "All"]],
        autowidth: true,
        serverSide: true,
        processing: false,
        ajax: '/siswa/dataSiswa',
        columns: [
            // {
            //     "className": 'details-control',
            //     "orderable": false,
            //     "searchable": false,
            //     "data": null,
            //     "defaultContent": '<button>detail</button>'
            // },
            {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'nis', name: 'nis'},
            {data: 'namaSiswa', name: 'namaSiswa'},
            {data: 'jenisKelamin', name: 'jenisKelamin'},
            {data: 'tanggalLahir', name: 'tanggalLahir'},
            {data: 'idKelas', name: 'idKelas'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ], order: [[1, 'asc']]
        ,
        initComplete: function () {
            this.api().columns([1,2,3,4,5]).every(function () {
                var column = this;
                var input = document.createElement("input");
                $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
            });
        }

    });

    $('#example2 tbody').on('click', 'td a.details-control', function (e) {
        e.preventDefault();
        var tr = $(this).closest('tr');
        var row = table.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        }
        else {
            row.child(
                template(row.data())
            ).show();
            tr.addClass('shown');
        }
    });
