$(".teksInputCash").keyup(function(){
    $('.teks_edit_change').html('Rp' + ($('.teksInputCash').val() - $('#totalSemua').val()));
});

$(':radio[name="payment"]').change(function() {
    var category = $(this).filter(':checked').val();
    $('#metode').val(category);
});