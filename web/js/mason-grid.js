$(document).ready(function(){
    console.log('running');
    $('.grid').masonry({
        // options
        itemSelector: '.grid-item',
        columnWidth: 0
    });
});