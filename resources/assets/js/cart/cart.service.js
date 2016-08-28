export default class CartService {
  constructor($http, $window) {
    'ngInject';
    this.$window = $window;
    this.$http = $http;

    this.cart = {
      qty: 0,
      items: []
    };
    this.getStatus();
  }

  items() {
    if (! this.cart) return [];
    return  this.cart.items;
  }

  getStatus() {
    return this.$http.get('/cart/status')
      .then( (response) => {
        console.log(response.data);
        this.cart = response.data;
      } );
  }

  remove(item, index) {
    this.cart.items.splice(index, 1);
    this.update(item.reference_id, item.size_id, 0);
  }

  update(reference_id, size_id, qty) {
    let data = {reference_id, size_id, qty};
    this.updating = true;
    return this.$http.post('/cart/update', data)
      .then( (response) => {
        this.cart = response.data;
        return this.cart;
      }, (err) => {
        if (err.status == 401) {
          this.$window.location.href = '/login';
        }
      })
      .then( res => {
        this.updating = false;
        return res;
      });
  }
}
