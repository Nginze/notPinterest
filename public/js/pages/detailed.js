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
//   $(this).find(".like-outline").hide();
//   $(this).find(".like-filled").show();
// });
// $(".like-btn").mouseout(function () {
//   $(this).find(".like-outline").show();
//   $(this).find(".like-filled").hide();
// });

$(".like-btn").click(function (e) {
  const commentid = $(this).data("id");
  console.log(commentid);
  $.post("/notPinterest/like", { commentid }, (data, status) => {
    console.log(status);
  });
});

$("body").on("click", "#reply-btn", e => {
  $(e.target).closest("#comment-content").find(".reply-form").toggle();
});
