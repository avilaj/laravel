<div class="mk-checkout__app-container" ng-app="mkcart" ng-controller="CartController as cart">
  <table class="checkout-page__summary">
    <colgroup>
      <col class="checkout-page__summary__product"></col>
      <col class="checkout-page__summary__qty"></col>
      <col class="checkout-page__summary__price"></col>
      <col class="checkout-page__summary__subtotal"></col>
      <col></col>
    <thead>
      <tr>
        <th> Producto
        <th> Cantidad
        <th> Precio
        <th> Subtotal
        <th></th>
    <tbody>
      <tr ng-repeat="item in cart.products">
        <td>
          <div class="checkout-page__product">
            <h3 class="checkout-page__product__title">
              {{ item.name }}
            </h3>
            <ul class="checkout-page__product__properties">
              <li> <strong>Color:</strong> {{ item.options.color}}
              <li> <strong>Talle:</strong> {{ item.options.size}}
            </ul>
          </div>
        <td> {{ item.qty }}
        <td> $ {{ item.price }}
        <td> $ {{ item.price * item.qty}}
        <td>
          <button type="button"
            title="Quitar producto"
            class="mk-btn mk-btn--icon remove-product"
            name="remove"
            ng-click="cart.remove(item, $index)">
              <i class="fa fa-remove"></i>
          </button>
  </table>
  <div class="checkout-page__sidebar">
    Total:
    <span class="checkout-page__total">
      $ {{ cart.total }}
    </span>
    <br>
    <br>
    <a href="/check-out/proceed" class="mk-btn mk-btn--primary mk-full-width">Completar compra</a>
  </div>
</div>
