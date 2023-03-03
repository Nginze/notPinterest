//old mixer code
// let selected = [];
// const eventHandler = () => {
//   $(".category").click(function (e) {
//     $(this).find(".select-ico").first().toggle();
//     $(this).find(".overlay").first().toggle();
//     const key = $(this).find(".key").first().html()
//     if (selected.includes(key)){
//         selected = selected.filter((cat) => cat != key)
//     }else{
//         selected.push(key)
//     }
//     checkSelected()

//     console.log(selected)
//   });
//   $("#onboard").click(function (e){
//     submitInterests()
//   })
// };

const checkSelected = () => {
    if (selected.length >= 4 && selected.length <=6){
        $("#onboard").addClass("bg-btn_primary")
        $("#onboard").removeClass("bg-bg_primary")
        $("#onboard").removeClass("cursor-not-allowed")
        $("#onboard").prop("disabled", false)
    }else{
        $("#onboard").removeClass("bg-btn_primary")
        $("#onboard").addClass("cursor-not-allowed")
        $("#onboard").addClass("bg-bg_primary")
        $("#onboard").prop("disabled", true)
    }
}
// const submitInterests = () => {
//   console.log("data in select", selected)
//   $.ajax({
//     url: "/notPinterest/onboard",
//     type: "POST",
//     data: {selected},
//     success: data => {
//         console.log("done")
//         window.location.replace("/notPinterest/")
//     },
//     error: err => {
//         console.log("err")
//     },
//   });
// };
// $(document).ready(function () {
//   eventHandler();
// });
