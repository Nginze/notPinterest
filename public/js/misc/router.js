$(document).ready(() => {
  const path = window.location.pathname.replace("/notPinterest", "");
  switch (path) {
    case "/":
      $("#home-tab").addClass(
        "bg-bg_aux border-solid font-semibold border-r-2 border-btn_primary"
      );
      $("#home-nav").removeClass("opacity-60");
      $("#home-ico").removeClass("opacity-60");
      $("#home-ico").attr("type", "solid");
      break;

    case "/home":
      $("#home-tab").addClass(
        "bg-bg_aux border-solid font-semibold border-r-2 border-btn_primary"
      );
      $("#home-nav").removeClass("opacity-60");
      $("#home-ico").removeClass("opacity-60");
      $("#home-ico").attr("type", "solid");
      break;

    case "/following":
      $("#following-tab").addClass(
        "bg-bg_aux border-solid font-semibold border-r-2 border-btn_primary"
      );
      $("#following-nav").removeClass("opacity-60");
      $("#following-ico").removeClass("opacity-60");
      $("#following-ico").attr("type", "solid");
      break;

    case "/recent":
      $("#recent-tab").addClass(
        "bg-bg_aux border-solid border-r-2 font-semibold border-btn_primary"
      );
      $("#recent-nav").removeClass("opacity-60");
      $("#recent-ico").removeClass("opacity-60");
      $("#recent-ico").attr("type", "solid");
      break;
    default:
      $("#home-tab").addClass(
        "bg-bg_aux border-solid border-r-2 font-semibold border-btn_primary"
      );
      $("#home-nav").removeClass("opacity-60");
      $("#home-ico").removeClass("opacity-60");
      $("#home-ico").attr("type", "solid");
      break;
  }
  $("#home-tab").click(e => {
    $("#home-tab").addClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );
    $("#following-tab").removeClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );

    $("#following-nav").addClass("opacity-60");
    $("#following-ico").addClass("opacity-60");
    $("#following-ico").attr("type", "regular");

    $("#recent-tab").removeClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );

    $("#recent-nav").addClass("opacity-60");
    $("#recent-ico").addClass("opacity-60");
    $("#recent-ico").attr("type", "regular");


  });

  $("#recent-tab").click(e => {
    $("#home-tab").removeClass("bg-bg_aux border-solid border-r-2 border-btn_primary");
    $("#home-nav").addClass("opacity-60");
    $("#home-ico").addClass("opacity-60");
    $("#home-ico").attr("type", "regular");

    $("#following-tab").removeClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );

    $("#following-nav").addClass("opacity-60");
    $("#following-ico").addClass("opacity-60");
    $("#following-ico").attr("type", "regular");

    $("#recent-tab").addClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );
  });

  $("#following-tab").click(e => {
    $("#home-tab").removeClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );

    $("#home-nav").addClass("opacity-60");
    $("#home-ico").addClass("opacity-60");
    $("#home-ico").attr("type", "regular");

    $("#recent-tab").removeClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );
    
    $("#recent-nav").addClass("opacity-60");
    $("#recent-ico").addClass("opacity-60");
    $("#recent-ico").attr("type", "regular");

    $("#following-tab").addClass(
      "bg-bg_aux border-solid border-r-2 border-btn_primary"
    );
      
  });

  $("#profile").click(e => {
    window.location.replace("/notPinterest/myprofile");
  });
});
