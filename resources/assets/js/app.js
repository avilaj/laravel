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

  var cart = {};
  var select = document.getElementById("product-size");
  var qty = document.getElementById("product-qty");

  function addSizes (colorId) {
    var options = sizes;
    var selection = [];
    for (var i = 0; i < options.length; i++) {
      var ref = options[i]
      if (ref.color_id == colorId) {
        selection.push(ref);
      }
    }
    for (var i = 0; i < selection.length; i++) {
      var size = selection[i];
      var option = document.createElement("option");
      option.value = size.id;
      var label = size.label;
      if (size.total == "0") {
        label += " AGOTADO";
        option.disabled = true;
      }
      option.innerText = label;
      select.appendChild(option);
    }
  }

  function setColor(color) {
    $(select).html('');
    $(select).attr('value', '');
    $(select).append('<option> Seleccione su talle </option>')
    addSizes(color);
  }

  function addToCart() {
    var product = select.value;
    var quantity = qty.value;
    $.get('/check-out/add', {'reference_id': product, 'qty': quantity}).done(function (data) {
      $(".cart-product-count").html("("+data.products+")");
    });
  }
  $('input:radio[name=color]:first').click();
  // function addToCart() {}
