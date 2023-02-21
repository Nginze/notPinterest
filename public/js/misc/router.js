$(document).ready(() => {
  const path = window.location.pathname.replace("/notPinterest", "");
  switch (path) {
    case "/":
      $("#home-tab").addClass("bg-bg_secondary");
      break;

    case "/home":
      $("#home-tab").addClass("bg-bg_secondary");
      break;

    case "/following":
      $("#following-tab").addClass("bg-bg_secondary");
      break;

    case "/recent":
      $("#recent-tab").addClass("bg-bg_secondary");
      break;
    default:
      $("#home-tab").addClass("bg-bg_secondary");
      break;
  }
  $("#home-tab").click(e => {
    $("#home-tab").addClass("bg-bg_secondary");
    $("#following-tab").removeClass("bg-bg_secondary");
    $("#recent-tab").removeClass("bg-bg_secondary");
    window.location.replace('/notPinterest/')
  });

  $("#recent-tab").click(e => {
    $("#home-tab").removeClass("bg-bg_secondary");
    $("#following-tab").removeClass("bg-bg_secondary");
    $("#recent-tab").addClass("bg-bg_secondary");

    window.location.replace('/notPinterest/recent')
  });

  $("#following-tab").click(e => {
    $("#home-tab").removeClass("bg-bg_secondary");
    $("#recent-tab").removeClass("bg-bg_secondary");
    $("#following-tab").addClass("bg-bg_secondary");
    window.location.replace('/notPinterest/recent')
  });


  $("#profile").click(e => {
    window.location.replace('/notPinterest/myprofile')
  });
});
