import Account from './account/account';

$(document).ready( ()=> {
  Account.init();

  let Slider = (selector, responsive) => {
    let element = $(selector);
    element.owlCarousel({
      margin: 0,
      nav: true,
      navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
      navText: false,
      loop: true,
      responsive: responsive
    });
  }
  $('.mk-slideshow').owlCarousel({items: 1});
  Slider("#news-slider", {
    0:{items: 2},
    1000: {items: 4}
  });

  Slider("#home-brand-slider", {
    0: {items: 3},
    600: { items: 6},
    1000: { items: 9}
  })

  Slider(".home-product-slider", {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 5 }
  });

  var productThumbnails = $('.product-displayer__thumbnails');
  productThumbnails.owlCarousel({
    margin: 10,
    nav: true,
    navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
    navText: false,
    auto: false
  });

  let createImage = (src) => {
    return $('<img src='+src+'>');
  };

  let setZoom = (medium, large) =>  {
    let container = $('.product-displayer__view');
    container.trigger('zoom.destroy');
    container.html('');
    container.append(createImage(medium));
    container.zoom({
      url: large
    });
  };

  let productDisplayerThumbnails = $('.product-displayer__thumbnails');
  productDisplayerThumbnails.on('click', 'img', (ev) => {
    setZoom(ev.target.dataset.medium, ev.target.dataset.large);
  });
  $('.product-displayer__thumbnails img').first().trigger('click');
});


import newsletter from './newsletter/newsletter.module';

import ProductController from './product/product.controller';

import CartService from './cart/cart.service';
import CartController from './cart/cart.controller';

angular.module('services', [])
  .service('CartService', CartService)

angular.module('mkcart-header', ['services'])
  .controller('cartHeaderController', ['CartService', function (CartService) {
    this.qty = () => CartService.items().length;
  }])
  .component('cartHeader', {
    template: 'Mi carrito ({{ $ctrl.qty() }}) <i class="fa fa-shopping-cart"></i>',
    controller: 'cartHeaderController'
  });

angular.module('product-show', ['services'])
  .controller('ProductController', ['$window', 'CartService', ProductController])
  .controller('CartController', CartController)
;

angular.module('cart', ['services', 'mkcart-header', 'product-show', newsletter])
angular.bootstrap(document.querySelector('body'), ['cart']);

  // angular.bootstrap(document.getElementById('filtering'), ['filtering']);
