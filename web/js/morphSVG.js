$(document).ready(function(){
// DYNAMIC SINGLE PATH SVG ANIMATION
    var tl = new TimelineMax({repeat:-1, repeatDelay:0, delay:1});
    TweenMax.set(".icon-morph-first", {fill: '#b1176b'});

    var colorCodes = {
        'eth' : '#000',
        'btc' : '#ff9200',
        'xrp' : '#0077b4',
        'iota' : '#000',
        'dash' : '#0079c2',
        'ltc': '#bababa',
        'neo': '#5ac200',
        'fct' : '#8fc0dc',
        'bat' : '#b1176b'
    };


    console.log(colorCodes);

    TweenMax.set(".icon-morph-first", {fill: '#b1176b'});

    function morphSvg(){
        var firstShape = $(".icon-morph-first"),
            shapes = $("[data-icon-morph]");

        shapes.each(function(index, el) {
            var coin = $(this).attr('data-icon-morph');
            var color = colorCodes[coin];
            console.log(color);
            if (index > 0) {
                tl.to(firstShape, 2, {morphSVG:el, fill: color, ease: Elastic.easeOut.config(1, 0.4)}, "+=2");
            }
        });
        tl.to(firstShape, 2, {morphSVG:firstShape, fill: '#b1176b', ease: Elastic.easeOut.config(1, 0.4)}, "+=2");
    }

    morphSvg();
});
