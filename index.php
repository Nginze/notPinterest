<?php

require_once "./app/core/init.php";

session_start();

// Defualt session for testing
$_SESSION['user'] = ['userid' => 1];

$app = new App;
$user = new User;


$app->router->get("/", function () {
  echo var_dump($_SESSION['user']);
});

//Authentication Routes

$app->router->get("/login", function () {
  require_once __DIR__ . "./app/views/auth/login.php";
});

$app->router->get("/auth/github", function () {
  require_once __DIR__ . "./app/views/auth/github.php";
});

$app->router->get("/auth/google", function () {
  require_once __DIR__ . "./app/views/auth/google.php";
});


//App Routes
$app->router->get("/home", function () {
  $pin = new Pin;
  $q = $pin->getUserFeed(1);
  while ($row = $q->fetch()) {
    echo "<p>" . $row['pintitle'] . "</p>";
    echo "<p>" . $row['pindesc'] . "</p>";
    echo "<img src =" . $row['imgurl'] . "/>";
  }
});

$app->router->get("/create", function () {
  require_once __Dir__ . "./app/views/pin/create.php";
});

$app->router->post("/create", function () {
  $data = $_POST;
  $pin = new Pin;
  $q = $pin->createPin($data);
  echo 'not validated yet';
});

$app->router->get("/pin", function () {
  $pinid = $_GET['pinid'];
  $pin = new Pin;
  $comment = new Comment;
  $post = $pin->getPinById($pinid);
  $comments = $comment->getComments($pinid);

  require_once __DIR__ . "./app/views/pin/detailed.php";
});

$app->router->post("/like", function () {
  $like = new Like;
  if (isset($_POST['commentid'])) {
    $commentid = $_POST['commentid'];
    echo $commentid;
    $like->checkLike($commentid);
  }
});

$app->router->post("/comment", function () {  
  $comment = new Comment;
  $success = $comment->createComment($_POST);
  if (!$success) {
    echo 'something went wrong';
    header(500);
  } else {
    echo 'comment created';
    header(200);
  }
});

$app->router->post("/pin/save", function () {
  $savedPin = new SavedPin;
  $success = $savedPin->checkSave($_POST);
  if (!$success) {
    echo 'something went wrong';
    header(500);
  } else {
    echo 'pin saved';
    header(200);
  }
});


$app->router->post("/profile/update", function () {
});


$app->router->get("/profile", function () {
});

$app->router->get("/user", function () {
});

$app->router->post("/user/follow", function () {
});




$app->router->run();
