var alertSukses = $('.alert-success');
var alertDanger = $('.alert-danger');

$('#formtambahsiswa').on('submit', function (event) {
    event.preventDefault();
    var url = $(this).attr("action");
    $.ajax({
        url:url,
        method:"POST",
        data: new FormData($('#formtambahsiswa')[0]),
        dataType:'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success:function(data)
        {
            console.log(data);
        }
    })
});

$.get('/siswa/dataKelas', function (data) {
    $('#cmbKelas').empty();
    $.each(data, function (index, element) {
        $('#cmbKelas').append('<option>'+element.idKelas+'</option>')
    });
});


function clearSimpanSiswa() {
    
}