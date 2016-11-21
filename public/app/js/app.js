/**
 * Zoo game/simulator - Time moves forwards every hour, otherwise can be moved forward manually, which calls api/hungrier. Reload button calls api/revive, feed button calls api/feed. Game ends when all animals have perished.
 */
var app = angular.module('zoo', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
}).controller('zooCtrl', ['$scope', '$http', '$interval', function($scope, $http, $interval) {
    $scope.animals = [];
    $scope.gameState = 'game_on';

    let reloadAnimals = function() {
        $scope.loading = true;
        $http.get('/api/animal/index').
            success(function(data, status, headers, config) {
                $scope.animals = [];
                for (let animal of data.animals) {
                    let health = Math.round(animal.health * 100) + '%';
                    $scope.animals.push({
                        'title': animal.title,
                        'health': health,
                        'state': animal.state,
                        'label': health + ' ' + animal.state.replace('_', ' ')
                    });
                }
                $scope.gameState = data.game_state;
                $scope.loading = false;
            });
    }

    let playGame = function() {
        console.log('game start');
        $scope.fastForwardInterval = $interval($scope.timeForward, 1000*60*60);
    }

    $scope.init = reloadAnimals;

    $scope.timeForward = function() {
        $http.get('/api/animal/hungrier').
        success(function(data, status, headers, config) {
            $scope.gameState = data.game_state;

            if (data.game_state == 'game_on') {
                reloadAnimals();
            } else {
                console.log('game over');

                $interval.cancel($scope.fastForwardInterval);
            }
        });
    }

    $scope.feed = function() {
        $http.get('/api/animal/feed').
        success(function(data, status, headers, config) {
            reloadAnimals();
        });
    }

    $scope.revive = function() {
        $http.get('/api/animal/revive').
        success(function(data, status, headers, config) {
            reloadAnimals();
            $scope.gameState = 'game_on';
            playGame();
        });
    }

    playGame();
}]);