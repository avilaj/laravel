$(document).ready( ()=> {
  let Slider = (selector, responsive) => {
    let element = $(selector);
    element.owlCarousel({
      margin: 10,
      nav: true,
      navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
      navText: false,
      loop: true,
      responsive: responsive
    });
  }

  Slider("#news-slider", {
    0:{items: 2},
    1000: {items: 4}
  });

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

class CartController {
  constructor (CartService) {
    'ngInject';
    this.delegate = CartService;
  }

  totalPrice () {
    let items = this.items();
    let sum  = (a, b) => a * 1 + b * 1;
    let getSubtotal = (item) => item.price * 1 * item.qty * 1;
    let prices = items.map(getSubtotal);
    let total = prices.reduce(sum, 0);

    return total;
  }

  items() {
    return this.delegate.items();
  }

  remove(item, index) {
    this.delegate.remove(item, index);
  }

}

class ProductController {

  constructor ($window, CartService) {
    'ngInject';

    this.cart = CartService;
    this.store = $window.mkStore;
    this.qty = 1;

    this.store.references.map((ref)=> this.addStock(ref));
    this.reference = this.getAvailableReference();
  }

  buy() {
    return this.cart.update(this.reference.id, this.size.size_id, this.qty);
  }

  getAvailableReference() {
    return this.store.references.filter(this.hasStock)[0];
  }

  sum (prev, item) {
    return prev + item.stock  * 1;
  };

  addStock(reference) {
    let stock = this.findSizes(reference).reduce(this.sum, 0);

    reference.stock = stock;
    return reference;
  }

  matchesReference (referenceId) {
    return (item) => {
      return referenceId == item.reference_id;
    };
  }

  findSizes (reference) {
    if (!reference) return [];
    return this.store.sizes.filter(this.matchesReference(reference.id));
  }

  hasStock(entity) {
    return !!entity && (entity.stock * 1) > 0;
  }

}

class CartService {
  constructor($http, $window) {
    'ngInject';
    this.$window = $window;
    this.$http = $http;

    this.cart = {
      qty: 0,
      items: []
    };
    this.getStatus();
  }

  items() {
    if (! this.cart) return [];
    return  this.cart.items;
  }

  getStatus() {
    return this.$http.get('/cart/status')
      .then( (response) => {
        console.log(response.data);
        this.cart = response.data;
      } );
  }

  remove(item, index) {
    this.cart.items.splice(index, 1);
    this.update(item.reference_id, item.size_id, 0);
  }

  update(reference_id, size_id, qty) {
    let data = {reference_id, size_id, qty};
    this.updating = true;
    return this.$http.post('/cart/update', data)
      .then( (response) => {
        this.cart = response.data;
        return this.cart;
      }, (err) => {
        if (err.status == 401) {
          this.$window.location.href = '/login';
        }
      })
      .then( res => {
        this.updating = false;
        return res;
      });
  }
}


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

angular.module('cart', ['services', 'mkcart-header', 'product-show'])
angular.bootstrap(document.querySelector('body'), ['cart']);

  // angular.bootstrap(document.getElementById('filtering'), ['filtering']);
