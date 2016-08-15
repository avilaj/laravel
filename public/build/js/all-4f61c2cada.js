'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

$(document).ready(function () {
  var Slider = function Slider(selector, responsive) {
    var element = $(selector);
    element.owlCarousel({
      margin: 10,
      nav: true,
      navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
      navText: false,
      loop: true,
      responsive: responsive
    });
  };

  Slider("#news-slider", {
    0: { items: 2 },
    1000: { items: 4 }
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

  var createImage = function createImage(src) {
    return $('<img src=' + src + '>');
  };

  var setZoom = function setZoom(medium, large) {
    var container = $('.product-displayer__view');
    container.trigger('zoom.destroy');
    container.html('');
    container.append(createImage(medium));
    container.zoom({
      url: large
    });
  };

  var productDisplayerThumbnails = $('.product-displayer__thumbnails');
  productDisplayerThumbnails.on('click', 'img', function (ev) {
    setZoom(ev.target.dataset.medium, ev.target.dataset.large);
  });
  $('.product-displayer__thumbnails img').first().trigger('click');
});

var CartController = function () {
  function CartController(CartService) {
    'ngInject';

    _classCallCheck(this, CartController);

    this.delegate = CartService;
  }

  _createClass(CartController, [{
    key: 'totalPrice',
    value: function totalPrice() {
      var items = this.items();
      var sum = function sum(a, b) {
        return a * 1 + b * 1;
      };
      var getSubtotal = function getSubtotal(item) {
        return item.price * 1 * item.qty * 1;
      };
      var prices = items.map(getSubtotal);
      var total = prices.reduce(sum, 0);

      return total;
    }
  }, {
    key: 'items',
    value: function items() {
      return this.delegate.items();
    }
  }, {
    key: 'remove',
    value: function remove(item, index) {
      this.delegate.remove(item, index);
    }
  }]);

  return CartController;
}();

var ProductController = function () {
  function ProductController($window, CartService) {
    'ngInject';

    var _this = this;

    _classCallCheck(this, ProductController);

    this.cart = CartService;
    this.store = $window.mkStore;
    this.qty = 1;

    this.store.references.map(function (ref) {
      return _this.addStock(ref);
    });
    this.reference = this.getAvailableReference();
  }

  _createClass(ProductController, [{
    key: 'buy',
    value: function buy() {
      return this.cart.update(this.reference.id, this.size.size_id, this.qty);
    }
  }, {
    key: 'getAvailableReference',
    value: function getAvailableReference() {
      return this.store.references.filter(this.hasStock)[0];
    }
  }, {
    key: 'sum',
    value: function sum(prev, item) {
      return prev + item.stock * 1;
    }
  }, {
    key: 'addStock',
    value: function addStock(reference) {
      var stock = this.findSizes(reference).reduce(this.sum, 0);

      reference.stock = stock;
      return reference;
    }
  }, {
    key: 'matchesReference',
    value: function matchesReference(referenceId) {
      return function (item) {
        return referenceId == item.reference_id;
      };
    }
  }, {
    key: 'findSizes',
    value: function findSizes(reference) {
      if (!reference) return [];
      return this.store.sizes.filter(this.matchesReference(reference.id));
    }
  }, {
    key: 'hasStock',
    value: function hasStock(entity) {
      return !!entity && entity.stock * 1 > 0;
    }
  }]);

  return ProductController;
}();

var CartService = function () {
  function CartService($http, $window) {
    'ngInject';

    _classCallCheck(this, CartService);

    this.$window = $window;
    this.$http = $http;

    this.cart = {
      qty: 0,
      items: []
    };
    this.getStatus();
  }

  _createClass(CartService, [{
    key: 'items',
    value: function items() {
      if (!this.cart) return [];
      return this.cart.items;
    }
  }, {
    key: 'getStatus',
    value: function getStatus() {
      var _this2 = this;

      return this.$http.get('/cart/status').then(function (response) {
        console.log(response.data);
        _this2.cart = response.data;
      });
    }
  }, {
    key: 'remove',
    value: function remove(item, index) {
      this.cart.items.splice(index, 1);
      this.update(item.reference_id, item.size_id, 0);
    }
  }, {
    key: 'update',
    value: function update(reference_id, size_id, qty) {
      var _this3 = this;

      var data = { reference_id: reference_id, size_id: size_id, qty: qty };
      this.updating = true;
      return this.$http.post('/cart/update', data).then(function (response) {
        _this3.cart = response.data;
        return _this3.cart;
      }, function (err) {
        if (err.status == 401) {
          _this3.$window.location.href = '/login';
        }
      }).then(function (res) {
        _this3.updating = false;
        return res;
      });
    }
  }]);

  return CartService;
}();

angular.module('services', []).service('CartService', CartService);

angular.module('mkcart-header', ['services']).controller('cartHeaderController', ['CartService', function (CartService) {
  this.qty = function () {
    return CartService.items().length;
  };
}]).component('cartHeader', {
  template: 'Mi carrito ({{ $ctrl.qty() }}) <i class="fa fa-shopping-cart"></i>',
  controller: 'cartHeaderController'
});

angular.module('product-show', ['services']).controller('ProductController', ['$window', 'CartService', ProductController]).controller('CartController', CartController);

angular.module('cart', ['services', 'mkcart-header', 'product-show']);
angular.bootstrap(document.querySelector('body'), ['cart']);

// angular.bootstrap(document.getElementById('filtering'), ['filtering']);
//# sourceMappingURL=all.js.map
