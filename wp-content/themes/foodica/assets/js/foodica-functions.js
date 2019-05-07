/**
 * Theme functions file
 */
(function ($) {
    'use strict';

    var $document = $(document);
    var $window = $(window);


    /**
    * Document ready (jQuery)
    */
    $(function () {

        /**
         * Activate superfish menu.
         */
        $('.sf-menu').superfish({
            'speed': 'fast',
            'delay' : 0,
            'animation': {
                'height': 'show'
            }
        });

       /**
        * SlickNav
        */

       $('#menu-main-slide').slicknav({
           prependTo:'.navbar-header-main',
           allowParentLinks: true,
           closedSymbol: "",
           openedSymbol: ""
           }
       );

       /* Tag Cloud fix */
       $('.tag-cloud-link:has(.post_count)').addClass('has_sub');


        /**
         * FitVids - Responsive Videos in posts
         */
        $(".entry-content, .cover").fitVids();


        /**
         * Search form in header.
         */
        $(".sb-search").sbSearch();



    });

    $window.on('load', function() {

        /**
         * Activate main slider.
         */
        $('#slider').sllider();


    });


    $.fn.sllider = function() {
        return this.each(function () {
            var $this = $(this);

            var $slides = $this.find('.slide');

            if ($slides.length <= 1) {
                $slides.addClass('is-selected');

                return;
            }

            var flky = new Flickity('.slides', {
                cellAlign: 'center',
                contain: true,
                percentPosition: false,
                //prevNextButtons: false,
                pageDots: true,
                wrapAround: true,
                accessibility: false
            });
        });
    };


    $.fn.sbSearch = function() {
       return this.each(function() {
           new UISearch( this );
       });
    };

})(jQuery);