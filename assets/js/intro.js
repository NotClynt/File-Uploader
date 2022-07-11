document.getElementById("cover-i").style.visibility = "visible";
document.getElementById("logo").style.transform = "translateY(-500%)";

setTimeout(function () {
    document.getElementById("cover-i").style.transitionDuration = "0.9s";
    document.getElementById("cover-i").style.transform = "translateY(100%)";
    document.getElementById("links").style.opacity = "0";
    setTimeout(function () {
        document.getElementById('cover-i').hidden = true;
        document.getElementById("logo").style.transitionDuration = "0.7s";
        document.getElementById("links").style.transitionDuration = "0.7s";
        document.getElementById("logo").style.transform = "translateX(0%)";
        document.getElementById("links").style.opacity = "1";
    }, 800);
}, 200);
