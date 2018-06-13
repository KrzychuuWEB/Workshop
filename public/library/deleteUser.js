$('#delete-button').click(function(){
    $('#modal-delete-user').css('visibility', 'visible');

    $('#cancel-delete').click(function(){
        $('#modal-delete-user').css('visibility', 'hidden');
        return false;
    });

    return false;
});