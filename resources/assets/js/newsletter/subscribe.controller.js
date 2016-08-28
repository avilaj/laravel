export default class SubscribeController {
  constructor ($http) {
    'ngInject';
    this.$http = $http;
    this.status = 'ok';
    this.requesting = false;
  }

  subscribe (email) {
    this.requesting = true;
    return this.$http.post('/subscriptions', {
      email: email
    }).then(response => {
      this.requesting = false;
      this.message = 'Excelente, pronto recibirás nuestras promos.'
    }, (err, status) => {
      this.requesting = false;
      if (err.status != 422) {
        this.message = 'Un error ha ocurrido';
      }
      if (err.data.email) {
        this.message = 'Ya te encuentras registrado.'
      }
    });
  }
}
