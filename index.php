<?php

require_once "./app/core/init.php";
require_once(__DIR__ . '/vendor/autoload.php');

use Cloudinary\Cloudinary;


session_start();


$app = new App;
$user = new User;
$pin = new Pin;
$comment = new Comment;
$like = new Like;
$reply = new Reply;
$savedPin = new SavedPin;
$userFollow = new UserFollow;
$profile = $user->getCurrentUserProfile();

$cloudinary = new Cloudinary(
  [
    'cloud' => [
      'cloud_name' => 'chakra-me',
      'api_key'    => '298514965965219',
      'api_secret' => 'xtUkjeTX0Rgji31-w9md9iRwlw0',
    ],
  ]
);
/**Tabs and Pages */

$app->router->get("/", function () {
  global $user, $profile;
  require_once __DIR__ . "./app/views/feed/index.php";
});

$app->router->get("/recent", function () {
  require_once __DIR__ . "./app/views/feed/index.php";
});

$app->router->get("/following", function () {
  require_once __DIR__ . "./app/views/feed/index.php";
});


$app->router->get("/myprofile", function () {
  global $user, $profile;
  require_once __DIR__ . "./app/views/profile/userprofile.php";
});

$app->router->get("/pin", function () {
  global $pin, $comment, $like, $reply, $savedPin, $userFollow, $user, $profile;
  $pinid = $_GET['pinid'];
  $post = $pin->getPinById($pinid);
  $mycomments = $comment->getComments($pinid);
  $comments = array();
  $post['savemap'] = $savedPin->getSaveMap($pinid);
  $post['followmap'] = $userFollow->getFollowMap();
  $post['followcount'] = $userFollow->getUserFollowCount($post['userid']);
  foreach ($mycomments as $comment) {
    $refinedlikemap = array();
    $comment['likemap'] = $like->getLikeMap($comment['commentid']);
    if (!$comment['likemap']) {
      !$comment['likemap'] = array();
    }
    if (count($comment['likemap']) > 0) {
      foreach ($comment['likemap'] as $value) {
        array_push($refinedlikemap, $value);
      }
    }
    $comment['likemap'] = $refinedlikemap;
    $comment['hasreplies'] = count($reply->getReplies($comment['commentid']));
    if (!$comment['likemap']) {
      $comment['likemap'] = array();
    }
    array_push($comments, $comment);
  }

  if (!$post['savemap']) {
    $post['savemap'] = array();
  }
  if (!$post['followmap']) {
    $post['followmap'] = array();
  }

  $refinedsavemap = array();
  $refinedfollowmap = array();
  foreach ($post['savemap'] as $key => $value) {
    array_push($refinedsavemap, $value['saverid']);
  }
  $followmap = $post['followmap'];
  foreach ($followmap as $key => $value) {
    array_push($refinedfollowmap, $value);
  }
  $post['followmap'] = $refinedfollowmap;
  $post['savemap'] = $refinedsavemap;
  require_once __DIR__ . "./app/views/pin/detailed.php";
  // echo "<pre>";
  // echo var_dump($post);
  // echo var_dump($comments);
  // echo "</pre>";
});

$app->router->get("/pin/detail", function () {
  global $user, $profile;
  require_once __DIR__ . "./app/views/pin/detailed.php";
});

/** Authentication GET(Pages) Routes */

$app->router->get("/login", function () {
  require_once __DIR__ . "./app/views/auth/login.php";
});

$app->router->get("/signup", function () {
  require_once __DIR__ . "./app/views/auth/signup.php";
});

/** Authentication AJAX Routes */

$app->router->post("/login", function () {
  global $user;
  $success = $user->login($_POST);
  if ($success) {
    header('HTTP/1.1 200 OK');
    exit();
  } else {
    header('HTTP/1.1 500');
    exit();
  }
});

$app->router->post("/signup", function () {
  global $user;
  $success = $user->signUp($_POST);
  if ($success) {
    header('HTTP/1.1 200 OK');
    exit();
  } else {
    header('HTTP/1.1 500');
    exit();
  }
});

$app->router->get("/auth/github", function () {
  require_once __DIR__ . "./app/views/auth/github.php";
});

