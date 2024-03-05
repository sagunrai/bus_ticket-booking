$(document).ready(function () {
    $(".sknav").click(function () {
        $(".sticky-side-menu").toggle();
    });

});

$(document).mouseup(function(e)
{
    var container = $(".sticky-side-menu");

    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0)
    {
        container.hide();
    }
});

$(document).ready(function () {
    $(".closeThes").click(function () {
        $(".sticky-side-menu").hide();
    });

});
$(document).ready(function () {
    $('#search-click').click(function () {
        $('#search-pop').toggle();
    });
    $('#cross-click').click(function () {
        $('#search-pop').hide();
    });

});

$(window).scroll(function () {
    if ($(this).scrollTop() > 400) {
        $(".top-sticky-head").slideDown("slow");
        $(".top-sticky-head").addClass("d-show");

    } else {
        $(".top-sticky-head").slideUp("slow");
        $(".top-sticky-head").removeClass("d-show");
    }
});

$(document).ready(function () {
    $(".toggle-menu").click(function () {
        $('#mobile-menu').toggle();
    });
});

        $('#recipeCarousel').carousel({
    interval: 10000
    })

    $('.carousel .carousel-item').each(function(){
    var minPerSlide = 3;
    var next = $(this).next();
    if (!next.length) {
    next = $(this).siblings(':first');
    }
    next.children(':first-child').clone().appendTo($(this));

    for (var i=0;i<minPerSlide;i++) {
        next=next.next();
        if (!next.length) {
            next = $(this).siblings(':first');
        }

        next.children(':first-child').clone().appendTo($(this));
    }
    });


    $(window).on('load',function(){
    var delayMs = 500; // delay in milliseconds

    setTimeout(function(){
        $('#popup-modal').modal('show');
    }, delayMs);
    });

        function getCurrentDate(){
        var activedt=new Date();
        document.getElementById("showDate").innerHTML = activedt.toString();
        }



