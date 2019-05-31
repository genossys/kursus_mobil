
$("#tambahModal").on("click", function() {
    $('#btnSimpan').text('Simpan');
    $('.formTentor').attr('id','simpan');
});

$("#editModal").on("click", function() {
    $('#btnSimpan').text('Update');
    $('.formTentor').attr('id','edit ');
});
