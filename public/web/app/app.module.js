(function (){
    "use strict";
    angular.module('myApp', []).controller('mainController', ['$scope',function ($scope) {
        $scope.greeting = 'Hola, Mundo!';
    }]);
})();