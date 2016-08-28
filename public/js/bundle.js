(function e(t,n,r){function s(o,u){if(!n[o]){if(!t[o]){var a=typeof require=="function"&&require;if(!u&&a)return a(o,!0);if(i)return i(o,!0);var f=new Error("Cannot find module '"+o+"'");throw f.code="MODULE_NOT_FOUND",f}var l=n[o]={exports:{}};t[o][0].call(l.exports,function(e){var n=t[o][1][e];return s(n?n:e)},l,l.exports,e,t,n,r)}return n[o].exports}var i=typeof require=="function"&&require;for(var o=0;o<r.length;o++)s(r[o]);return s})({1:[function(require,module,exports){
'use strict';

var _newsletter = require('./newsletter/newsletter.module');

var _newsletter2 = _interopRequireDefault(_newsletter);

var _product = require('./product/product.controller');

var _product2 = _interopRequireDefault(_product);

var _cart = require('./cart/cart.service');

var _cart2 = _interopRequireDefault(_cart);

var _cart3 = require('./cart/cart.controller');

var _cart4 = _interopRequireDefault(_cart3);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

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

angular.module('services', []).service('CartService', _cart2.default);

angular.module('mkcart-header', ['services']).controller('cartHeaderController', ['CartService', function (CartService) {
  this.qty = function () {
    return CartService.items().length;
  };
}]).component('cartHeader', {
  template: 'Mi carrito ({{ $ctrl.qty() }}) <i class="fa fa-shopping-cart"></i>',
  controller: 'cartHeaderController'
});

angular.module('product-show', ['services']).controller('ProductController', ['$window', 'CartService', _product2.default]).controller('CartController', _cart4.default);

angular.module('cart', ['services', 'mkcart-header', 'product-show', _newsletter2.default]);
angular.bootstrap(document.querySelector('body'), ['cart']);

// angular.bootstrap(document.getElementById('filtering'), ['filtering']);

},{"./cart/cart.controller":2,"./cart/cart.service":3,"./newsletter/newsletter.module":4,"./product/product.controller":6}],2:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

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

exports.default = CartController;

},{}],3:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

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
      var _this = this;

      return this.$http.get('/cart/status').then(function (response) {
        console.log(response.data);
        _this.cart = response.data;
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
      var _this2 = this;

      var data = { reference_id: reference_id, size_id: size_id, qty: qty };
      this.updating = true;
      return this.$http.post('/cart/update', data).then(function (response) {
        _this2.cart = response.data;
        return _this2.cart;
      }, function (err) {
        if (err.status == 401) {
          _this2.$window.location.href = '/login';
        }
      }).then(function (res) {
        _this2.updating = false;
        return res;
      });
    }
  }]);

  return CartService;
}();

exports.default = CartService;

},{}],4:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _subscribe = require('./subscribe.controller');

var _subscribe2 = _interopRequireDefault(_subscribe);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var template = '<div class="spinner" ng-show="$ctrl.requesting"></div>' + '<div class="message" ng-show="$ctrl.message">{{ $ctrl.message }}</div>' + '<form ng-submit="$ctrl.subscribe($ctrl.email)" ng-hide="$ctrl.requesting || $ctrl.message">' + '<input type="text" ng-model="$ctrl.email" placeholder="e-mail"/>' + '<i class="fa fa-angle-right"></i>' + '</form>';

exports.default = angular.module('newsletter', []).controller("SubscribeController", _subscribe2.default).component('newsletterSubscribe', {
  template: template,
  controller: 'SubscribeController'
}).name;

},{"./subscribe.controller":5}],5:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

var SubscribeController = function () {
  function SubscribeController($http) {
    'ngInject';

    _classCallCheck(this, SubscribeController);

    this.$http = $http;
    this.status = 'ok';
    this.requesting = false;
  }

  _createClass(SubscribeController, [{
    key: 'subscribe',
    value: function subscribe(email) {
      var _this = this;

      this.requesting = true;
      return this.$http.post('/subscriptions', {
        email: email
      }).then(function (response) {
        _this.requesting = false;
        _this.message = 'Excelente, pronto recibirás nuestras promos.';
      }, function (err, status) {
        _this.requesting = false;
        if (err.status != 422) {
          _this.message = 'Un error ha ocurrido';
        }
        if (err.data.email) {
          _this.message = 'Ya te encuentras registrado.';
        }
      });
    }
  }]);

  return SubscribeController;
}();

exports.default = SubscribeController;

},{}],6:[function(require,module,exports){
'use strict';

Object.defineProperty(exports, "__esModule", {
  value: true
});

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

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

exports.default = ProductController;

},{}]},{},[1]);

//# sourceMappingURL=bundle.js.map
