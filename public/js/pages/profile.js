const state = {
  currentTab: "created",
};

$.get("/notPinterest/profile", (data, status) => {
  console.log(data)
  $("#profile-container").prepend(
    `
            <div class="flex flex-col items-center mb-10">
                <img class="w-32 h-32 rounded-full mb-6" src=${data.avatarurl}/> 
                <span class="text-xl">${data.username}</span>
                <span class="text-lg mb-4">@jack123</span>
                <span class="text-sm">0 Following </span>
            </div> 
            <div class="mb-10">
                <button class="share mr-6 px-4 py-2 rounded-2xl text-black bg-white font-semibold">Share</button> 
                <button id="edit" class="px-4 py-2 rounded-2xl text-black bg-white font-semibold">Edit Profile</button> 
            </div>

            <div class="mb-10">
                <button id="created" class="mr-6 px-3 py-2 bg-bg_secondary hover:bg-bg_secondary rounded-lg 
                ">Created</button> 

                <button id="saved" class="px-3 py-2 hover:bg-bg_secondary rounded-lg 
                ">Saved</button> 
            </div>
            
        `
  );
  $.get("/notPinterest/created", (data, status) => {
    data.map(e => {
      $("#mypins").append(
        `
        
    <div id="pin" class="w-full mb-6 cursor-zoom-in text-sm">
      <div class="w-full h-auto mb-5 relative group">

        <div id="overlay" class="absolute flex flex-col justify-between h-full right-0 left-0 bg-black opacity-0 bg-opacity-60 py-3 px-2 group-hover:opacity-100 duration-500">
            <div class="flex justify-end">
                <button class = "bg-bg_secondary opacity-100 px-3 py-2 rounded-3xl font-semibold">Save</button>
            </div>
            <div class="flex flex-row items-center justify-between">
                <a class="text-black bg-white flex items-center px-3 py-2 rounded-2xl bg-opacity-70 font-semibold" href="#"><span>esty.com</span></a>
                <button class="share font-bold text-black bg-white w-10 h-10 rounded-full flex justify-center items-center text-xl bg-opacity-70"><ion-icon name="share-outline"></ion-icon></button> 
            </div> 
        </div>
        <img src=${e.imgurl} class="w-full h-auto rounded-lg" />
      </div>
     
    </div>
        `
      );
    });
  });
  $("#loader").hide();
});
// $('#profile-container').on('click', () => {
//   alert('clicked')
// })

$("body").on("click", "#created", () => {
  $('#created').addClass('bg-bg_secondary')
  $('#saved').removeClass('bg-bg_secondary')
  $.get("/notPinterest/created", (data, status) => {
    $("#mypins").empty();
    data.map(e => {
      $("#mypins").append(
        `
        
    <div id="pin" class="w-full mb-6 cursor-zoom-in text-sm">
      <div class="w-full h-auto mb-5 relative group">

        <div id="overlay" class="absolute flex flex-col justify-between h-full right-0 left-0 bg-black opacity-0 bg-opacity-60 py-3 px-2 group-hover:opacity-100 duration-500">
            <div class="flex justify-end">
                <button class = "bg-bg_secondary opacity-100 px-3 py-2 rounded-3xl font-semibold">Save</button>
            </div>
            <div class="flex flex-row items-center justify-between">
                <a class="text-black bg-white flex items-center px-3 py-2 rounded-2xl bg-opacity-70 font-semibold" href="#"><span>esty.com</span></a>
                <button class="share-pin share font-bold text-black bg-white w-10 h-10 rounded-full flex justify-center items-center text-xl bg-opacity-70"><ion-icon name="share-outline"></ion-icon></button> 
            </div> 
        </div>
        <img src=${e.imgurl} class="w-full h-auto rounded-lg" />
      </div>
     
    </div>
        `
      );
    });
  });
});

$("body").on("click", "#saved", () => {
  $('#saved').addClass('bg-bg_secondary')
  $('#created').removeClass('bg-bg_secondary')
  $.get("/notPinterest/saved", (data, status) => {
    $("#mypins").empty();
    data.map(e => {
      $("#mypins").append(
        `
        
    <div id="pin" class="w-full mb-6 cursor-zoom-in text-sm">
      <div class="w-full h-auto mb-5 relative group">

        <div id="overlay" class="absolute flex flex-col justify-between h-full right-0 left-0 bg-black opacity-0 bg-opacity-60 py-3 px-2 group-hover:opacity-100 duration-500">
            <div class="flex justify-end">
                <button class = "bg-bg_secondary opacity-100 px-3 py-2 rounded-3xl font-semibold">Save</button>
            </div>
            <div class="flex flex-row items-center justify-between">
                <a class="text-black bg-white flex items-center px-3 py-2 rounded-2xl bg-opacity-70 font-semibold" href="#"><span>esty.com</span></a>
                <button class="share font-bold text-black bg-white w-10 h-10 rounded-full flex justify-center items-center text-xl bg-opacity-70"><ion-icon name="share-outline"></ion-icon></button> 
            </div>

        </div>
        <img src=${e.imgurl} class="w-full h-auto rounded-lg" />
      </div>
     
    </div>
        `
      );
    });
  });
});
