<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
        if(isset($_SESSION['displayName'])){

            echo $_SESSION['displayName'];
        }else{
            echo ' 
            
    <div>
        <button id="github" style="cursor:pointer;">Login with github</button>
    </div>
            ' ;
        }
             
    ?>
</body>
<script>
const BACKEND_URI = "http://localhost/notPinterest"
const width = 600;
const height = 600;
const left =
    typeof window !== "undefined" && window.innerWidth / 2 - width / 2;
const _top =
    typeof window !== "undefined" && window.innerHeight / 2 - height / 2;

const githubButton = document.getElementById("github")
const githubLogin = () => {

    window.open(
        BACKEND_URI + "/auth/github",
        "",
        `toolbar=no, location=no, directories=no, status=no, menubar=no, 
            scrollbars=no, resizable=no, copyhistory=no, width=${width}, 
            height=${height}, top=${_top}, left=${left}`
    );
};

githubButton.addEventListener("click", () => {
    githubLogin()
})
</script>

</html>