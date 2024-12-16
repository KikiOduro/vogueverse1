<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// require('../settings/core.php');
require('../../functions/get_username.php');
require('../../functions/statistics.php');
require('../../functions/get_recent_posts.php');

// core_check_login();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chore management system</title>
    <link rel="stylesheet" href="../../layout/styles/adminstyle.css">
</head>

<body>
    <div class="container">
        <aside class="sidebar flex flex-column">
            <h3>VogueVerse</h3>

            <div class="flex flex-column justify-between h-full">
                <!-- menu links -->
                <div class="menu-links flex flex-column">
                    <div class="flex items-center gap-4 active">
                        <img src="../../images/icons/material-symbols_dashboard.svg" alt="">
                        <a href="home.php">Dashboard</a>
                    </div>
                    <div class="flex items-center gap-4 ">
                        <img src="../../images/icons/material-symbols_dashboard.svg" alt="">
                        <a href="../../index.php">Home</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                        <a href="manage_posts.php">Manage Posts</a>
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
                <div class="flex flex-column gap-2">
                    <h5>Chore Statistics</h5>
                    <?php
                    getStatistics()
                    ?>
                </div>

                <div class="flex flex-column gap-2 recently-assigned">
                    <div class="flex items-center justify-between">
                        <h5>Recent Posts</h5>
                        <!-- <a href="" class="text-sm">View assigned chores</a> -->
                    </div>
                    <!-- <div class=" flex flex-column gap-4">
                        <div class="r_card flex gap-5 items-center justify-between">
                            <div class="flex gap-4">

                                <div class="flex flex-column gap-2">
                                    <p class="font-medium">Laundry</p>
                                    <div class="flex items-center gap-2">
                                        <div class="icon">
                                            <img src="../assets/icons/material-symbols-light_person.svg" alt="">
                                        </div>
                                        <p class="text-sm">Father</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/iconamoon_calendar-1-light.svg" alt="">
                                </div>
                                <p class="date_ass text-sm">Date assigned</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/tdesign_calendar-2.svg" alt="">
                                </div>
                                <p class="date_comp text-sm">Date completed</p>
                            </div>

                            <a href="" class="text-sm">Chore details</a>
                        </div>
                        <div class="r_card flex gap-5 items-center justify-between">
                            <div class="flex gap-4">

                                <div class="flex flex-column gap-2">
                                    <p class="font-medium">Laundry</p>
                                    <div class="flex items-center gap-2">
                                        <div class="icon">
                                            <img src="../assets/icons/material-symbols-light_person.svg" alt="">
                                        </div>
                                        <p class="text-sm">Father</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/iconamoon_calendar-1-light.svg" alt="">
                                </div>
                                <p class="date_ass text-sm">Date assigned</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/tdesign_calendar-2.svg" alt="">
                                </div>
                                <p class="date_comp text-sm">Date completed</p>
                            </div>

                            <a href="" class="text-sm">Chore details</a>
                        </div>
                        <div class="r_card flex gap-5 items-center justify-between">
                            <div class="flex gap-4">

                                <div class="flex flex-column gap-2">
                                    <p class="font-medium">Laundry</p>
                                    <div class="flex items-center gap-2">
                                        <div class="icon">
                                            <img src="../assets/icons/material-symbols-light_person.svg" alt="">
                                        </div>
                                        <p class="text-sm">Father</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/iconamoon_calendar-1-light.svg" alt="">
                                </div>
                                <p class="date_ass text-sm">Date assigned</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="icon">
                                    <img src="../assets/icons/tdesign_calendar-2.svg" alt="">
                                </div>
                                <p class="date_comp text-sm">Date completed</p>
                            </div>

                            <a href="" class="text-sm">Chore details</a>
                        </div>

                    </div> -->
                    <?php getRecentPosts() ?>
                </div>
            </div>


        </div>
    </div>
</body>

</html>