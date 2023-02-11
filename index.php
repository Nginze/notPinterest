<?php

require_once "./app/core/init.php";

session_start();
$app = new App;
$user= new User;

  
$app->router->get("/", function () {
  echo "<h2>Hello world</h2>";
});

//Authentication Routes

$app->router->get("/login", function () {
  require_once __DIR__ . "./app/views/auth/login.php";
});

$app->router->get("/auth/github", function(){
  require_once __DIR__ . "./app/views/auth/github.php";
});


//App Routes
$app->router->get("/home", function () {
  $pin= new Pin;
  $q = $pin->getUserFeed(1);
  while($row = $q->fetch()){
    echo "<p>".$row['pintitle']."</p>";
    echo "<p>".$row['pindesc']."</p>";
    echo "<img src =".$row['imgurl']."/>";
  }
});

$app->router->get("/create", function () {
  require_once __Dir__ . "./app/views/pin/create.php";
});

$app->router->post("/create", function() {
  $data = $_POST;  
  $pin= new Pin;
  $q =$pin->createPin($data);
  echo 'not validated yet';
});

$app->router->get("/pin", function(){
  $pinid = $_GET['pinid'];
  $pin = new Pin;
  $comment = new Comment;
  $post = $pin->getPinById($pinid);
  $comments = $comment->getComments($pinid);

  require_once __DIR__ . "./app/views/pin/detailed.php"; 
 
});

$app->router->post("/like", function (){
  // $commentid = $_POST['commentid'];
  // echo $commentid;
  // $like = new Like;
  // $like->checkLike($commentid);
});

$app->router->post("/comment", function(){

});

$app->router->post("/pin/save", function(){

});


$app->router->post("/profile/update", function (){

});


$app->router->get("/profile", function (){

});

$app->router->get("/user", function(){

});

$app->router->post("/user/follow", function(){

});




$app->router->run();