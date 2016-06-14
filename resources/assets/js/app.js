jQuery(document).ready(function ($) {
    var news = $("#news-slider");
    news.owlCarousel({
        items:4,
        loop:true,
        margin:10,
        merge:true,
        responsive:{
            678:{
                mergeFit:true
            },
            1000:{
                mergeFit:false
            }
        }
    });
    var product = $("#product-slider");
    product.owlCarousel({
        items:5,
        loop:true,
        margin:10,
        merge:true,
        responsive:{
            678:{
                mergeFit:true
            },
            1000:{
                mergeFit:false
            }
        }
    });
});
