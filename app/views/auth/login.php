<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.50.2/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script rel="preload" type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script rel="preload" nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <script rel="preload" src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
    <title>Document</title>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ["inter"],
                    },
                    colors: {
                        bg_primary: "#0C0E11",
                        bg_secondary: "#40424e",
                        bg_aux: "#141A20",
                        btn_primary: "#5adc3e",
                        btn_google: "#4C8BF5",
                        btn_secondary: "#fefffe",
                        btn_hover: "#60626E",
                        txt_primary: "#fefffe",
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-bg_primary text-txt_primary box-border font-display max-w-screen w-screen overflow-x-hidden overflow-y-hidden">
    <main class="w-screen h-screen flex items-center justify-center">
        <div class="w-[500px] bg-bg_aux px-8 py-6 rounded-2xl">
            <div class="w-full mb-4">
                <div class="flex items-end mb-4">
                    <img class="w-8 mr-4" src="http://localhost/notPinterest/public/assets/logo_ico.svg" />
                    <span class="font-semibold text-2xl"> Login</span>
                </div>
                <span>By signing up you accept our Privacy Policy and Terms of Service.</span>
            </div>
            <div class="w-full">
                <input class="font-semibold w-full rounded-lg mb-6 px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Email Address" />
                <input class="font-semibold w-full rounded-lg mb-6 px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Username" />
            </div>
            <div class="w-full">
                <button class="w-full px-4 py-4 font-semibold  text-center bg-btn_primary rounded-lg">
                   Login to account 
                </button>
                <div class="divider">OR</div>
                <button class="flex items-center  justify-center w-full px-4 py-4 font-semibold  text-center bg-btn_google text-white rounded-lg">
                    <ion-icon class="mr-4 text-lg text-white" name="logo-google"></ion-icon>
                    Login with Google
                </button>
            </div>
        </div>
    </main>
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