'use strict';

angular.module('presentationsApp', [])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/theming-basics', {
        templateUrl: 'views/themingBasics.html',
        controller: 'ThemingBasicCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  });
