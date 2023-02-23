$(document).ready(() => {
  $.get("/notPinterest/home", (data, status) => {
    $("#loader").hide();
    data.map(e => {
      $("#pin-container").append(
        `
    <div data-id=${e.pinid} id="pin" class="w-full mb-6 cursor-zoom-in text-sm">
    <div class="w-full h-auto mb-5 relative group">

        <div data-id=${e.pinid} id="overlay" class="absolute flex flex-col justify-between h-full right-0 left-0 bg-black opacity-0 bg-opacity-60 py-3 px-2 group-hover:opacity-100 duration-500">
            <div class="flex justify-end">
                <button  class = "feed-save bg-bg_secondary opacity-100 px-3 py-2 rounded-3xl font-semibold">Save</button>
            </div>
            <div class="flex flex-row items-center justify-between">
                <a class="link text-black bg-white flex items-center px-3 py-2 rounded-2xl bg-opacity-70 font-semibold" href="#"><span>esty.com</span></a>
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

  $("body").on("click", "#pin", e => {
    const pinid = $(e.target).data("id");
    window.location.replace("/notPinterest/pin?pinid=" + pinid);
  });

  $("body").on("click", ".feed-save", e => {
    e.stopPropagation();
    alert("saving...");
  });

  $("body").on("click", ".share", e => {
    e.stopPropagation();
  });

  $("body").on("click", ".link", e => {
    e.stopPropagation();
  });
});
