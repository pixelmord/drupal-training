'use strict';

describe('Controller: ThemingBasicCtrl', function () {

  // load the controller's module
  beforeEach(module('presentationsApp'));

  var ThemingBasicCtrl,
    scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ThemingBasicCtrl = $controller('ThemingBasicCtrl', {
      $scope: scope
    });
  }));

//  it('should attach a list of awesomeThings to the scope', function () {
//    expect(scope.awesomeThings.length).toBe(3);
//  });
});
