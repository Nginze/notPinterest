const getUserProfile = () => {
  $.ajax({
    url: "/notPinterest/profile",
    type: "GET",
    success: data => {
      renderProfile(data);
    },
    error: err => {
      alert("something went wrong fetching data");
    },
  });
};
const renderProfile = data => {
  $("#profile-container").prepend(
    `
            <div class="flex flex-col items-center mb-10">
                <img class="w-36 h-36 bg-bg_aux rounded-full object-cover mb-6" src=${data.avatarurl}/> 
                <span class="text-2xl font-semibold">${data.username}</span>
                <span class="text-sm text-bg_secondary font-semibold mb-4">${data.emailaddress}</span>
                <span class="text-sm">${data[0].followercount} Followers </span>
            </div> 
            <div class="mb-10">
                <button class="share mr-6 px-4 py-2 rounded-3xl text-black bg-white font-semibold">Share</button> 
                <button id="edit" class="px-4 py-2 rounded-3xl text-black bg-white font-semibold">Edit Profile</button> 
            </div>

            <div class="mb-10">
                <button id="created" class="mr-6 px-3 py-2 bg-bg_secondary hover:bg-bg_secondary rounded-lg 
                ">Created</button> 

                <button id="saved" class="px-3 py-2 hover:bg-bg_secondary rounded-lg 
                ">Saved</button> 
            </div>
            
        `
  );
};
const renderCreated = (data, currentUser) => {
  if (data.length == 0) {
    $("#mypins-null").show();
    $("#mypins-null").html("<span>No pins created!</span>");
  } else {
    $("#mypins-null").hide();
  }
  data.map(pin => {
    const hasSaved = pin.savedmap.map(obj => obj.saverid).includes(currentUser);
    $("#mypins").append(
      `
        <div data-id=${
          pin.pinid
        } class="pin w-full mb-6 cursor-zoom-in text-sm">
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
  });
};

const renderSaved = (data, currentUser) => {
  if (data.length == 0) {
    $("#mypins-null").show();
    $("#mypins-null").html("<span>No pins saved!</span>");
  } else {
    $("#mypins-null").hide();
  }
  data.map(pin => {
    const hasSaved = pin.savedmap.map(obj => obj.saverid).includes(currentUser);
    $("#mypins").append(
      `
        <div data-id=${
          pin.pinid
        } class="pin w-full mb-6 cursor-zoom-in text-sm">
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
  });
};

const getSavedPins = () => {
  $("#mypins-loader").show();
  $.ajax({
    url: "/notPinterest/saved",
    type: "GET",
    success: data => {
      $("#mypins-loader").hide();
      renderSaved(data[1], data[0].currentuser);
    },
    error: err => {
      alert("something went wrong fetching data");
    },
  });
};

const getCreatedPins = () => {
  $("#mypins-loader").show();
  $.ajax({
    url: "/notPinterest/created",
    type: "GET",
    success: data => {
      $("#mypins-loader").hide();
      renderCreated(data[1], data[0].currentuser);
    },
    error: err => {
      alert("something went wrong fetching data");
    },
  });
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

const Eventhandler = () => {
  $("body").on("click", "#update-profile-btn", function (e) {
    const avatarurl = $("#profile-tag").attr("src")
    const emailaddress = $("#email-input").val();
    const username = $("#username-input").val();
    const bio = $("#bio-input").val();
    $.ajax({
      url: "/notPinterest/profile/update",
      type: "POST",
      data: { emailaddress, username, bio, avatarurl },
      success: data => {
        alert("success");
      },
      error: () => {
        alert("error");
      },
    });
  });

  $("body").on("change", "#update-file", function (e) {
    const fileReader = new FileReader();
    fileReader.onload = () => {
      const data = fileReader.result;
      $("#profile-tag").attr("src", data);
    };
    fileReader.readAsDataURL($("#update-file").prop("files")[0]);
  });

  $("body").on("click", ".feed-save", function (e) {
    const pinid = $(this).data("id");
    savePost(pinid, e);
  });
  $("body").on("click", ".clickable", e => {
    e.stopPropagation();
  });
  $("body").on("click", ".pin", function (e) {
    const pinid = $(this).data("id");
    window.location.replace(`/notPinterest/pin?pinid=${pinid}`);
  });
  $("body").on("click", "#created", () => {
    $("#created").addClass("bg-bg_secondary");
    $("#saved").removeClass("bg-bg_secondary");
    $("#mypins").find(".pin").remove();
    getCreatedPins();
  });

  $("body").on("click", "#saved", () => {
    $("#saved").addClass("bg-bg_secondary");
    $("#created").removeClass("bg-bg_secondary");
    $("#mypins").find(".pin").remove();
    getSavedPins();
  });
};
$(document).ready(() => {
  getUserProfile();
  getCreatedPins();
  Eventhandler();
});
