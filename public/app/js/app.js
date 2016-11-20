

var app = angular.module('zoo', [],/*, ["ui.grid"]*/ function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

app.controller('zooCtrl', ['$scope', '$http', function($scope, $http) {
    $scope.animals = [];
    $scope.init = function() {
        $scope.loading = true;
        $http.get('/api/animal/index').
        success(function(data, status, headers, config) {
            $scope.animals = data;
            $scope.loading = false;
        });
    }
}]);