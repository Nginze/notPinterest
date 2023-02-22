const BACKEND_URI = "http://localhost/notPinterest";
const width = 600;
const height = 600;
const left = typeof window !== "undefined" && window.innerWidth / 2 - width / 2;
const _top =
  typeof window !== "undefined" && window.innerHeight / 2 - height / 2;

const googleButton = $("#google");
const googleLogin = () => {
  window.open(
    BACKEND_URI + "/auth/google",
    "",
    `toolbar=no, location=no, directories=no, status=no, menubar=no, 
            scrollbars=no, resizable=no, copyhistory=no, width=${width}, 
            height=${height}, top=${_top}, left=${left}`
  );
};

googleButton.on("click", () => {
  googleLogin();
});

$("#signup").click(() => {
  const emailaddress = $("#email-input").val();
  const username = $("#username-input").val();
  const password = $("#password-input").val();

  $.post(
    "/notPinterest/signup",
    { emailaddress, username, password },
    (data, status) => {
      window.location.replace("/notPinterest/");
    }
  );
});

$("#login").click(() => {
  const emailaddress = $("#email-input").val();
  const password = $("#password-input").val();

  $.post("/notPinterest/login", { emailaddress, password }, (data, status) => {
    window.location.replace("/notPinterest/");
  });
});
