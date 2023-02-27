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
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
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
    <main class="w-screen h-screen flex flex-col items-center justify-center">

        <!-- <div class="mb-4 flex items-center w-[800px]">
            <div class="w-36 h-36 mr-4 rounded-full bg-bg_aux relative flex items-center cursor-pointer justify-center">
                <img class="w-full h-full rounded-full absolute"/>
                <box-icon type='solid' name='camera' color='white'></box-icon>
            </div>
            <div class="flex flex-col items-start">
                <span><?php echo $profile['username'] ?></span>
                <span><?php echo $profile['emailaddress'] ?></span>
            </div>
        </div> -->
        <div class="w-[800px] bg-bg_aux px-8 py-6 rounded-2xl">
            <div class="w-full mb-4">
                <span class="text-xl font-semibold">Last Step! Tell us what you are interested in</span>
            </div>
            <div class="w-full py-5 grid gap-5 grid-cols-4">
                <?php
                $categories = [
                    "Travel" => "https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=735&q=80",
                    "Health & Fitness" => "https://images.unsplash.com/photo-1445384763658-0400939829cd?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80",
                    "Memes" => "https://ichef.bbci.co.uk/news/976/cpsprodpb/16620/production/_91408619_55df76d5-2245-41c1-8031-07a4da3f313f.jpg",
                    "Gardening" => "https://images.unsplash.com/photo-1622383563227-04401ab4e5ea?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=387&q=80",
                    "Fashion" => "https://images.unsplash.com/photo-1509631179647-0177331693ae?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=388&q=80",
                    "Sports" => "https://images.unsplash.com/photo-1579952363873-27f3bade9f55?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80",
                    "Gaming" => "https://images.unsplash.com/photo-1542751371-adc38448a05e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
                    "Food & Dining" => "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Nnx8Zm9vZHxlbnwwfHwwfHw%3D&auto=format&fit=crop&w=500&q=60"
                ];
                foreach ($categories as $key => $value) {
                    echo  "<div class='category w-50 h-40 relative cursor-pointer'>
                    <div style='display:none' class='overlay w-full h-full bg-bg_aux absolute opacity-60'>
                    </div>
                    <img class='w-full h-full object-cover rounded-lg' src=$value />
                    <span style='display:none' class=' select-ico absolute top-1 right-1'>
                        <box-icon color='white' type='solid' name='check-circle'></box-icon>
                    </span>
                    <span class='key absolute bottom-1 left-1 font-semibold'>$key</span>
                </div>";
                }

                ?>
            </div>
            <div class="w-full">
                <button id="onboard" class="w-full px-4 py-4 font-semibold  text-center bg-bg_primary cursor-not-allowed rounded-lg">
                    Done
                </button>
            </div>
        </div>
    </main>
</body>
<script src="http://localhost/notPinterest/public/js/pages/onboard.js">
</script>

</html>