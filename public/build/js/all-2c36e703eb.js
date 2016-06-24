'use strict';

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
      } }
  });
  var productThumbnails = $('.product-displayer__thumbnails');
  productThumbnails.owlCarousel({
    margin: 10,
    nav: true,
    navClass: ['owl-prev fa fa-angle-left', 'owl-next fa fa-angle-right'],
    navText: false,
    auto: false
  });
  $('.product-displayer__view').zoom({
    url: 'http://placehold.it/600x900/09f/fff?text=product+view'
  });
});
Select.init({
  selector: '.mk-select'
});
var cart = {};
function addSizes(color) {
  var options = sizes[color];
  var el = '<option value=""> Seleccione su talle </option>';
  $.each(sizes[color], function (e, i) {
    var label = i.size;
    var qty = i.qty;
    console.log(qty);
    if (qty < 1) {
      label += " AGOTADO";
    } else {
      if (qty < 3) {
        label += " " + qty + " unidades";
      }
    }
    el += '<option value="' + e + '">' + label + '</option>';
  });
  $("#product-size-selector").html(el);
}
// function setProduct(ref) {}
function setColor(color) {
  console.log(color);
  addSizes(color);
}

function addToCart(amount) {}
// function addToCart() {}
//# sourceMappingURL=all.js.map
