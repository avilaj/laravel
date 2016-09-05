<div ng-controller="ProductController as p" class="product-buy">
  <h3 class="mk-product-page__subtitle">Color</h3>
  <div class="product-buy__color"
      ng-class="{'disabled': !p.hasStock(reference), 'selected': p.reference.id == reference.id}"
      ng-repeat="reference in p.store.references">
      <input
      type="radio"
      name="reference"
      ng-disabled=" !p.hasStock(reference)"
      ng-value="reference"
      id="ref-{{ reference.id }}"
      ng-model="p.reference">
    <label for="ref-{{ reference.id }}"> {{ reference.name }} </label>
  </div>
  <hr class="mk-product-page__separator">
  <div class="" ng-hide="p.reference.outOfStock">
    <h3 class="mk-product-page__subtitle">Talle</h3>
    <select
      name="size"
      id="product-size"
      ng-model="p.size"
      ng-disabled=" !p.hasStock(p.reference)"
      ng-options="size as size.label disable when !p.hasStock(size) for size in p.findSizes(p.reference)"
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
      ng-disabled=" !p.hasStock(p.reference)"
      min="1"
      max="{{ p.size.stock }}"
      id="product-qty">
      <span class="product-buy__subtotal">
        $ {{p.store.product.price}}
      </span>
      <span class="product-buy__total" ng-show="p.qty > 1">
        / $ {{p.store.product.price * p.qty}}
      </span>
      <button ng-if="!p.productAdded(p.reference)"
      class="mk-btn mk-btn-buy product-buy__buy"
      id="product-add-to-cart"
      ng-disabled="!p.hasStock(p.reference) || p.addingProduct"
      ng-click="p.buy()">
        <i class="fa fa-shopping-cart"></i>
        {{ p.cart.updating ? 'Agregando...' : 'Comprar' }}
      </button>
      <a ng-if="p.productAdded(p.reference)" class="mk-btn product-buy__bought" href="<?php echo route('cart.index') ?>">
        <i class="fa fa-check"></i> Ver mi carrito
      </a>
    </div>
  </div>
</div>
