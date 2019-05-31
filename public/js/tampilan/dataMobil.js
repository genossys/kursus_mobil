
$("#tambahModal").on("click", function() {
    $('#btnSimpan').text('Simpan');
    $('.formMobil').attr('id','simpan');
});

$("#editModal").on("click", function() {
    $('#btnSimpan').text('Update');
    $('.formMobil').attr('id','edit ');
});
