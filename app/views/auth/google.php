<?php

include 'vendor/autoload.php';

$user = new User;
$config = [
    'callback' => GOOGLE_CALLBACK_URL,
    'keys' => [
        'id' => GOOGLE_CLIENT_ID,
        'secret' => GOOGLE_CLIENT_SECRET
    ]
];

$google = new Hybridauth\Provider\Google($config);
$google->authenticate();

if ($google->getUserProfile()) {
    $currentUser = $user->getUserByProviderId($google->getUserProfile()->identifier, 'google');
    if (!$currentUser) {
        $user->createUser($google->getUserProfile(), 'google');
        $currentUser = $user->getUserByProviderId($google->getUserProfile()->identifier, 'google');
    }
    $_SESSION['user'] = $currentUser;
    echo "<p>Loading....</p>";
    echo var_dump($google->getUserProfile());
    echo "<script>
        window.opener.location.replace('/notPinterest/')
        // window.close()
    </script>";
}
