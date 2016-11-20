

var app = angular.module('zoo', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('zooCtrl', ['$scope', '$http', '$interval', function($scope, $http, $interval) {
    $scope.animals = [];

    let reloadAnimals = function() {
        $scope.loading = true;
        $http.get('/api/animal/index').
            success(function(data, status, headers, config) {
                $scope.animals = data;
                $scope.loading = false;
            });
    }

    $scope.init = reloadAnimals;

    $scope.timeForward = function() {
        $http.get('/api/animal/hungrier').
        success(function(data, status, headers, config) {
            if (!data.game_over) {
                reloadAnimals();
            } else {
                console.log('game over');
                $interval.cancel(fastForwardInterval);
            }
        });
    }

    $scope.feed = function() {
        $http.get('/api/animal/feed').
        success(function(data, status, headers, config) {
            reloadAnimals();
        });
    }

    let fastForwardInterval = $interval($scope.timeForward, 1000);
}]);