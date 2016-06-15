    $(document).ready(function () {
        var news = $("#news-slider");
        news.owlCarousel({
            margin: 10,
            nav: true,
            navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
            navText: false,
            loop: true,
            responsive: {
              0: {
                items: 2
              },
              1000: {
                items: 4
              }
          }
        });
        var product = $(".home-product-slider");
        product.owlCarousel({
            margin: 10,
            nav: true,
            navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
            navText: false,
            loop: true,
            responsive: {
              0: {
                items: 1
              },
              600: {
                items: 3
              },
              1000: {
                items: 5
              }}
        });

        // $('.product-displayer__view').zoom({
        //     url: 'http://placehold.it/600x900/09f/fff?text=product+view'
        // });
    });