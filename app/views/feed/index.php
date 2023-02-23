<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script rel="preload" type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script rel="preload" nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script rel="preload" src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <title>Document</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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
            btn_secondary: "#fefffe",
            btn_hover: "#60626E",
            btn_whatsapp: '#24d267',
            btn_twitter: '#1fa0f2',
            txt_primary: "#fefffe",
            txt_light: "#595e61"
          },
        },
      },
    };
  </script>
  <style>
    .loader {
      width: 56px;
      height: 56px;
      border: 6px solid #4c8bf5;
      border-bottom-color: transparent;
      border-radius: 50%;
      display: inline-block;
      box-sizing: border-box;
      animation: rotation 1s linear infinite;
      left: 50%;
    }

    @keyframes rotation {
      0% {
        transform: rotate(0deg);
      }

      100% {
        transform: rotate(360deg);
      }
    }

    #pin-container::-webkit-scrollbar {
      width: 4px;
      cursor: pointer;
      /*background-color: rgba(229, 231, 235, var(--bg-opacity));*/

    }

    #pin-container::-webkit-scrollbar-track {
      background-color: rgba(229, 231, 235, var(--bg-opacity));
      cursor: pointer;
      /*background: red;*/
    }

    #pin-container::-webkit-scrollbar-thumb {
      cursor: pointer;
      background-color: #a0aec0;
      /*outline: 1px solid slategrey;*/
    }
  </style>
</head>

