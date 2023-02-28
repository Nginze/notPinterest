const search = (query, type) => {
  $.ajax({
    url: `/notPinterest/search?query=${query}&type=${type}`,
    type: "GET",
    success: data => {
      if (data) {
        type == "appuser" ?  renderUserPreview(data) : renderPinPreview(data);
      }
    },
    error: err => {},
  });
};

const renderUserPreview = data => {
  $("#result-container").empty();
  data.map(u => {
    $("#result-container").append(
      `
      <div class="flex items-center mb-4 cursor-pointer p-2 rounded-lg hover:bg-bg_secondary">
      <div class="w-12 h-12 mr-4">
          <img class="w-full h-full rounded-full object-cover" src=${u.avatarurl} />
      </div>
      <div class="mb-2">
          <span>${u.username}</span>
          <p class="text-txt_light font-semibold"></p>
      </div>
      </div>
      `
    );
  });
};
const renderPinPreview = data => {
  $("#result-container").empty();
  data.map(p => {
    $("#result-container").append(
      `
      <div class="flex items-center cursor-pointer rounded-lg mb-4 hover:bg-bg_secondary py-2 px-2">
      <div class="w-12 h-16 mr-4">
          <img class="w-full h-full rounded-xl object-cover" src=${p.imgurl} />
      </div>
      <div class="mb-2">
          <span>${p.pintitle}</span>
          <p class="text-txt_light font-semibold"></p>
      </div>
      </div>
      `
    );
  });
};
$(document).ready(() => {
  $("#search-input").focus(() => {
    $("#result-container").show();
  });

  $(document).on("click", function (e) {
    if (
      $(e.target).attr("id") != "result-container" ||
      $(e.target).attr("id") != "search-input"
    ) {
    }
  });

  // $("#search-input").on("input", () => {
  //   const query = $("#search-input").val();
  //   $.get(`/notPinterest/search?query=${query}`, (data, status) => {
  //     console.log(data);
  //   });
  // });
  $("body").find("#filter").addClass("relative");
  $("body").find("#filter").append(`
    <div style="display:none" id="filter-container" class="absolute z-50 p-2 rounded-lg top-14 text-white w-36 h-auto bg-bg_aux">
        <span class=" text-left font-semibold text-sm">Filter Options</span>
        <div class="option form-control">
          <label class="label cursor-pointer">
            <span class="label-text font-semibold">Pins</span> 
            <input checked type="checkbox" class="checkbox" value="pins" />
          </label>
        </div>
        <div class="option form-control">
          <label class="label cursor-pointer">
            <span class="label-text font-semibold">Users</span> 
            <input type="checkbox" class="checkbox" value="appuser" />
          </label>
        </div>
    </div> 
  `);
  $("body").on("click", "#filter", function (e) {
    $(this).find("#filter-container").show();
  });

  $("body").on("click", ".checkbox", function (e) {
    console.log("clicked");
    $(".checkbox").not(this).prop("checked", false);
    $("input.checkbox:checkbox:checked").each(function () {
    });
    // selected[$(this).find(".label-text").first().html()] = clicked.attr("checked") ? true : false;
  });

  let debounce;
  let type;
  $("#search-input").on("input", function (e) {
    if(!e.target.value){
      $("#result-container").empty()
    }
    $("input.checkbox:checkbox:checked").each(function () {
      type = $(this).val();
    });
    clearTimeout(debounce)
    setTimeout(() => search(e.target.value, type), 1000);
  });
});
