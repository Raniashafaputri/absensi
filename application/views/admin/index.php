<!DOCTYPE html>
<!-- Coding by CodingNepal || www.codingnepalweb.com -->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css" />
</head>
<style>
/* Import Google font - Poppins */
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap");

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "Poppins", sans-serif;
}

:root {
    --white-color: #fff;
    --blue-color: #4070f4;
    --grey-color: #707070;
    --grey-color-light: #aaa;
}

body {
    background-color: turquoise;
    transition: all 0.5s ease;
}

body.dark {
    background-color: #333;
}

body.dark {
    --white-color: #333;
    --blue-color: #fff;
    --grey-color: #f2f2f2;
    --grey-color-light: #aaa;
}

/* navbar */
.navbar {
    position: fixed;
    top: 0;
    width: 100%;
    left: 0;
    background-color: var(--white-color);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 15px 30px;
    z-index: 1000;
    box-shadow: 0 0 2px var(--grey-color-light);
}

.logo_item {
    display: flex;
    align-items: center;
    column-gap: 10px;
    font-size: 22px;
    font-weight: 500;
    color: var(--blue-color);
}

.navbar img {
    width: 35px;
    height: 35px;
    border-radius: 50%;
}

.search_bar {
    height: 47px;
    max-width: 430px;
    width: 100%;
}

.search_bar input {
    height: 100%;
    width: 100%;
    border-radius: 25px;
    font-size: 18px;
    outline: none;
    background-color: var(--white-color);
    color: var(--grey-color);
    border: 1px solid var(--grey-color-light);
    padding: 0 20px;
}

.navbar_content {
    display: flex;
    align-items: center;
    column-gap: 25px;
}

.navbar_content i {
    cursor: pointer;
    font-size: 20px;
    color: var(--grey-color);
}

/* sidebar */
.sidebar {
    background-color: var(--white-color);
    width: 260px;
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    padding: 80px 20px;
    z-index: 100;
    overflow-y: scroll;
    box-shadow: 0 0 1px var(--grey-color-light);
    transition: all 0.5s ease;
}

.sidebar.close {
    padding: 60px 0;
    width: 80px;
}

.sidebar::-webkit-scrollbar {
    display: none;
}

.menu_content {
    position: relative;
}

.menu_title {
    margin: 15px 0;
    padding: 0 20px;
    font-size: 18px;
}

.sidebar.close .menu_title {
    padding: 6px 30px;
}

.menu_title::before {
    color: var(--grey-color);
    white-space: nowrap;
}

.menu_dahsboard::before {
    content: "Dashboard";
}

.menu_editor::before {
    content: "Editor";
}

.menu_setting::before {
    content: "Setting";
}

.sidebar.close .menu_title::before {
    content: "";
    position: absolute;
    height: 2px;
    width: 18px;
    border-radius: 12px;
    background: var(--grey-color-light);
}

.menu_items {
    padding: 0;
    list-style: none;
}

.navlink_icon {
    position: relative;
    font-size: 22px;
    min-width: 50px;
    line-height: 40px;
    display: inline-block;
    text-align: center;
    border-radius: 6px;
}

.navlink_icon::before {
    content: "";
    position: absolute;
    height: 100%;
    width: calc(100% + 100px);
    left: -20px;
}

.navlink_icon:hover {
    background: var(--blue-color);
}

.sidebar .nav_link {
    display: flex;
    align-items: center;
    width: 100%;
    padding: 4px 15px;
    border-radius: 8px;
    text-decoration: none;
    color: var(--grey-color);
    white-space: nowrap;
}

.sidebar.close .navlink {
    display: none;
}

.nav_link:hover {
    color: var(--white-color);
    background: var(--blue-color);
}

.sidebar.close .nav_link:hover {
    background: var(--white-color);
}

.submenu_item {
    cursor: pointer;
}

.submenu {
    display: none;
}

.submenu_item .arrow-left {
    position: absolute;
    right: 10px;
    display: inline-block;
    margin-right: auto;
}
.sidebar.close .submenu {
    display: none;
}

.show_submenu~.submenu {
    display: block;
}

.show_submenu .arrow-left {
    transform: rotate(90deg);
}

.submenu .sublink {
    padding: 15px 15px 15px 52px;
}

.bottom_content {
    position: fixed;
    bottom: 60px;
    left: 0;
    width: 260px;
    cursor: pointer;
    transition: all 0.5s ease;
}

.bottom {
    position: absolute;
    display: flex;
    align-items: center;
    left: 0;
    justify-content: space-around;
    padding: 18px 0;
    text-align: center;
    width: 100%;
    color: var(--grey-color);
    border-top: 1px solid var(--grey-color-light);
    background-color: var(--white-color);
}

.bottom i {
    font-size: 20px;
}

.bottom span {
    font-size: 18px;
}

.sidebar.close .bottom_content {
    width: 50px;
    left: 15px;
}

