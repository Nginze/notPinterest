<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.css" integrity="sha512-oe8OpYjBaDWPt2VmSFR+qYOdnTjeV9QPLJUeqZyprDEQvQLJ9C5PCFclxwNuvb/GQgQngdCXzKSFltuHD3eCxA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        display: ["inter"],
                    },
                    colors: {
                        bg_primary: "#0C0E11",
                        bg_secondary: "#40424e",
                        bg_aux: "#141A20",
                        btn_primary: "#5adc3e",
                        btn_secondary: "#fefffe",
                        btn_hover: "#60626E",
                        txt_primary: "#fefffe",
                        txt_light: "#595e61"
                    },
                },
            },
        };
    </script>
    <style>
        #pin-container::-webkit-scrollbar {
            width: 4px;
            cursor: pointer;
            /*background-color: rgba(229, 231, 235, var(--bg-opacity));*/

        }

        #pin-container::-webkit-scrollbar-track {
            background-color: rgba(229, 231, 235, var(--bg-opacity));
            cursor: pointer;
            /*background: red;*/
        }

        #pin-container::-webkit-scrollbar-thumb {
            cursor: pointer;
            background-color: #a0aec0;
            /*outline: 1px solid slategrey;*/
        }
    </style>
</head>

<body class="bg-bg_primary text-txt_primary box-border font-display max-w-screen w-screen overflow-x-hidden overflow-y-hidden">
    <div id="create-modal" style="display:none" class="flex h-screen w-screen justify-center items-center absolute z-50">
        <div id="create-overlay" class="bg-black bg-opacity-80 absolute w-screen h-screen right-0 left-0 "></div>
        <div id="modal-box" class="w-[600px] h-auto px-7 rounded-lg py-6 bg-bg_aux relative animate__animated animate__fadeInDown animate__faster">
            <div id="close-create" class="absolute top-3 right-2 text-3xl">
                <button><ion-icon name="close-outline"></ion-icon></button>
            </div>
            <div class="border border-dashed rounded-lg bg-bg_secondary border-gray-500 relative mt-8 mb-6 py-2">
                <input type="file" multiple class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                    <div class="flex flex-col items-center mb-4">
                        <iconify-icon class="opacity-30 mb-3" icon="material-symbols:upload-file-outline" width="60"></iconify-icon>
                        <span class="text-sm opacity-30">Click here to upload</span>
                    </div>

                    <div>
                        <span class="text-xs opacity-30">
                            Recommendation: Use jpg files less than 10MB
                        </span>
                    </div>
                </div>
            </div>
            <div class="w-full">
                <form class="w-full flex flex-col items-end">
                    <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-6 w-full rounded-lg" type="text" placeholder="Add your title" />
                    <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-6 w-full rounded-lg" type="text" placeholder="Tell everyone what your pin is about" />
                    <input class="bg-bg_secondary text-white outline-none px-3 py-2 mb-5 w-full rounded-lg" type="text" placeholder="Add destination link (Optional)" />
                    <button class="bg-btn_primary px-4 py-2 rounded-3xl font-semibold">Save</button>
                </form>
            </div>
        </div>
    </div>
    <main class="w-screen h-screen grid grid-cols-5 divide-x divide-slate-800">
        <section class="min-h-screen max-h-screen p-6 flex flex-col items-start col-span-1 overflow-y-auto overflow-x-hidden">
            <div class="flex justify-start mx-4 w-full mb-10 cursor-pointer">
                <img class="w-1/2" src="http://localhost/notPinterest/public/assets/logo.svg" />
            </div>
            <div class="flex flex-col items-start w-full">
                <span id="home-tab" class=" tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full h-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="home"></ion-icon><span class="w-full text-xl ">Home</span></span>

                <span id="recent-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="time-outline"></ion-icon><span class="w-full text-xl">Recent</span></span>

                <span id="following-tab" class="tab mb-6 hover:bg-bg_secondary rounded-lg cursor-pointer px-4 py-2 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="people"></ion-icon><span class="w-full text-xl">Following</span></span>
            </div>
            <div class="flex flex-col items-start w-full">
                <span class="text-xl px-4 py-2 mb-6 text-bg_secondary font-medium">Insights</span>

                <span class="px-4 py-2 hover:bg-bg_secondary rounded-lg cursor-pointer rounded-xl mb-10 flex flex-row items-center text-2xl w-full justify-center"><ion-icon class="justify-self-start mr-3 text-2xl" name="notifications"></ion-icon><span class="w-full text-xl">Notifications</span></span>
            </div>
            <div id="profile" class="w-full h-full flex flex-col justify-end justify-self-end">
                <div class="flex flex-row items-center justify-evenly bg-bg_aux rounded-2xl h-20 px-4 cursor-pointer hover:bg-btn_hover">
                    <img class="w-12 h-12 mr-2 object-contain rounded-full" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQY_ocgOLIcfNTo2uGIaRenaGLe-uD_pxXUfHxRpW4&s" />
                    <div class="mr-3 w-2/3">
                        <span class="font-semibold text-sm">Lebron James</span>
                        <span class="opacity-30 text-sm font-semibold">Shinyunicorn333</span>
                    </div>
                    <div class="w-1/10">
                        <ion-icon name="chevron-forward"></ion-icon>
                    </div>
                </div>
            </div>
        </section>
        <section class="w-full col-span-4 px-8 overflow-y-auto">
            <div id="toast" style="display:none" class="animate__animated animate__faster animate__fadeInUp absolute bottom-8 left-1/2 flex items-center w-auto bg-bg_aux rounded-full px-8 py-4 z-50">
                <span class="bg-white rounded-2xl p-2 mr-4 flex items-center justify-center text-3xl text-txt_light">
                    <iconify-icon icon="material-symbols:bookmark-added-outline"></iconify-icon>
                </span>
                Saved pin to profile!
            </div>
            <div class="flex flex-row items-center justify-center w-full bg-bg_primary py-4 sticky top-0 z-10">
                <div class="w-full relative mr-4">
                    <ion-icon class="absolute top-3.5 text-xl left-3" name="search-outline"></ion-icon>
                    <input id="search-input" class="bg-bg_secondary py-3 px-12  w-full rounded-lg outline-none" type="text" placeholder="Search your pins" />

                    <div id="result-container" style="display:none" class="w-full h-96 rounded-lg absolute bg-bg_aux z-50 top-19 mt-3">

                    </div>
                </div>
                <div class="flex flex-row items-center">
                    <button class="w-12 h-12 mr-4 bg-btn_secondary rounded-lg text-xl text-black flex items-center justify-center">
                        <ion-icon name="filter-outline"></ion-icon>
                    </button>
                    <button id="create" class="w-12 h-12 bg-btn_primary rounded-lg text-xl flex items-center justify-center">
                        <ion-icon name="add-outline"></ion-icon>
                    </button>
                </div>
            </div>

            <div id="detailed-pin-container" class="px-3 py-10 mb-10 flex flex-col items-center h-5/6">
                <div id="loader" class="text-center absolute left-1/2 top-1/3">
                    <div role="status">
                        <svg aria-hidden="true" class="inline w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div class="w-5/6 max-h-full min-h-full bg-bg_aux rounded-2xl flex flex-row ">
                    <div class="h-full w-full rounded-tl-2xl rounded-bl-2xl flex-1">
                        <img class="h-full  w-full object-cover rounded-tl-2xl rounded-bl-2xl" src=<?php echo $post['imgurl'] ?> />
                    </div>
                    <div class="px-6 h-5/6 flex-1 relative">
                        <div class="w-full flex justify-between items-center p-3 mb-4 sticky top-20 bg-bg_aux ">
                            <div class="flex items-center w-1/4  justify-between">
                                <button class="bg-bg_secondary w-10 h-10 flex items-center justify-center rounded-full text-xl"><ion-icon name="link-outline"></ion-icon></button>
                                <button class="bg-bg_secondary w-10 h-10 flex items-center justify-center rounded-full text-xl"><ion-icon name="share-outline"></ion-icon></button>
                            </div>
                            <?php
                            $user = new User;
                            $hasSaved = in_array($user->getUserId(), $post['savemap']);
                            if (!$hasSaved) {
                                echo '<button id="detail-pin-save" class="bg-btn_primary px-4 py-2 rounded-3xl font-semibold">Save</button>';
                            } else {

                                echo '<button id="detail-pin-save" class="bg-bg_primary px-4 py-2 rounded-3xl font-semibold">Saved</button>';
                            }
                            ?>
                        </div>
                        <div class="h-4/5 overflow-y-auto">
                            <div class="flex h-4/5 flex-col items-start">
                                <span class="font-semibold text-3xl mb-4"><?php echo $post['pintitle'] ?></span>
                                <span class="text-sm"><?php echo $post['pindesc'] ?></span>
                                <div class="w-4/5 flex items-center justify-between px-4  mt-6 mb-6">
                                    <div class="flex items-center">
                                        <img class="mr-4 rounded-full w-10 h-10 object-cover" src=<?php echo $post['avatarurl'] ?> />
                                        <div class="flex flex-col items-start">
                                            <span class="font-semibold"><?php echo $post['displayname'] ?></span>
                                            <span class="text-xs text-txt_light font-semibold">@jack123</span>
                                        </div>
                                    </div>
                                    <?php
                                        $user = new User;
                                        $isFollowing =  in_array($user->getUserId(), $post['followmap']);
                                        $postid = $post['userid'];
                                        if(!$isFollowing){
                                            echo "<button data-id=$postid id='follow-btn' class='px-3 py-1 rounded-3xl font-semibold bg-bg_secondary'>Follow</button>";
                                        }else{
                                            echo "<button data-id=$postid id='follow-btn' class='px-3 py-1 rounded-3xl font-semibold bg-bg_primary'>Following</button>";
                                        }
                                    ?>
                                </div>
                                <div>
                                    <span class="text-lg font-semibold mb-6"><?php echo count($comments) ?> comments</span>
                                    <div class="mt-5  ml-6">
                                        <?php foreach ($comments as $comment) : ?>
                                            <div id="comment" class="flex items-start mb-4">
                                                <div class="w-8 h-8 mr-4">
                                                    <img class="w-full h-full rounded-full object-cover" src=<?php echo $comment['avatarurl'] ?> />
                                                </div>
                                                <div id="comment-content" class="w-4/5 flex flex-col items-start">
                                                    <div class="mb-2">
                                                        <span><?php echo $comment['displayname'] ?></span>
                                                        <p class="text-txt_light font-semibold"><?php echo $comment['content'] ?></p>
                                                    </div>
                                                    <div class="w-3/4 flex items-center">
                                                        <span class="mr-4">2W</span>
                                                        <span data-id=<?php echo $comment['commentid'] ?> id="reply-btn" class="mr-4 px-2 py-1 cursor-pointer rounded-lg hover:bg-bg_secondary">Reply</span>
                                                        <span data-id=<?php echo $comment['commentid'] ?> class="like-btn hover:bg-bg_secondary text-xl flex items-center justify-center p-1 rounded-lg text-red-500 cursor-pointer">
                                                            <?php
                                                            $user = new User;
                                                            $curr_userid = $user->getUserId();
                                                            $hasLiked = in_array($curr_userid, $comment['likemap']);

                                                            echo $hasLiked ? '<ion-icon class="like-icon like-outline" name="heart">' : '<ion-icon class="like-icon like-filled" name="heart-outline">';
                                                            // if (in_array($curr_userid, $comment['likemap'])) {
                                                            //     echo '<ion-icon class="like-filled" name="heart">';
                                                            //     echo '<ion-icon class="like-outline" style="display:none" name="heart-outline"></ion-icon>';
                                                            // } else {
                                                            //     echo '<ion-icon class="like-outline" name="heart-outline"></ion-icon>';
                                                            //     echo '<ion-icon style="display:none" class="like-filled" name="heart">';
                                                            // }
                                                            ?>
                                                        </span>
                                                    </div>
                                                    <div style="display:none" class="reply-form w-full relative my-2">
                                                        <button data-id=<?php echo $comment['commentid'] ?> style="display:none" class="reply-send-btn absolute right-2 bg-btn_primary w-8 h-8 top-1 flex items-center justify-center  text-lg text-center rounded-full">
                                                            <ion-icon data-id=<?php echo $comment['commentid'] ?> name="send"></ion-icon>
                                                        </button>
                                                        <div class="reply-emoji-btn absolute right-2  w-10 h-10 top-0 flex items-center justify-center  text-2xl text-center rounded-full">
                                                            😀
                                                        </div>
                                                        <input class="reply-input font-semibold w-full rounded-3xl px-4 py-2 bg-bg_secondary outline-none border-none" placeholder="Reply to comment" />
                                                    </div>
                                                    <?php
                                                    if ($comment['hasreplies'] > 0) {
                                                        $noReplies = $comment['hasreplies'];
                                                        $commentid = $comment['commentid'];
                                                        echo "<button data-id=$commentid class='view-replies my-2 flex items-center font-semibold text-txt_light hover:bg-bg_secondary hover:text-white px-2 py-1 rounded-lg'> <ion-icon class='chevron mr-2' name='chevron-down'></ion-icon>$noReplies replies</button>";
                                                    }
                                                    ?>
                                                    <div style="display: none;" class="replies-container w-full ml-5 flex flex-col justify-center items-start">

                                                        <div class="reply-loader">
                                                            <div role="status">
                                                                <svg aria-hidden="true" class="inline w-6 h-6 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                                                </svg>
                                                                <span class="sr-only">Loading...</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="absolute bottom-0 w-full relative mt-6">
                            <button style="display:none" id="send-btn" class="absolute right-2 bg-btn_primary w-10 h-10 top-2 flex items-center justify-center  text-xl text-center rounded-full">
                                <ion-icon name="send"></ion-icon>
                            </button>
                            <div id="emoji-btn" class="absolute right-2  w-10 h-10 top-2 flex items-center justify-center  text-3xl text-center rounded-full">
                                😀
                            </div>
                            <input id="comment-input" class="font-semibold w-full rounded-3xl px-4 py-4 bg-bg_secondary outline-none border-none" placeholder="Add a comment" />
                        </div>
                    </div>

                </div>
            </div>
            </div>
            <div class="flex flex-col items-center w-full h-auto">
                <span class="text-center w-full font-semibold text-lg mb-6 ">More Like This</span>
                <div id="pin-container" class="columns-2 md:columns-3 lg:columns-4 ">
                </div>
            </div>
            </div>
        </section>
    </main>
</body>
<script src="http://localhost/notPinterest/public/js/pages/detailed.js"></script>
<script src="http://localhost/notPinterest/public/js/pages/feed.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script src="https://code.iconify.design/iconify-icon/1.0.5/iconify-icon.min.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/modal.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/nav.js"></script>
<script src="http://localhost/notPinterest/public/js/misc/router.js"></script>

</html>