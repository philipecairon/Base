<?php
    require 'vendor/autoload.php';
    require 'config/Base.php';
    require 'config/Functions.php';

    use config\Token;

    // Use / for the main/index page.
    get('/', function(){
        echo "Seu TOKEN que pode ser usado com sessões: ".Token::randomAlnum(32);
        require "app/Views/index/index.php";
    });

    // All routes start with /
    get('/about', function(){
        echo "About page";
    });

    // Regex enabled, groups get passed to the function.
    get('/projects/([a-zA-Z0-9\-_]+)', function($project){
        echo "Project page for {$project}";
    });

    // Handle a POST request
    post('/contact', function(){
        // Handle submitted contact form.
    });

    // Checking if a route has been matched
    if (!Base::$routeProccessed) {
        echo "Fora do ar";
        // 404 page here
    }