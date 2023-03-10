let pageCursor = 0;
let pinsUrl = "";
const getUserFeed = () => {
  console.log(`${pinsUrl}${pageCursor}`)
  $("#feed-loader").show();
  $.ajax({
    url: `${pinsUrl}${pageCursor}`,
    type: "GET",
    success: data => {
      $("#feed-loader").hide();
      pageCursor += 1;
      console.log(data);
      data[1].map(pin => {
        renderPin(pin, data[0].currentuser);
      });
    },
    error: err => {
      alert("something went wrong fetching data");
    },
  });
};

const loadMore = () => {
  $.ajax({
    url: `${pinsUrl}${pageCursor}`,
    type: "GET",
    success: data => {
      pageCursor += 1;
      if (data[1].length == 0) {
        $("#more-loader").hide();
      }
      console.log(data);
      data[1].map(pin => {
        renderPin(pin, data[0].currentuser);
      });
    },
    error: err => {
      alert("something went wrong fetching data");
    },
  });
};
const renderPin = (pin, currentUser) => {
  const hasSaved = pin.savedmap.map(obj => obj.saverid).includes(currentUser);
  $("#pin-container").append(
    `
    <div data-id=${pin.pinid} class="pin w-full mb-6 cursor-zoom-in text-sm">
       <div class="w-full h-auto mb-5 relative group">
        <div data-id=${
          pin.pinid
        } id="overlay" class="absolute flex flex-col justify-between h-full right-0 left-0 bg-black opacity-0 bg-opacity-60 py-3 px-2 group-hover:opacity-100 duration-500">
            <div class="flex justify-end">
                <button data-id=${pin.pinid} class = "clickable feed-save ${
      hasSaved ? "bg-bg_primary" : "bg-bg_secondary"
    } opacity-100 px-4 py-3 rounded-3xl font-semibold">${
      hasSaved ? "Saved" : "Save"
    }</button>
            </div>
            <div class="flex flex-row items-center justify-between">
                <a class="link clickable text-black bg-white flex items-center px-3 py-2 rounded-2xl bg-opacity-70 font-semibold" href="#"><span class="flex items-center"><box-icon name="link"></box-icon>esty.com</span></a>
                <button class="share clickable font-bold text-black bg-white w-10 h-10 rounded-full flex justify-center items-center text-xl bg-opacity-70"><ion-icon name="share-outline"></ion-icon></button> 
            </div> 
        </div>
        <img src=${pin.imgurl} class="clickable w-full h-auto rounded-lg" />
      </div>
    </div>
    `
  );
};

const savePost = (pinid, e) => {
  const isSaving = $(e.target).html() == "Save";
  if (isSaving) {
    $(e.target).html("Saving...");
    $(e.target).removeClass("bg-bg_secondary");
    $(e.target).addClass("bg-bg_primary");
  } else {
    $(e.target).removeClass("bg-bg_primary");
    $(e.target).addClass("bg-bg_secondary");
    $(e.target).html("Save");
  }
  $.ajax({
    url: "/notPinterest/pin/save",
    type: "POST",
    data: { pinid },
    success: data => {
      if (isSaving) {
        $(e.target).html("Saved");
      }
    },
    error: err => {
      if (isSaving) {
        $(e.target).removeClass("bg-bg_primary");
        $(e.target).addClass("bg-bg_secondary");
        $(e.target).html("Save");
        console.log("something went wrong saving post");
      } else {
        $(e.target).html("Saved");
        $(e.target).removeClass("bg-bg_secondary");
        $(e.target).addClass("bg-bg_primary");
      }
    },
  });
};

const pinObserver = () => {
  const intersectionObserver = new IntersectionObserver(entries => {
    if (entries[0].intersectionRatio <= 0) return;
    console.log("loading more pins..");
    loadMore();
  });
  intersectionObserver.observe(document.querySelector("#more-loader"));
};
const Eventhandler = () => {
  $("body").on("click", ".clickable", e => {
    e.stopPropagation();
  });

  $("body").on("click", ".pin", function (e) {
    const pinid = $(this).data("id");
    window.location.replace(`/notPinterest/pin?pinid=${pinid}`);
  });

  $("body").on("click", ".feed-save", function (e) {
    const pinid = $(this).data("id");
    savePost(pinid, e);
  });
};

$(document).ready(() => {
  const path = window.location.pathname.replace("/notPinterest", "");
  switch (path) {
    case "/":
      pinsUrl = `/notPinterest/home?page=`;
      break;
    case "/following":
      pinsUrl = `/notPinterest/pin/following?page=`;
      break;
    default:
      break;
  }
  console.log(pinsUrl);
  getUserFeed();
  Eventhandler();
  pinObserver();
});