<body class="bg-bg_primary text-txt_primary box-border font-display max-w-screen w-screen overflow-x-hidden overflow-y-hidden">

  <div id="share-modal" style="display:none" class="flex h-screen w-screen justify-center items-center absolute z-50">
    <div id="create-overlay" class="bg-black bg-opacity-80 absolute w-screen h-screen right-0 left-0 "></div>
    <div class="w-[400px] h-auto px-7 rounded-lg py-6 bg-bg_aux relative">
      <div id="close-share" class="absolute top-3 right-2 text-3xl">
        <button><ion-icon name="close-outline"></ion-icon></button>
      </div>
      <div class="w-full">
        <span class="font-semibold text-2xl">Share your ideas!</span>
        <div class="flex items-center mt-6 w-full justify-evenly ">
          <a class="flex flex-col items-center mr-5">
            <div class="w-12 h-12 mb-4 text-3xl p-2 rounded-full bg-btn_whatsapp text-white flex items-center justify-center">
              <ion-icon name="logo-whatsapp"></ion-icon>
            </div>
            <span class="text-sm">WhatsApp</span>
          </a>

          <a class="flex flex-col items-center mr-5">
            <div class="w-12 h-12 mb-4 text-3xl p-3 rounded-full bg-btn_twitter text-white flex items-center justify-center">
              <ion-icon name="logo-twitter"></ion-icon>
            </div>
            <span class="text-sm">Twitter</span>
          </a>
          <div class="flex flex-col items-center">

            <button class="w-12 h-12 mb-4 text-3xl p-3 rounded-full bg-bg_secondary text-white flex items-center justify-center">
              <ion-icon name="copy-outline"></ion-icon>
            </button>
            <span class="text-sm">Copy Link</span>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="create-modal" style="display:none" class="flex h-screen w-screen justify-center items-center absolute z-50">
    <div id="create-overlay" class="bg-black bg-opacity-80 absolute w-screen h-screen right-0 left-0 "></div>
    <div id="modal-box" class="w-[600px] h-auto px-7 rounded-lg py-6 bg-bg_aux relative animate__animated animate__fadeInDown animate__faster">
      <div id="close-create" class="absolute top-3 right-2 text-3xl">
        <button><ion-icon name="close-outline"></ion-icon></button>
      </div>
      <div class="border border-dashed rounded-lg bg-bg_secondary border-gray-500 relative mt-8 mb-6 py-2">
        <input type="file" multiple class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
        <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
          <div class="flex flex-col items-center mb-4">
            <iconify-icon class="opacity-30 mb-3" icon="material-symbols:upload-file-outline" width="60"></iconify-icon>
            <span class="text-sm opacity-30">Click here to upload</span>
          </div>

          <div>
            <span class="text-xs opacity-30">
              Recommendation: Use jpg files less than 10MB
            </span>
          </div>
        </div>
      </div>
      <div class="w-full">
        <form class="w-full flex flex-col items-end">
          <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-6 w-full rounded-lg" type="text" placeholder="Add your title" />
          <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-6 w-full rounded-lg" type="text" placeholder="Tell everyone what your pin is about" />
          <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-5 w-full rounded-lg" type="text" placeholder="Add destination link (Optional)" />
          <button class="bg-btn_primary px-4 py-2 rounded-3xl font-semibold">Save</button>
        </form>
      </div>
    </div>
  </div>
  <main class="w-screen h-screen grid grid-cols-5 divide-x divide-slate-800">
    <section class="min-h-screen max-h-screen flex flex-col items-start col-span-1 overflow-y-auto overflow-x-hidden">
      <div class="flex items-center justify-start ml-8 mt-5 w-full mb-10 cursor-pointer">
        <img class="w-1/3 mr-2" src="http://localhost/notPinterest/public/assets/logo.svg" />
      </div>
      <div class="flex flex-col items-start w-full h-full">
        <ul class="w-full">
          <li id="home-tab" class="px-4 cursor-pointer py-3 hover:bg-bg_aux w-full">
            <a href="/notPinterest/" class="flex items-center px-4  text-lg">
              <box-icon id="home-ico" class="mr-4 opacity-60" color="white" name="home-alt-2"></box-icon>
              <span id="home-nav" class="opacity-60">Home</span>
            </a>
          </li>

          <li class="px-4 py-3 cursor-pointer hover:bg-bg_aux w-full">
            <a href="/notPinterest/" class="flex items-center px-4 text-lg ">
              <box-icon id="following-ico" class="mr-4 opacity-60" color="white" name="group"></box-icon>
              <span id="following-nav" class="opacity-60">Following</span>
            </a>
          </li>

          <li class="px-4 py-3 cursor-pointer hover:bg-bg_aux w-full">
            <a href="/notPinterest/" class="flex items-center px-4 text-lg">
              <box-icon id="recent-ico" class="mr-4 opacity-60" color="white" name="time"></box-icon>
              <span id="recents-nav" class="opacity-60">Recents</span>
            </a>
          </li>
          <li class="mt-10 mb-4 flex items-center px-8 text-lg">
            <span class="text-md font-semibold text-bg_secondary opacity-60">Insights</span>
          </li>
          <li class="px-4 py-3 cursor-pointer hover:bg-bg_aux w-full">
            <a class="flex items-center px-4 text-lg">
              <box-icon id="notifications-ico" class="mr-4 opacity-60" color="white" name="bell"></box-icon>
              <span id="notifications-nav" class="opacity-60">Notifications</span>
            </a>
          </li>
        </ul>
        <!-- <span id="home-tab" class=" tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full h-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="home"></ion-icon><span class="w-full text-xl ">Home</span></span>

        <span id="recent-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="time-outline"></ion-icon><span class="w-full text-xl">Recent</span></span>

        <span id="following-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="people"></ion-icon><span class="w-full text-xl">Following</span></span>
      </div>
      <div class="flex flex-col items-start w-full">
        <span class="text-xl px-4 py-2 mb-6 text-bg_secondary font-medium">Insights</span>

        <span class="px-4 py-2 hover:bg-bg_secondary rounded-lg cursor-pointer rounded-xl mb-10 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="notifications"></ion-icon><span class="w-full text-xl">Notifications</span></span>
      </div> -->
        <div id="profile" class="w-full px-4 h-full flex flex-col justify-end justify-self-end">
          <div class="flex flex-row items-center justify-evenly bg-bg_aux rounded-2xl h-20 px-4 mb-4 cursor-pointer hover:bg-btn_hover">
            <img referrerpolicy="no-referrer" class="w-12 h-12 mr-2 object-contain rounded-full" src=<?php echo $profile['avatarurl'] ?> />
            <div class="mr-3 w-2/3 flex flex-col items-start">
              <span class="font-semibold text-sm"><?php echo $profile['username'] ?></span>
              <span class="opacity-30 text-sm font-semibold"><?php echo $profile['emailaddress'] ?></span>
            </div>
            <div class="w-1/10">
              <ion-icon name="chevron-forward"></ion-icon>
            </div>
          </div>
        </div>
    </section>
    <section class=" max-h-full w-full col-span-4 px-8 overflow-auto relative bg-bg_primary">

      <div class="flex flex-row items-center justify-center w-full bg-bg_primary py-4 sticky top-0 z-10">
        <div class="w-full relative mr-4">
          <box-icon class="absolute top-3 text-xl left-3" name="search" color="white"></box-icon>
          <!-- <ion-icon class="absolute top-3.5 text-xl left-3" name="search-outline"></ion-icon> -->
          <input id="search-input" class="bg-bg_secondary py-3 px-12  w-full rounded-lg outline-none" type="text" placeholder="Search your pins" />

          <div id="result-container" style="display:none" class="w-full h-96 rounded-lg absolute bg-bg_aux z-50 top-19 mt-3">

          </div>
        </div>
        <div class="flex flex-row items-center">
          <button class="w-12 h-12 mr-4 bg-btn_secondary rounded-lg text-xl text-black flex items-center justify-center">
            <box-icon name="sort" color="black"></box-icon>
            <!-- <ion-icon name="filter-outline"></ion-icon> -->
          </button>
          <button id="create" class="w-12 h-12 bg-btn_primary rounded-lg text-xl flex items-center justify-center">
            <box-icon name="plus" color="white"></box-icon>
            <!-- <ion-icon name="add-outline"></ion-icon> -->
          </button>
        </div>
      </div>

      <div id="pin-container" class="min-h-full px-3 columns-2 md:columns-3 lg:columns-5 relative">
        <span id="feed-loader" class="loader absolute left-1/2"></span>
      </div>
    </section>
  </main>
</body>
<script src="http://localhost/notPinterest/public/js/pages/feed.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/modal.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/nav.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/router.js"></script>

</html>