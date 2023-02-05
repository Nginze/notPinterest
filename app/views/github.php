<?php

include 'vendor/autoload.php';

$config = [
    'callback' => 'http://localhost/notPinterest/auth/github',
    'keys' => ['id' => 'f211583fc0d349dfacb2', 'secret' => '31b455a76219d6973d9f755caa3cffade9513c96']
];

$github = new Hybridauth\Provider\Github($config);

$github->authenticate();

if($github->getUserProfile()){
    $_SESSION['displayName'] = $github->getUserProfile()->displayName; 
    echo "<script>
        window.close()
    </script>";
}
// echo "<pre>"; var_dump($github->getUserProfile());
// echo "</pre>";

?>
<p style="margin-top: 2rem;">Loading....</p>