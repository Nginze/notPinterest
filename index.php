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

$app->router->get("/recent", function () {
  require_once __DIR__ . "./app/views/feed/index.php";
});

$app->router->get("/following", function () {
  require_once __DIR__ . "./app/views/feed/index.php";
});


$app->router->get("/myprofile", function () {
  require_once __DIR__ . "./app/views/profile/userprofile.php";
});

$app->router->get("/pin/detail", function () {
  require_once __DIR__ . "./app/views/pin/detailed.php";
});

//Authentication Routes

$app->router->get("/login", function () {
  require_once __DIR__ . "./app/views/auth/login.php";
});

$app->router->get("/signup", function () {
  require_once __DIR__ . "./app/views/auth/signup.php";
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
    "notification_url" => "http://localhost/media/upload?pinid=" . $pinid,
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
  $like = new Like;
  $reply = new Reply;
  $savedPin = new SavedPin;
  $userFollow = new UserFollow;
  $post = $pin->getPinById($pinid);
  $mycomments = $comment->getComments($pinid);
  $comments = array();
  $post['savemap'] = $savedPin->getSaveMap($pinid);
  $post['followmap'] = $userFollow->getFollowMap(); 
  foreach ($mycomments as $comment) {
    $comment['likemap'] = $like->getLikeMap($comment['commentid']);
    $comment['hasreplies'] = count($reply->getReplies($comment['commentid']));
    if (!$comment['likemap']) {
      $comment['likemap'] = array();
    }
    array_push($comments, $comment);
  }

  if (!$post['savemap']) {
    $post['savemap'] = array();
  }
  if(!$post['followmap']){
    $post['followmap'] = array();
  }

  // echo "<pre>";
  // echo var_dump($post);
  // echo var_dump($comments);
  // echo "</pre>";
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

$app->router->get("/replies", function () {
  $commentid = $_GET['commentid'];
  $reply = new Reply;
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($reply->getReplies($commentid));
});

$app->router->post("/reply", function () {
  $reply = new Reply;

  $success = $reply->createReply($_POST);
  if (!$success) {
    echo ' something went wrong';
    header(500);
  } else {
    echo 'reply created';
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

  $user = new User;
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($user->getCurrentUserProfile());
});

$app->router->get("/saved", function () {

  $savedPin = new SavedPin;
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($savedPin->getCurrentUserSaved());
});
$app->router->get("/created", function () {

  $pin = new Pin;
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($pin->getCurrentUserCreated());
});


$app->router->get("/user", function () {

  $userid = $_GET['userid'];
  $user = new User;
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($user->getUserById($userid));
});


$app->router->post("/user/follow", function () {
  $userFollow= new UserFollow;
  if (isset($_POST['followerid'])) {
    $followerid = $_POST['followerid'];
    $userFollow->checkFollow($_POST);
  }
});



$app->router->get("/search", function () {
  $query = $_GET['query'];
  $min_length = 3;
  $pin = new Pin;
  if (strlen($query) >= $min_length) {
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($pin->search($query));
  }
});







$app->router->run();