$app->router->get("/auth/google", function () {
  require_once __DIR__ . "./app/views/auth/google.php";
});


/** App AJAX Handlers GET */

$app->router->get("/home", function () {
  global $pin, $savedPin;
  $q = $pin->getUserFeed($_GET['page']);
  $feed = $q->fetchAll(PDO::FETCH_ASSOC);
  $refinedFeed = array();
  foreach ($feed as $pin) {
    $pin['savedmap'] = $savedPin->getSaveMap($pin['pinid']);
    if (!$pin['savedmap']) {
      $pin['savedmap'] = array();
    }
    array_push($refinedFeed, $pin);
  }
  // echo "<pre>"; echo var_dump($feed);
  // echo "</pre>";
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array(array("currentuser" => $_SESSION['user']['userid']), $refinedFeed));
});

$app->router->get("/replies", function () {
  global $reply;
  $commentid = $_GET['commentid'];
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($reply->getReplies($commentid));
});

$app->router->get("/profile", function () {
  global $user, $userFollow;
  $myprofile = $user->getCurrentUserProfile();
  array_push($myprofile, $userFollow->getCurrentUserFollowerCount());
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($myprofile);
});

$app->router->get("/saved", function () {
  global $savedPin;
  $feed = $savedPin->getCurrentUserSaved();
  $refinedFeed = array();
  foreach ($feed as $pin) {
    $pin['savedmap'] = $savedPin->getSaveMap($pin['pinid']);
    if (!$pin['savedmap']) {
      $pin['savedmap'] = array();
    }
    array_push($refinedFeed, $pin);
  }
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array(array("currentuser" => $_SESSION['user']['userid']), $refinedFeed));
});

$app->router->get("/created", function () {
  global $pin, $savedPin;
  $feed = $pin->getCurrentUserCreated();
  $refinedFeed = array();
  foreach ($feed as $pin) {
    $pin['savedmap'] = $savedPin->getSaveMap($pin['pinid']);
    if (!$pin['savedmap']) {
      $pin['savedmap'] = array();
    }
    array_push($refinedFeed, $pin);
  }
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode(array(array("currentuser" => $_SESSION['user']['userid']), $refinedFeed));
});


$app->router->get("/user", function () {
  global $user;
  $userid = $_GET['userid'];
  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($user->getUserById($userid));
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

/** App handlers AJAX POST */

$app->router->post("/create", function () {
  global $pin, $cloudinary;
  $data = $_POST;
  $imgurl = $data['imgurl'];
  unset($data['imgurl']);
  $pinid = $pin->createPin($data);

  $cloudinary->uploadApi()->upload($imgurl, [
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
  global $pin;
  $pinid = $_GET["pinid"];
  echo $pinid;
  $data = [
    "imgurl" => $_POST["secure_url"]
  ];
  $pin->updatePin($pinid, $data);
});


$app->router->post("/like", function () {
  global $like;
  if (isset($_POST['commentid'])) {
    $commentid = $_POST['commentid'];
    $success = $like->checkLike($_POST);
    if ($success) {
      header('HTTP/1.1 200 OK');
      exit();
    } else {
      header('HTTP/1.1 500');
      exit();
    }
  }
});

$app->router->post("/comment", function () {
  global $comment;
  $success = $comment->createComment($_POST);
  if (!$success) {
    echo 'something went wrong';
    header(500);
  } else {
    echo 'comment created';
    header(200);
  }
});


$app->router->post("/reply", function () {
  global $reply;
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
  global $savedPin;
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
  global $user, $cloudinary;
  $key = md5(microtime() . rand());
  $cloudinary->uploadApi()->upload($_POST['avatarurl'], [
    'public_id' => $key
  ]);

  $imgurl = $cloudinary->image($key)->toUrl();
  $_POST['avatarurl'] = $imgurl;
  $success = $user->updateUser($_POST);
  if (!$success) {
    echo 'something went wrong';
    header(500);
  } else {
    echo 'profile updated';
    header(200);
  }
});



$app->router->post("/user/follow", function () {
  global $userFollow;
  if (isset($_POST['followerid'])) {
    $followerid = $_POST['followerid'];
    $userFollow->checkFollow($_POST);
  }
});

// Run All Routes
$app->router->run();
