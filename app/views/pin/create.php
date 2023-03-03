<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    input {
        margin-bottom: 1rem;
        padding: 1rem
    }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
 -->
<body>
    <form style="display: flex; flex-direction: column">
        <h5>Create a Pin</h5>
        <input id="title" name="title" placeholder="Add title" />
        <input id="desc" name="desc" placeholder="Add description" />
        <input id="link" name="link" placeholder="add a destination link" />
        <input type="file" />
        <input type="submit" />
    </form>
</body>
<script>
const form = document.querySelector("form")
$('form').submit((e) => {
    e.preventDefault()
    const data = {
        title: $("#title").val(),
        desc: $("#desc").val(),
        link: $("#link").val()
    }

    console.log(data)
    $.post('/notPinterest/create', data, (res, status) => {
        if (status == "success") {
            alert("pin created successfully")
        } else {
            alert("failed insert. try again")
        }
    })
})
</script>




</html>
