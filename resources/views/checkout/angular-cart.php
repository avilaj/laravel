<div class="mk-checkout__app-container" ng-controller="CartController as cart">
  <div class="checkout-page__nice-message" ng-if="!cart.items().length">
    <h3 class="checkout-page__nice-message__title">
      Hey, no hay ningún producto en tu carrito.
    </h3>
    <p>
      Llénalo con algunos de
      <a ng-href="<?php echo route('products.list') ?>">nuestros productos</a>.
    </p>
  </div>
  <div ng-if="cart.items().length">
    <h2>Mi orden actual (paso 1 de 3)</h2>
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
        <tr ng-repeat="item in cart.items()">
          <td>
            <div class="checkout-page__product">
              <div class="checkout-page__product__image">
                <img
                ng-src="/{{ item.product.thumbnail.small }}"
                alt="{{item.product.title}} image" />
              </div>
              <div class="checkout-page__product__info">
                <h3 class="checkout-page__product__title">
                  {{ item.product.title }}
                </h3>
                <ul class="checkout-page__product__properties">
                  <li> <strong>Color:</strong> {{ item.reference.color.name }}
                  <li> <strong>Talle:</strong> {{ item.size.label }}
                </ul>
              </div>
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
        $ {{ cart.totalPrice() }}
      </span>
      <br>
      <br>
      <a href="<?php echo route('cart.shipping') ?>" class="mk-btn mk-btn--primary mk-full-width">Ir a configuración de envío</a>
    </div>
  </div>
</div>
