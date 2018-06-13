$('.material-box > span').click(function(e){
    let idHandler = e.target.id;

    $('#modal-'+idHandler).css('visibility', 'visible');

    $('.cancel-delete').click(function(){
        $('#modal-'+idHandler).css('visibility', 'hidden');
    });
});