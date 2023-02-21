<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script rel="preload" type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script rel="preload" nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  <script rel="preload" src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
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
          },
        },
      },
    };
  </script>
  <style>
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
  <!-- <div>
    <label for="my-modal-4" class="btn">open modal</label>
    <input type="checkbox" id="my-modal-4" class="modal-toggle" />
    <label for="my-modal-4" class="modal cursor-pointer">
      <label class="modal-box relative" for="">
        <h3 class="text-lg font-bold">Congratulations random Internet user!</h3>
        <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for free!</p>
      </label>
    </label>
  </div> -->

  <div id="edit-profile-modal" style="display:none" class="flex h-screen w-screen justify-center items-center absolute z-50">
    <div id="create-overlay" class="bg-black bg-opacity-80 absolute w-screen h-screen right-0 left-0 "></div>
    <div class="w-[500px] h-auto px-7 rounded-lg py-6 bg-bg_aux relative">
      <div id="close-edit-profile" class="absolute top-3 right-2 text-3xl">
        <button><ion-icon name="close-outline"></ion-icon></button>
      </div>
      <div class="w-full">
        <div class="flex flex-col mb-8">
          <span class="font-semibold w-full mb-3 text-2xl">Edit Public profile</span>
          <span class="w-full text-sm">People visiting your profile will see the following info</span>
        </div>
        <div class="flex items-center mb-6">
          <img class="w-16 h-16 rounded-full mr-4" src="https://minecraftpfp.com/PFP/elii_bx.png" />
          <button class="bg-bg_secondary font-semibold rounded-full px-3 py-2">Change</button>
        </div>
        <div>
          <input class="font-semibold w-full rounded-lg mb-6 px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Username" />
          <input class="font-semibold w-full rounded-lg mb-6 px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Display Name" />
          <input class="font-semibold w-full rounded-lg mb-6 px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Bio" />
          <button class="bg-btn_primary px-4 py-2 rounded-3xl font-semibold">Save</button>
        </div>
      </div>
    </div>
  </div>
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
    <section class="min-h-screen max-h-screen p-6 flex flex-col items-start col-span-1 overflow-y-auto overflow-x-hidden">
      <div class="flex justify-start mx-4 w-full mb-10 cursor-pointer">
        <img class="w-1/2" src="http://localhost/notPinterest/public/assets/logo.svg" />
      </div>
      <div class="flex flex-col items-start w-full">
        <span id="home-tab" class=" tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full h-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="home"></ion-icon><span class="w-full text-xl ">Home</span></span>

        <span id="recent-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="time-outline"></ion-icon><span class="w-full text-xl">Recent</span></span>

        <span id="following-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="people"></ion-icon><span class="w-full text-xl">Following</span></span>
      </div>
      <div class="flex flex-col items-start w-full">
        <span class="text-xl px-4 py-2 mb-6 text-bg_secondary font-medium">Insights</span>

        <span class="px-4 py-2 hover:bg-bg_secondary rounded-lg cursor-pointer rounded-xl mb-10 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="notifications"></ion-icon><span class="w-full text-xl">Notifications</span></span>
      </div>
      <div id="profile" class="w-full h-full flex flex-col justify-end justify-self-end">
        <div class="flex flex-row items-center justify-evenly bg-bg_aux rounded-2xl h-20 px-4 cursor-pointer hover:bg-btn_hover">
          <img class="w-12 h-12 mr-2 object-contain rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY_ocgOLIcfNTo2uGIaRenaGLe-uD_pxXUfHxRpW4&s" />
          <div class="mr-3 w-2/3">
            <span class="font-semibold text-sm">Lebron James</span>
            <span class="opacity-30 text-sm font-semibold">Shinyunicorn333</span>
          </div>
          <div class="w-1/10">
            <ion-icon name="chevron-forward"></ion-icon>
          </div>
        </div>
      </div>
    </section>
    <section class=" max-h-full w-full col-span-4 py-3 px-8 overflow-auto">
      <div class="flex flex-row items-center justify-center w-full bg-bg_primary py-4">
        <div class="w-full relative mr-4">
          <ion-icon class="absolute top-3.5 text-xl left-3" name="search-outline"></ion-icon>
          <input id="search-input" class="bg-bg_secondary py-3 px-12  w-full rounded-lg outline-none" type="text" placeholder="Search your pins" />

          <div id="result-container" style="display:none" class="w-full h-96 rounded-lg absolute bg-bg_aux z-50 top-19 mt-3">

          </div>
        </div>
        <div class="flex flex-row items-center">
          <button class="w-12 h-12 mr-4 bg-btn_secondary rounded-lg text-xl text-black flex items-center justify-center">
            <ion-icon name="filter-outline"></ion-icon>
          </button>
          <button id="create" class="w-12 h-12 bg-btn_primary rounded-lg text-xl flex items-center justify-center">
            <ion-icon name="add-outline"></ion-icon>
          </button>
        </div>
      </div>

      <div id="profile-container" class="min-h-full w-full py-10 px-3 flex flex-col items-center">
        <div id="loader" class="text-center">
          <div role="status">
            <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
              <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
            </svg>
            <span class="sr-only">Loading...</span>
          </div>

        </div>
        <div id="mypins" class="w-full h-full columns-2 md:columns-3 lg:columns-5">
          <div>
          </div>
    </section>
  </main>
</body>
<script src="http://localhost/notPinterest/public/js/pages/profile.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/modal.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/nav.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/router.js"></script>

</html>