'use strict';

angular.module('presentationsApp')
  .controller('MainCtrl', function ($scope) {
    $scope.presentations = [
      {
        title: 'Theming Basics',
        href: '/theming-basics'
      }
    ];
  });
