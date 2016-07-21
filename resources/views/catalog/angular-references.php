<script>
  var mkStore = mkStore || {};
  mkStore.sizes = <?php echo json_encode($references); ?>;
  mkStore.colors = <?php echo json_encode($colors); ?>;
</script>
<div ng-app="mkcart" ng-controller="ProductController as p">
  <div class="mk-product-page__references">
    {{ p.total }}
    <div class="mk-product-page__references__color" ng-repeat="color in p.colors">
      <label for="ref-{{ color.id }}"> {{ color.name }} </label>
      <input type="radio" name="color" id="ref-{{ color.id }}" ng-model="p.currentColor">
    </div>

    <select name="size" id="product-size" ng-model="p.currentReference" ng-options="size as size.label for size in p.sizes | filter: {color_id: p.currentColor.id}" class="mk-select">
      <option value=""> -- seleccione un talle -- </option>
    </select>
  </div>
  <input type="number" name="qty" ng-model="p.qty" id="product-qty">
  <button class="mk-product-page__purchase" id="product-add-to-cart" ng-click="p.addToCart(p.currentReference, p.qty)">Comprar</button>
</div>
