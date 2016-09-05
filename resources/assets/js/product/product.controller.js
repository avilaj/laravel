import _ from 'lodash';

export default class ProductController {

  constructor ($window, CartService) {
    'ngInject';

    this.cart = CartService;
    this.store = $window.mkStore;
    this.qty = 1;
    this.bought = [];
    this.store.references.map((ref)=> this.addStock(ref));
    this.reference = this.getAvailableReference();
  }

  productAdded(reference) {
    return _.includes(this.bought, this.reference.id);
  }

  buy() {
    let reference_id = this.reference.id;
    return this.cart.update(reference_id, this.size.size_id, this.qty)
    .then( r => this.bought.push(reference_id))
  }

  getAvailableReference() {
    return this.store.references.filter(this.hasStock)[0];
  }

  sum (prev, item) {
    return prev + item.stock  * 1;
  };

  addStock(reference) {
    let stock = this.findSizes(reference).reduce(this.sum, 0);

    reference.stock = stock;
    return reference;
  }

  matchesReference (referenceId) {
    return (item) => {
      return referenceId == item.reference_id;
    };
  }

  findSizes (reference) {
    if (!reference) return [];
    return this.store.sizes.filter(this.matchesReference(reference.id));
  }

  hasStock(entity) {
    return !!entity && (entity.stock * 1) > 0;
  }

}
