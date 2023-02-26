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

  $("body").on("input",".upload", function(e){
    const fileReader = new FileReader();
    fileReader.onload = () => {
      const data = fileReader.result;
      $("#uploaded-img").show();
      $("#uploaded-img").attr("src", data);
    };

    fileReader.readAsDataURL($(".upload").prop("files")[0]);
  });

  $("#create-pin-btn").on("click", function(e){
    console.log('clicked')
    e.preventDefault()
    const pintitle = $("#pintitle-input").val();
    const pindesc = $("#pindesc-input").val();
    const websiteurl= $("#pinlink-input").val();
    const imgurl = $("#uploaded-img").attr("src");
    $.ajax({
      url: "/notPinterest/create",
      type: "POST",
      data: {pintitle, pindesc, websiteurl, imgurl},
      success: (data) => {

      },
      error: (err) => {

      }
    })
  })
});
