<?php
require('../../settings/core.php');
require('../../functions/get_all_posts.php');
require('../../functions/get_username.php');


// core_check_login();



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post management system</title>
    <link rel="stylesheet" href="../../layout/styles/adminstyle.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../../layout/scripts/modal.js"></script>
    <script src="../../layout/scripts/app.js"></script>
</head>

<body>
    <div class="container">
        <aside class="sidebar flex flex-column justify-between">
            <h3>Post Management System</h3>

            <div class="flex flex-column justify-between h-full">
                <!-- menu links -->
                <div class="menu-links flex flex-column">
                    <div class="flex items-center gap-4">
                        <img src="../../images/icons/material-symbols_dashboard.svg" alt="">
                        <a href="home.php">Home</a>
                    </div>
                    <div class="flex items-center gap-4 active">
                        <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                        <a href="manage_posts.php">Post Management</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                        <a href="../../index.php">Explore</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                    <a href="../../login/logout.php">Logout</a>
                </div>
            </div>
        </aside>

        <div class="content">
            <header class="flex items-center justify-between">
                <h2>Dashboard</h2>

                <p><?php echo getUserName() ?></p>
            </header>


            <div class="inner flex flex-column gap-8">
                <div class="flex flex-column gap-4">
                    <div class="flex items-center justify-between">
                        <h3>Post List</h3>
                        <a href="add_posts.php"><button class="add-chore">Add a Post</button></a>
                    </div>
                    <div class=" flex items-center justify-between gap-6">
                        <table>
                            <thead>
                                <tr>
                                    <th>Post Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php getPosts() ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal" class="modal hidden">
        <div class="overlay"></div>
        <div class="modal-body flex flex-column gap-4">
            <div class="header flex flex-column gap-4">
                <div class="flex items-center justify-between">
                    <h3>Add a Post</h3>
                    <button class="close" onclick="closeModal('modal')" id="modal-close-btn">
                        X
                    </button>
                </div>
                <hr>
            </div>
            <div class="flex flex-column gap-4 w-full">
                <div class="w-full">
                    <input type="text" class="w-full" placeholder="Chore name" id="chore_name">
                </div>
                <button id="submit_chore">Submit</button>
            </div>
        </div>
    </div>

    <!-- edit chore -->
    <div id="edit_modal" class="modal hidden">
        <div class="overlay"></div>
        <div class="modal-body flex flex-column gap-4">
            <div class="header flex flex-column gap-4">
                <div class="flex items-center justify-between">
                    <h3>Update Post</h3>
                    <button class="close" id="modal-close-btn">
                        X
                    </button>
                </div>
                <hr>
            </div>
            <div class="flex flex-column gap-4 w-full">
                <div class="w-full">
                    <input type="text" class="w-full" placeholder="Chore name" id="update_chore_name">
                </div>
                <input type="hidden" id="update_cid">
                <button id="updated_chore_btn">Submit</button>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            // * Delete a post
            $(".del_post").on("click", function() {
                const pid = $(this).data("pid");
                console.log(pid)

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#093B7E",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        deletePost(pid);
                    } else if (result.isDenied) {
                        // Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });

            function deletePost(pid) {
                $.ajax({
                    url: "../../functions/delete_post.php",
                    type: "POST",
                    data: JSON.stringify({
                        request: "delete_chore",
                        pid: pid,
                    }),
                    dataType: "json",
                    contentType: "application/json",
                    success: function(data, status) {
                        if (data.status == "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Post Deleted",
                                text: "Post deleted successfully!",
                            }).then(function() {
                                setTimeout(function() {
                                    window.location.reload();
                                }, 500);
                            });
                        }
                    },
                    error: function(textStatus, errorMessage) {
                        console.log("Error: " + errorMessage + "TextStatus: " + textStatus);
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            text: "Try Again!",
                        }).then(function() {
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        });
                    },
                });
            }

              // * change a post status
              $(".status_post").on("click", function() {
                const pid = $(this).data("pid");
                const status = $(this).data("status");
                console.log(pid)

                Swal.fire({
                    icon: "warning",
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    showCancelButton: true,
                    confirmButtonColor: "#093B7E",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, change it!",
                    cancelButtonText: "No, cancel!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        statusPost(pid,status);
                    } else if (result.isDenied) {
                        // Swal.fire("Changes are not saved", "", "info");
                    }
                });
            });

            function statusPost(pid, status) {
                $.ajax({
                    url: "../../functions/status_update.php",
                    type: "POST",
                    data: JSON.stringify({
                        request: "change_status",
                        pid: pid,
                        status: status
                    }),
                    dataType: "json",
                    contentType: "application/json",
                    success: function(data, status) {
                        if (data.status == "success") {
                            Swal.fire({
                                icon: "success",
                                title: "Post Status Changed",
                                text: "Post Status Changed successfully!",
                            }).then(function() {
                                setTimeout(function() {
                                    window.location.reload();
                                }, 500);
                            });
                        }
                    },
                    error: function(textStatus, errorMessage) {
                        console.log("Error: " + errorMessage + "TextStatus: " + textStatus);
                        Swal.fire({
                            icon: "error",
                            title: "Something went wrong",
                            text: "Try Again!",
                        }).then(function() {
                            setTimeout(function() {
                                window.location.reload();
                            }, 500);
                        });
                    },
                });
            }
        })
    </script>

</body>

</html>