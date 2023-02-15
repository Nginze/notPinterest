<?php

require_once "./app/core/init.php";
require_once(__DIR__ . '/vendor/autoload.php');

use Cloudinary\Cloudinary;


session_start();

// Defualt session for testing
$_SESSION['user'] = ['userid' => 1];

$app = new App;
$user = new User;


$app->router->get("/", function () {
  require_once __DIR__ . "./app/views/feed/index.php";
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
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($q->fetchAll(PDO::FETCH_ASSOC)); 
});

$app->router->get("/create", function () {
  require_once __Dir__ . "./app/views/pin/create.php";
});

$app->router->post("/create", function () {
  $data = $_POST;
  $pin = new Pin;
  $cloudinary = new Cloudinary(
    [
      'cloud' => [
        'cloud_name' => 'chakra-me',
        'api_key'    => '298514965965219',
        'api_secret' => 'xtUkjeTX0Rgji31-w9md9iRwlw0',
      ],
    ]
  );
  $pinid = $pin->createPin($data);

  $cloudinary->uploadApi()->upload($data['imgbase64'], [
    "notification_url" => "http://localhost/media/upload?pinid=" .$pinid ,
    'public_id' => $pinid 
  ]);
  
  $imgurl = $cloudinary->image($pinid)->toUrl();
  $data = [
    "imgurl" => $imgurl 
  ];
  $pin->updatePin($pinid, $data); 
});

$app->router->post('/media/upload', function () {
  $pin = new Pin;
  $pinid = $_GET["pinid"];
  echo $pinid;
  $data = [
    "imgurl" => $_POST["secure_url"]
  ];
  $pin->updatePin($pinid, $data); 
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
