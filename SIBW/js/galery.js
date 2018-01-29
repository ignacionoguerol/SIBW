/**
 * Created by Lopeare on 15/04/2017.
 */
var slideIndex = 0;

function plusDivs(n) {
    showDivs(slideIndex += n);
}

function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("sliderImg");
    if (n == x.length) {
        slideIndex = 0;
    }
    if (n < 0) {
        slideIndex = x.length - 1
    }
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    x[x.length-1 - slideIndex].style.display = "block";
}