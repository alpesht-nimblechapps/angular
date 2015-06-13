<!DOCTYPE html>
<html lang="en" ng-app="myApp">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>AngularJS Authentication App</title>
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/custom.css" rel="stylesheet">
        <link href="css/toaster.css" rel="stylesheet">
        <link href="css/ng-table.css" rel="stylesheet">
        <style>
            a {
                color: orange;
            }
            .button {
                -moz-appearance: button;
                /* Firefox */
                -webkit-appearance: button;
                /* Safari and Chrome */
                padding: 10px;
                margin: 10px;
                width: 100px;
            }
            .label-tr{
                line-height: 35px;
            }
            .input-td{
                padding: 10px 0px
            }
        </style>
        <script>
            var base_url = '<?php echo 'http://' . $_SERVER['HTTP_HOST'] . '/angular/'; ?>'
            FileAPI = {
                debug: true,
                //forceLoad: true, 
                //html5: false //to debug flash in HTML5 browsers
                //wrapInsideDiv: true, //experimental for fixing css issues
                //only one of jsPath or jsUrl.
                //jsPath: '/js/FileAPI.min.js/folder/', 
                //jsUrl: 'yourcdn.com/js/FileAPI.min.js',

                //only one of staticPath or flashUrl.
                //staticPath: '/flash/FileAPI.flash.swf/folder/'
                //flashUrl: 'yourcdn.com/js/FileAPI.flash.swf'
            };
        </script>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]><link href= "css/bootstrap-theme.css"rel= "stylesheet" >

<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    </head>
    <body ng-cloak="">
        <toaster-container toaster-options="{'time-out': 3000}"></toaster-container>
        <div class="container" style="margin-top:20px;">
            <div data-ng-view="" id="ng-view" class="slide-animation"></div>
        </div>
        
    </body>
    
    <!-- Libs -->
    <script src="js/angular-file-upload-shim.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/angular-route.min.js"></script>
    <script src="js/toaster.js"></script>
    <script src="js/angular-animate.min.js" ></script>
    <script src="js/angular-file-upload.min.js"></script>
    <script src="app/app.js"></script>
    <script src="app/data.js"></script>
    <script src="app/directives.js"></script>
    <script src="app/authCtrl.js"></script>
    <script src="app/categoryCtrl.js"></script>
    <script src="js/ng-table.js"></script>
    
</html>

