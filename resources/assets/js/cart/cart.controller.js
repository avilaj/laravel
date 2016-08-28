export default class CartController {
  constructor (CartService) {
    'ngInject';
    this.delegate = CartService;
  }

  totalPrice () {
    let items = this.items();
    let sum  = (a, b) => a * 1 + b * 1;
    let getSubtotal = (item) => item.price * 1 * item.qty * 1;
    let prices = items.map(getSubtotal);
    let total = prices.reduce(sum, 0);

    return total;
  }

  items() {
    return this.delegate.items();
  }

  remove(item, index) {
    this.delegate.remove(item, index);
  }

}
