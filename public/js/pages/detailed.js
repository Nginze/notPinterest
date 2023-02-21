$("#comment-input").on("input", () => {
  if ($("#comment-input").val()) {
    $("#send-btn").show();
    $("#emoji-btn").hide();
  } else {
    $("#send-btn").hide();
    $("#emoji-btn").show();
  }
});

let currReply = "";
$("body").on("input", ".reply-input", e => {
  currReply = e.target.value;
  if ($(e.target).val()) {
    $(e.target).parent().find(".reply-send-btn").show();
    $(e.target).parent().find(".reply-emoji-btn").hide();
  } else {
    $(e.target).parent().find(".reply-send-btn").hide();
    $(e.target).parent().find(".reply-emoji-btn").show();
  }
});

$("#send-btn").click(() => {
  const pinid = window.location.search.split("=")[1];
  const content = $("#comment-input").val();
  $.post("/notPinterest/comment", { pinid, content }, (data, status) => {
    alert("comment added to the db");
  });
});

$("body").on("click", ".reply-send-btn", e => {
  const commentid = $(e.target).data("id");
  console.log(commentid);
  const content = $(this).siblings(".reply-input").val();
  $.post(
    "/notPinterest/reply",
    { commentid, content: currReply },
    (data, status) => {
      alert("reply added to the db");
    }
  );
});

// $(".like-btn").mouseover(function () {
//   if($(this).find('.like-icon').attr("name") == "heart"){
//     $(this).find('.like-icon').attr("name", "heart-outline")
//   }else{
//     $(this).find('.like-icon').attr("name", "heart")
//   }
//   // $(this).find(".like-outline").hide();
//   // $(this).find(".like-filled").show();
// });
// $(".like-btn").mouseout(function () {
//   $(this).find(".like-outline").show();
//   $(this).find(".like-filled").hide();
// });

$(".like-btn").click(function (e) {
  const commentid = $(this).data("id");
  if ($(this).find(".like-icon").attr("name") == "heart") {
    $(this).find(".like-icon").attr("name", "heart-outline");
  } else {
    $(this).find(".like-icon").attr("name", "heart");
  }
  $.post("/notPinterest/like", { commentid }, (data, status) => {
    if (status == "success") {
    }
  });
});

$("body").on("click", "#reply-btn", e => {
  $(e.target).closest("#comment-content").find(".reply-form").toggle();
});

$("body").on("click", ".view-replies", evnt => {
  commentid = $(evnt.target).data("id");
  if ($(evnt.target).find(".chevron").first().attr("name") == "chevron-down") {
    $(evnt.target).find(".chevron").first().attr("name", "chevron-up");
  } else {
    $(evnt.target).find(".chevron").first().attr("name", "chevron-down");
  }
  $(evnt.target).nextAll(".replies-container").first().toggle();
  $(evnt.target)
    .nextAll(".replies-container")
    .find(".reply-loader")
    .first()
    .show();
  $.get(`/notPinterest/replies?commentid=${commentid}`, (data, status) => {
    $(evnt.target).nextAll(".replies-container").first().empty();
    $(evnt.target)
      .nextAll(".replies-container")
      .find(".reply-loader")
      .first()
      .hide();
    data.map(e => {
      $(evnt.target).parent().find(".replies-container").first().append(`

          <div id="comment" class="flex items-start mb-4">
              <div class="w-8 h-8 mr-4">
                  <img class="w-full h-full rounded-full object-cover" src=${e.avatarurl} />
              </div>
              <div id="comment-content" class="w-4/5 flex flex-col items-start">
                  <div class="mb-2">
                      <span>${e.displayname}</span>
                      <p class="text-txt_light font-semibold">${e.content}</p>
                  </div>
            
                  <div  style="display:none" class="reply-form w-full relative my-2">
                      <button data-id=<?php echo $comment['commentid'] ?> style="display:none"  class="reply-send-btn absolute right-2 bg-btn_primary w-8 h-8 top-1 flex items-center justify-center  text-lg text-center rounded-full">
                          <ion-icon data-id=<?php echo $comment['commentid'] ?> name="send"></ion-icon>
                      </button>
                      <div class="reply-emoji-btn absolute right-2  w-10 h-10 top-0 flex items-center justify-center  text-2xl text-center rounded-full">
                          😀
                      </div>
                      <input class="reply-input font-semibold w-full rounded-3xl px-4 py-2 bg-bg_secondary outline-none border-none" placeholder="Reply to comment" />
                  </div>
              </div>
      `);
    });
  });
});

$("#detail-pin-save").on("click", (e) => {
  $(e.target).html("Saving...");
  $(e.target).removeClass("bg-btn_primary");
  $(e.target).addClass("bg-bg_primary");
  const pinid = window.location.search.split("=")[1];
  $.post("/notPinterest/pin/save", {pinid}, (data, status) => {
    if (status == "success") {
      $("#toast").show();
      $(e.target).html("Saved")
      setTimeout(() => {
        $("#toast").hide();
      }, 5000);
    }
  });
});
