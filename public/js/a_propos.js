var aPropos = document.querySelector('h1');
var paragraph = document.querySelector('.paragraph');

var tl = new TimelineMax();

tl.from(aPropos, {
    duration: 1,
    ease: "bounce.out",
    y: -1000
})
    .from(paragraph, {
        duration: 0.5,
        ease: "power2.out",
        y: 500
    });
