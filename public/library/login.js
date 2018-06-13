let username = $('#username');
let password = $('#password');

function viewError()
{
    $('.material-field').addClass('wrong-field');
}

$('#login-button').click(function(){
    if(username.val().length > 0 && password.val().length > 0) {
        $('#login-loader').show();
    } else {
        viewError();
        return false;
    }
});