<script>
  var mkStore = mkStore || {};
  mkStore.sizes = <?php echo json_encode($sizes); ?>;
  mkStore.colors = <?php echo json_encode($colors); ?>;
</script>
<div ng-app="mkcart" ng-controller="ProductController as p" class="product-buy">
  <div class="product-buy__colors"
      ng-class="{'disabled': !p.available(color.id)}"
      ng-repeat="color in p.colors">
    <label for="ref-{{ color.id }}"> {{ color.name }} </label>
    <input
      class="product-buy__color"
      type="radio"
      name="color"
      ng-disabled="!p.available(color.id)"
      ng-value="color"
      id="ref-{{ color.id }}"
      ng-model="p.currentColor">
  </div>
  <div class="" ng-hide="!p.available(p.currentColor.id)">
    <select
      name="size"
      id="product-size"
      ng-model="p.currentReference"
      ng-options="size as size.label for size in p.sizes | filter: {color_id: p.currentColor.id}"
      class="mk-select product-buy__size">
      <option value="">
        -- seleccione un talle --
      </option>
    </select>
    {{ p.total }}
    <input
      type="number"
      class="mk-input product-buy__qty"
      name="qty"
      ng-model="p.qty"
      step="1"
      min="1"
      max="{{ p.currentReference.total }}"
      id="product-qty">
    <button
      class="mk-btn mk-btn-buy product-buy__buy"
      id="product-add-to-cart"
      ng-click="p.addToCart(p.currentReference, p.qty)">
      <i class="fa fa-shopping-cart"></i>
      Comprar
    </button>
  </div>
</div>