.sidebar.close .bottom span {
    display: none;
}

.sidebar.hoverable .collapse_sidebar {
    display: none;
}

#sidebarOpen {
    display: none;
}

@media screen and (max-width: 768px) {
    #sidebarOpen {
        font-size: 25px;
        display: block;
        margin-right: 10px;
        cursor: pointer;
        color: var(--grey-color);
    }

    .sidebar.close {
        left: -100%;
    }

    .search_bar {
        display: none;
    }

    .sidebar.close .bottom_content {
        left: -100%;
    }
}
.dropdown-menu {
        background-color: #0C134F;
        border: none;
    }

    .dropdown-item {
        color: #fff;
    }

    .dropdown-item:hover {
        background-color: #1D267D;
    }

    .logout-button a {
        margin-top: 180%;
        text-align: left;
        /* Posisi teks pada tengah */
    }
</style>

<body>
    <!-- navbar -->
    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i>
            Admin
        </div>

        <div class="search_bar">
            <input type="text" placeholder="Search" />
        </div>

        <div class="navbar_content">
            <a href="<?= base_url('admin/profile')?>">
                <i class="bi bi-grid"></i>
                <img src="https://static.vecteezy.com/system/resources/thumbnails/002/318/271/small/user-profile-icon-free-vector.jpg"
                    alt="" class="profile" />
            </a>
        </div>
    </nav>

    <!-- sidebar -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <li class="item">
                    <a href="<?php echo base_url('admin');?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bxs-home'></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                    <a href="<?php echo base_url('admin/karyawan');
                         ?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bx-calendar'></i>
                        </span>
                        <span class="navlink">karyawan</span>
                    </a>
                    <div class="nav_link submenu" id="rekapDropdown">
                        <span class="navlink_icon">
                            <i class="fas fa-file mr-2"></i>
                        </span>
                        <span class="navlink">Menu Rekap</span>
                        <i class="fas fa-caret-down"></i>
                    </div>
                    <div class="dropdown-menu" aria-labelledby="rekapDropdown">
                        <a class="dropdown-item" href="<?php echo base_url('admin/rekapPerHari') ?>" class="nav_link submenu">
                            <span class="navlink_icon"><i class="fas fa-file-signature mr-2"></i></span>
                            <span class="navlink">Rekap Harian</span>
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('admin/rekapPerMinggu') ?>" class="nav_link submenu">
                            <span class="navlink_icon"><i class="fas fa-file-invoice mr-2"></i></span>
                            <span class="navlink">Rekap Mingguan</span>
                        </a>
                        <a class="dropdown-item" href="<?php echo base_url('admin/rekapPerBulan') ?>" class="nav_link submenu">
                            <span class="navlink_icon"><i class="fas fa-file-contract mr-2"></i></span>
                            <span class="navlink">Rekap Bulanan</span>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
                   <br>
        </div>
                      <!-- Mengganti teks "Keluar" dengan gambar kecil dan transparan --> 
                      <a href="<?php echo base_url('auth')?>" style="color: #fff; text-decoration: none;"> 
                      <img src="https://png.pngtree.com/png-vector/20190505/ourmid/pngtree-vector-logout-icon-png-image_1022628.jpg" 
                       alt="Logout" style="width: 20px; opacity: 0.5; margin-right: 10px;" /> 
                       </a> 
                        Logout
                        </nav>
 
    </nav>
    </a>
     </a>
    <!-- JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#rekapDropdown").click(function() {
            $(this).next(".dropdown-menu").toggleClass("show");
        });
    });
    </script>
    <script>
    const body = document.querySelector("body");
    const sidebar = document.querySelector(".sidebar");
    const submenuItems = document.querySelectorAll(".submenu_item");
    const sidebarOpen = document.querySelector("#sidebarOpen");
    const sidebarClose = document.querySelector(".collapse_sidebar");
    const sidebarExpand = document.querySelector(".expand_sidebar");
    sidebarOpen.addEventListener("click", () => sidebar.classList.toggle("close"));

    sidebarClose.addEventListener("click", () => {
        sidebar.classList.add("close", "hoverable");
    });
    sidebarExpand.addEventListener("click", () => {
        sidebar.classList.remove("close", "hoverable");
    });

    sidebar.addEventListener("mouseenter", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.remove("close");
        }
    });
    sidebar.addEventListener("mouseleave", () => {
        if (sidebar.classList.contains("hoverable")) {
            sidebar.classList.add("close");
        }
    });

    submenuItems.forEach((item, index) => {
        item.addEventListener("click", () => {
            item.classList.toggle("show_submenu");
            submenuItems.forEach((item2, index2) => {
                if (index !== index2) {
                    item2.classList.remove("show_submenu");
                }
            });
        });
    });

    if (window.innerWidth < 768) {
        sidebar.classList.add("close");
    } else {
        sidebar.classList.remove("close");
    }
    
    </script>
</body>

</html>
