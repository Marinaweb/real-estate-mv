jQuery(document).ready(function() {

    // Slick slider 
    jQuery('.slick_main').slick({ 
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: true,
        adaptiveHeight: true,
        speed: 1000,
        autoplay: true,
        fade: false,
        cssEase: 'linear',
        touchMove: true,
		arrows: false
    }); 


 });