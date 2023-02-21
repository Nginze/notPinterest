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
  
  $('#search-input').on('input', () => {
    const query = $("#search-input").val()
    $.get(`/notPinterest/search?query=${query}`, (data, status) => {
        console.log(data);
    })
  })
});
