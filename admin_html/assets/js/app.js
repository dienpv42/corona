

(function ($) {
    "use strict";

    var $window = $(window),
    $body = $("body");
  
    $( ".banner" ).each(function() {
        var attr = $(this).attr('data-image-src');
        if (typeof attr !== typeof undefined && attr !== false) {
            $(this).css("background-image", "url("+attr+")");
        }
    });

    $("[data-bg-color]").each(function () {
        $(this).css("background-color", $(this).data("bg-color"));
    });

    $(document).ready(function() {

    }); 

    $(document).on('click', '.btn-sidebar', function(){
        $('.w_sidebar').toggleClass('active');
    });
    
    $(window).on("load", function () {
        AOS.init({
          easing: "ease", // default easing for AOS animations
          once: true, // whether animation should happen only once - while scrolling down
        });
    });
    

})(window.jQuery);
  