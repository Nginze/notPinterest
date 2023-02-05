<?php

require_once "./app/core/init.php";

session_start();
$app = new App;
$login = new LoginController;


$app->router->get("/", function () {
  echo "<h2>Hello world</h2>";
});

$app->router->get("/home", function () {
  echo "<p>This is home</p>";
});

$app->router->get("/login", function () {
  require_once __DIR__ . "./app/views/login.php";
});

$app->router->get("/auth/github", function(){
  require_once __DIR__ . "./app/views/github.php";
});



$app->router->run();