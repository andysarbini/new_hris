accordionTab();

function accordionTab() {
    var acc = document.getElementsByClassName("accordion-tab");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function () {
            this.classList.toggle("panel-open");
            var panel = this.nextElementSibling;
            if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
            }
            else {
                panel.style.maxHeight = panel.scrollHeight + "px";
            }
        });
    }
}

function mainActive() {
    var k = document.getElementById("main");
    k.classList.add("active");

    document.onclick = function(e){
        if(e.target.id !== 'main'){
            return;
        }
        closeNav();
    }
}

function mainInActive() {
    var k = document.getElementById("main");
    k.classList.remove("active");
}

function closeSideNav() {
    var panel = document.querySelectorAll(".tab-content");
    for (var l = 0; l < panel.length; l++) {
        panel[l].style.maxHeight = null;
    }
}

function openNav() {
    document.getElementById("sideNav").style.width = "360px";
    document.getElementById("main").style.marginLeft = "60px";
    mainActive();
}

function closeNav() {
    document.getElementById("sideNav").style.width = "60px";
    document.getElementById("main").style.marginLeft = "60px";
    mainInActive();
    closeSideNav();

    var collapseSideNav = document.querySelectorAll(".collapse");
    for (var e = 0; e < collapseSideNav.length; e++) {
        collapseSideNav[e].classList.remove("in");
    }
}

$(function() {
    $("img.lazy").lazyload({
        effect : "fadeIn",
        threshold: 0
    });
    $("img").lazyload({
        effect : "fadeIn",
        threshold: 0
    });
    $(".lazy").lazyload({
        effect : "fadeIn",
        threshold: 0
    });
});



