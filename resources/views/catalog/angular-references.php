<script>
  var mkStore = mkStore || {};
  mkStore.price = <?php echo json_encode($product->price); ?>;
  mkStore.sizes = <?php echo json_encode($sizes); ?>;
  mkStore.colors = <?php echo json_encode($colors); ?>;
</script>
<div ng-app="mkcart" ng-controller="ProductController as p" class="product-buy">
  <h3 class="mk-product-page__subtitle">Color</h3>
  <div class="product-buy__color"
      ng-class="{'disabled': p.outOfStock, 'selected': p.currentColor == color}"
      ng-repeat="color in p.colors">
      <input
      type="radio"
      name="color"
      ng-disabled="color.outOfStock"
      ng-change="p.onColorChange()"
      ng-value="color"
      id="ref-{{ color.id }}"
      ng-model="p.currentColor">
    <label for="ref-{{ color.id }}"> {{ color.name }} </label>
  </div>
  <hr class="mk-product-page__separator">
  <div class="" ng-hide="p.currentColor.outOfStock">
    <h3 class="mk-product-page__subtitle">Talle</h3>
    <select
      name="size"
      id="product-size"
      ng-model="p.currentSize"
      ng-disabled="p.currentColor.uniqueSize || p.currentColor.outOfStock"
      ng-options="size as size.label for size in p.currentColor.sizes"
      class="mk-select product-buy__size">
      <option value="">
        -- seleccione un talle --
      </option>
    </select>
    <div class="product-select-quantity">
      <input
      type="number"
      class="mk-input product-buy__qty"
      name="qty"
      ng-model="p.qty"
      step="1"
      min="1"
      max="{{ p.currentSize.total }}"
      id="product-qty">
      <span class="product-buy__subtotal">
        $ {{p.price}}
      </span>
      <span class="product-buy__total" ng-show="p.qty > 1">
        / $ {{p.price * p.qty}}
      </span>
      <button
      class="mk-btn mk-btn-buy product-buy__buy"
      id="product-add-to-cart"
      ng-click="p.addToCart(p.currentColor, p.currentSize, p.qty)">
      <i class="fa fa-shopping-cart"></i>
      Comprar
    </button>

    </div>
  </div>
</div>
