$("#tambahModal").on("click", function() {
    $('#btnSimpan').text('Simpan');
    $('.formUser').attr('id','simpan');
});

$("#editModal").on("click", function() {
    $('#btnSimpan').text('Update');
    $('.formUser').attr('id','edit ');
});
