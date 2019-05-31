
$("#tambahModal").on("click", function() {
    $('#btnSimpan').text('Simpan');
    $('.formPaket').attr('id','simpan');
});

$("#editModal").on("click", function() {
    $('#btnSimpan').text('Update');
    $('.formPaket').attr('id','edit ');
});
