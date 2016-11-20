<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zoo Simulator</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="{{ URL::asset('app/js/app.js') }}"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ URL::asset('app/css/app.css') }}" />
    </head>
    <body data-ng-app="zoo" data-ng-controller="zooCtrl" data-ng-init="init()">
        <div class="container">
            <div class="row">
                <div data-ng-repeat="animal in animals" class="col-md-2">
                    <img
                            class="img-responsive"
                            ng-src="{{ URL::asset('img/<% animal.title %>_<% animal.state %>.png') }}"
                            alt="<% animal.label %>"
                    />
                    <% animal.label %>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <button class="btn btn-primary" ng-click="timeForward()">Move time forward</button>
                    <button class="btn btn-success" ng-click="feed()">Feed</button>
                    <button class="btn btn-warning" ng-click="revive()">Restart</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <h2 ng-if="gameState == 'game_over'">GAME OVER</h2>
                </div>
            </div>
        </container>
    </body>
</html>
