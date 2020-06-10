var imgElt = document.querySelector('img.image');
var prdAnimation = document.querySelector('.prd');
console.log(prdAnimation);
var tl = new TimelineMax();

tl.from(imgElt, { duration: 0.5, ease: "power2.out", x: -1000 })
    .from(prdAnimation, { duration: 0.5, ease: "power2.out", x: 1000 })