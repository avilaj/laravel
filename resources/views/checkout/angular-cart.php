<div class="" ng-app="mkcart" ng-controller="CartController as cart">
  <table>
    <thead>
      <tr>
        <th>
          Product
        </th>
        <th>
          Qty
        </th>
        <th>
          Price
        </th>
        <th>
          Subtotal
        </th>
      </tr>
    </thead>
    <tbody>
      <tr ng-repeat="item in cart.products">
        <td>
          <p><strong>{{ item.name }}</strong></p>
          <p>
            {{ item.options.color}}
            {{ item.options.size}}
          </p>
          <p><button type="button" class="remove-product" name="remove" ng-click="cart.remove(item.id, $index)" >Eliminar producto</button></p>
        </td>
        <td><input type="number" min="1" class="product-amount-input" ng-model="item.qty" ng-change="cart.updateQty(item.id, item.qty)"></td>
        <td>$ {{ item.price }}</td>
        <td>$ {{ item.price * item.qty}}</td>
      </tr>
    </tbody>
  </table>
  <div class="checkout-page__total">
    $ {{ cart.total }}
  </div>
  <a href="/check-out/proceed">Completar compra</a>
</div>
