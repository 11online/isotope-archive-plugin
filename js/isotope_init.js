jQuery(function($){
    $(window).load(function() {
 
            /*main function*/
            function portfolioIsotope() {
                var $container = $('.portfolio-content');
                $container.isotope({
                    itemSelector: '.portfolio-item'
                });
            } portfolioIsotope();
 
            /*filter*/
            $('.filter a').click(function(){
              var selector = $(this).attr('data-filter');
                $('.portfolio-content').isotope({ filter: selector });
                $(this).parents('ul').find('a').removeClass('active');
                $(this).addClass('active');
              return false;
            });
 
            /*resize*/
            var isIE8 = $.browser.msie && +$.browser.version === 8;
            if (isIE8) {
                document.body.onresize = function () {
                    portfolioIsotope();
                };
            } else {
                $(window).resize(function () {
                    portfolioIsotope();
                });
            }
 
            // Orientation change
            window.addEventListener("orientationchange", function() {
                portfolioIsotope();
            });
 
    });
});