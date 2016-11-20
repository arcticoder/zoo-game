<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zoo Simulator</title>

        <!-- Angular -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular.min.js"></script>
        {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.5.8/angular-route.min.js"></script>--}}

        <!-- Application -->
        <script src="{{ URL::asset('app/js/app.js') }}"></script>

        {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">--}}
        {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/angular-ui-grid/3.2.9/ui-grid.min.css" />--}}
        <link rel="stylesheet" href="{{ URL::asset('app/css/app.css') }}" />
    </head>
    <body data-ng-app="zoo" data-ng-controller="zooCtrl" data-ng-init="init()">
        <ul>
            <li data-ng-repeat="animal in animals">
                <% animal %>
            </li>
        </ul>
        <button ng-click="timeForward()">Move time forward</button>
        <button ng-click="feed()">Feed</button>
    </body>
</html>
