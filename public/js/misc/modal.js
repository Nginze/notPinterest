$(document).ready(() => {
  $("#create").click(() => {
    $("#create-modal").show();
  });

  $("body").on("click", ".share", () => {
    $("#share-modal").show();
  });

  $("body").on("click", "#edit", () => {
    console.log("clicked");
    $("#edit-profile-modal").show();
  });

  $("#close-edit-profile").click(() => {
    $("#edit-profile-modal").hide();
  });

  $("#close-share").click(() => {
    console.log("yeass");
    $("#share-modal").hide();
  });

  $("#close-create").click(() => {
    $("#modal-box").addClass("animate__fadeOutUp");
    $("#create-modal").hide();
    $("#modal-box").removeClass("animate__fadeOutUp");
  });
});
