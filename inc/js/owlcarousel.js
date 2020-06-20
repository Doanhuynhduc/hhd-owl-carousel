jQuery(document).ready(()=>{
	jQuery('.owl-carousel').owlCarousel({
        items: 1,
        loop: false,
        center: true,
        margin: 10,
        callbacks: true,
        URLhashListener: true,
        autoplayHoverPause: true,
        startPosition: 'URLHash',
        dots:false,
        responsiveClass:true,
        responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,

            },
            1000:{
                items:1,

            }

        }
    });

    jQuery('.lazy-loaded').click(function(){
        jQuery(this).addClass("active");
        jQuery('.lazy-loaded').removeClass("active");
    });

});