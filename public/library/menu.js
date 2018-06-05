$('#open-account-menu').click(function(e){
    let menu = 'open-account-menu';
    e.stopPropagation();

    $('.account-menu').toggle();

    $(':not(#'+menu+')').click(function(){
        $('.account-menu').hide();
    });
});

let open = false;

$('#open-menu-left').click(function(e){
    e.stopPropagation();

    if(open === true) {
        $('.menu-left').css({
            'visibility': 'hidden',
            'left': '-100%',
        });
        open = false;
    } else {
        $('.menu-left').css({
            'visibility': 'visible',
            'left': '0',
        });
        open = true;
    }

    $(':not(#open-menu-left)').click(function(){
        $('.menu-left').css({
            'visibility': 'hidden',
            'left': '-100%',
        });
        open = false;
    });
});

let dataTitle = $('.container').data('title');
let arrayTitle = [];

$('.menu-left > ol > li').find('a').each(function(){
    arrayTitle.push(this.id);
});

for(let i = 0; i < arrayTitle.length; i++) {
    if(dataTitle === arrayTitle[i]) {
        let thisIdHanlder = '#'+arrayTitle[i];
        $(thisIdHanlder).css('background-color', '#f3f3f3');
    }
}