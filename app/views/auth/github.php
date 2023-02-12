<?php

include 'vendor/autoload.php';

$user = new User;
$config = [
    'callback' => GITHUB_CALLBACK_URL,
    'keys' => [
        'id' => GITHUB_CLIENT_ID,
        'secret' => GITHUB_CLIENT_SECRET
    ]
];

$github = new Hybridauth\Provider\Github($config);
$github->authenticate();

if ($github->getUserProfile()) {
    $currentUser = $user->getUserByProviderId($github->getUserProfile()->identifier, 'github');
    if (!$currentUser) {
        $user->createUser($github->getUserProfile(), 'github');
        $currentUser = $user->getUserByProviderId($github->getUserProfile()->identifier, 'github');
    }
    $_SESSION['user'] = $currentUser;
    echo "<pre>";
    var_dump($github->getUserProfile());
    echo "</pre>";
    echo "<script>
        // window.close()
    </script>";
}
