var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster', 'ngFileUpload', 'ngTable']);
//var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster']);

app.config(['$routeProvider',
    function ($routeProvider) {
        $routeProvider.
                when('/login', {
                    title: 'Login',
                    templateUrl: 'partials/login.html',
                    controller: 'authCtrl'
                })
                .when('/logout', {
                    title: 'Logout',
                    templateUrl: 'partials/login.html',
                    controller: 'logoutCtrl'
                })
                .when('/signup', {
                    title: 'Signup',
                    templateUrl: 'partials/signup.html',
                    controller: 'authCtrl'
                })
                .when('/dashboard', {
                    title: 'Dashboard',
                    templateUrl: 'partials/dashboard.html',
                    controller: 'authCtrl'
                })
                .when('/category', {
                    title: 'Login',
                    templateUrl: 'partials/category.html',
                    controller: 'categoryCtrl',
                    role: '0'
                })
                .when('/categoryList', {
                    title: 'Login',
                    templateUrl: 'partials/categoryList.html',
                    controller: 'categoryCtrl',
                    role: '0'
                })
                .when('/', {
                    title: 'Login',
                    templateUrl: 'partials/login.html',
                    controller: 'authCtrl',
                    role: '0'
                })

                .otherwise({
                    redirectTo: '/login'
                });
    }])
        .run(function ($rootScope, $location, Data) {
            $rootScope.$on("$routeChangeStart", function (event, next, current) {
                $rootScope.authenticated = false;
                Data.get('session').then(function (results) {
                    if (results.iUserID) {
                        $rootScope.authenticated = true;
                        $rootScope.iUserID = results.iUserID;
                        $rootScope.vName = results.vName;
                        $rootScope.vEmail = results.vEmail;
                        var nextUrl = next.$$route.originalPath;
                        if (nextUrl == '/login' ||  nextUrl == '/') {
                            $location.path("/categoryList");
                        }
                    } else {
                        var nextUrl = next.$$route.originalPath;
                        if (nextUrl == '/signup' || nextUrl == '/login') {

                        } else {
                            $location.path("/login");
                        }
                    }
                });
            });
        });