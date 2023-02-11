<?php

include 'vendor/autoload.php';
$user = new User;
$config = [
    'callback' => 'http://localhost/notPinterest/auth/github',
    'keys' => ['id' => 'f211583fc0d349dfacb2', 'secret' => '31b455a76219d6973d9f755caa3cffade9513c96']
];

$github = new Hybridauth\Provider\Github($config);

$github->authenticate();

if($github->getUserProfile()){
    $_SESSION['displayName'] = $github->getUserProfile()->displayName;
    $_SESSION['userid'] = 1;
    $user->createUser($github->getUserProfile(), 'github'); 
    
    echo "<pre>";
        var_dump($github->getUserProfile());
    echo "</pre>";
    echo "<script>
        // window.close()
    </script>";
}
?>
<!-- <p style="margin-top: 2rem;">Loading....</p> -->