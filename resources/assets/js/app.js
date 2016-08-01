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

// class Bag {
//
//   constructor(products) {
//     this.selected = [] || products;
//   }
//
//   set(product, amount) {
//     let selected = {
//       id: product.id,
//       product: product,
//       qty: amount
//     }
//     this.selected.push(selected);
//     return this.selected;
//   }
//
//   remove(product) {
//
//   }
// }
//
//   var cart = {};
//   var select = document.getElementById("product-size");
//   var qty = document.getElementById("product-qty");
//
//   function addSizes (colorId) {
//     var options = sizes;
//     var selection = [];
//     for (var i = 0; i < options.length; i++) {
//       var ref = options[i]
//       if (ref.color_id == colorId) {
//         selection.push(ref);
//       }
//     }
//     for (var i = 0; i < selection.length; i++) {
//       var size = selection[i];
//       var option = document.createElement("option");
//       option.value = size.id;
//       var label = size.label;
//       if (size.total == "0") {
//         label += " AGOTADO";
//         option.disabled = true;
//       }
//       option.innerText = label;
//       select.appendChild(option);
//     }
//   }
//
//   function setColor(color) {
//     $(select).html('');
//     $(select).attr('value', '');
//     $(select).append('<option> Seleccione su talle </option>')
//     addSizes(color);
//   }
//
//   function updateCartCount(total) {
//     $(".cart-product-count").html("("+total+")");
//   }
//   function getCartCount() {
//     return $(".cart-product-count").html();
//   }
//   $('.remove-product').click(function (e) {
//     setProduct(e.target.dataset.id, 0);
//   });
//   $('.product-amount-input').change(function (e) {
//     var product = e.target.dataset.id;
//     var quantity = e.target.value;
//     setProduct(product, quantity);
//
//   });
//
//   function setProduct(product, quantity) {
//     $.get('/check-out/set', {'reference_id': product, 'qty': quantity}).done(function (data) {
//       updateCartCount(data.products);
//     });
//   }
//
//   function addToCart() {
//     var product = select.value;
//     var quantity = qty.value;
//     setProduct(product, quantity);
//     // updateCartCount(data.prsetProductoducts);
//   }
//   $('input:radio[name=color]:first').click();
//   // function addToCart() {}
//
// angular.module('filtering', [])
//   .controller('filteringCtrl', ['$scope','$location', function ($scope, $location) {
//     console.log($location);
//     let defaults = {
//       'price': '0-3000',
//       'brand': null,
//       'search': null
//     };
//     this.applyFilter = () => {
//       let params = {};
//       params.price = this.minprice + '-' + this.maxprice;
//       params.brand = this.brand;
//     }
//     this.brand = null;
//     this.minprice = 70;
//     this.maxprice = 3000;
//   }])
//   .component('priceFilter', {
//     template: ''
//   });

angular
  .module('mkcart', [])
  .service('Product', ['$http', '$window', '$rootScope', function ($http, $window, $scope) {
    this.count = $window.mkStore.productCount || 0;
    $scope.$watch(function () {
      return $window.mkStore.productCount;
    }, (value) => this.count = value)
    this.setCount = (amount) => {
      $window.mkStore = $window.mkStore || {};
      $window.mkStore.productCount = amount;
      this.count = amount;
    };
    this.getCount = function () {
      console.log('devuelve',this.count);
      return this.count;
    };
    this.add = (id, qty) => {
      let data = {'reference_id': id, 'qty': qty};
      this.count += qty;
      return $http.get('/check-out/set', {
        params: data
      })
        .then((res) => {
          return this.setCount(res.data.products)
        });
    }

  }])
  .controller('ProductController', ['$window', '$filter','Product', function ($window, $filter, Product)  {
    let self = this;

    let sumTotal = function (anterior, actual) {
      return anterior + parseInt(actual.total);
    };

    let isColor = function (color_id) {
      return function (item) {
        return item.color_id == color_id;
      };
    };

    this.available = (color_id) => {
      let total = this.sizes
        .filter(isColor(color_id))
        .reduce(sumTotal, 0);
        return total > 0;
    };
    this.price = $window.mkStore.price;
    this.colors = $window.mkStore.colors;
    this.sizes = $window.mkStore.sizes;
    this.qty = 1;
    this.availableColors = $filter('filter')(this.colors, (color) => {
      return this.available(color.id);
    });
    this.currentColor = this.availableColors[0];
    this.addToCart =  (reference, qty) => {
      Product.add(reference.id, qty);
    }
  }])
  .controller('CartController', ['$window', 'Product', function ($window, $http) {
    var self = this;
    this.products = $window.cartProducts;
    this.total = 0;

    this.remove = (id, index) => {
      self.products.splice(index, 1);
      self.updateQty(id, 0);
    };

    this.updateQty = function (id, qty) {
      var data = {'reference_id': id, 'qty': qty};
      self.updateTotal();
      return $http.get('/check-out/set', {params: data}).success( res => {
        return res;
      });
    };
    let subtotal = (item) => item.price * item.qty
    let sumar = (prev, cur) => prev + cur
    this.updateTotal = () => {
      self.total = 0;
      self.total = self.products.map(subtotal).reduce(sumar, 0);
      return self.total;
    }
    this.updateTotal();
  }])
  .controller('TotalController', ['Product', function (Product) {
    var self = this;
    this.cart = Product;
  }])
  .component('cartTotal', {
    template: "({{ cart.cart.total() }})",
    controller: "TotalController",
    controllerAs: 'cart'
  });

  angular.bootstrap(document.querySelector('.cart-product-count'), ['mkcart']);
  // angular.bootstrap(document.getElementById('filtering'), ['filtering']);
