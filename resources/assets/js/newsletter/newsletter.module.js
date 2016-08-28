import SubscribeController from './subscribe.controller';

const template =
  '<div class="spinner" ng-show="$ctrl.requesting"></div>' +
  '<div class="message" ng-show="$ctrl.message">{{ $ctrl.message }}</div>' +
  '<form ng-submit="$ctrl.subscribe($ctrl.email)" ng-hide="$ctrl.requesting || $ctrl.message">' +
    '<input type="text" ng-model="$ctrl.email" placeholder="e-mail"/>' +
    '<i class="fa fa-angle-right"></i>' +
  '</form>';

export default angular.module('newsletter', [])
  .controller("SubscribeController", SubscribeController)
  .component('newsletterSubscribe', {
    template: template,
    controller: 'SubscribeController'
  })
  .name;
