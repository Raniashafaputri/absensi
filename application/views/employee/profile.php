<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./profile.css" />
    <title>Tugas Rania/profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    <style>
  /* CSS untuk card */
  .card {
        border: 1px solid #6699ff;
        border-radius: 10px;
        padding:auto;
        margin:100px;
        max-width: 1200px;
        text-align: center;

    }

    /* CSS untuk gambar profil */
    .card img {
        width: 100px;
        /* Sesuaikan ukuran gambar profil sesuai kebutuhan Anda */
        height: 100px;
        object-fit: cover;
        border: 2px solid #6699ff;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    /* CSS untuk judul card (username) */
    .card h5 {
        margin: 0;
        font-size: 1.5em;
    }

    /* CSS untuk informasi tambahan */
    .card p {
        font-size: 1em;
        color: #555;
    }

    /* CSS untuk membuat tata letak responsif */
    @media (max-width: 767px) {

        /* Misalnya, pada layar dengan lebar kurang dari atau sama dengan 767px */
        .card {
            max-width: 100%;
            /* Lebar kartu akan mengisi seluruh lebar tata letak */
        }

        .card img {
            width: 80px;
            /* Ukuran gambar profil lebih kecil pada layar kecil */
            height: 80px;
        }

        .card p {
            font-size: 10px;
            /* Ukuran font lebih kecil pada layar kecil */
        }
    }
</style>

<body>
<?php $this->load->view('employee/index'); ?>

<section class="home-section">
                    <div class="home-content">

                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <?php
                            $profile_image_url = isset($this->session->userdata['image']) ? base_url('images' . $this->session->userdata('image')) : base_url('images/user/');
                            ?>
                            <img src="<?php echo $profile_image_url; ?>" alt="profileImg" class="rounded-circle">
                            <h5 class="card-title">
                                <?php echo $this->session->userdata('username'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $this->session->userdata('email'); ?>
                            </p>
                            <p class="card-text">***********</p>
                            <!-- Tampilkan tanda bintang atau karakter lain sebagai ganti password -->
                            <!-- Tambahkan tombol "Ubah" pada halaman profil -->
                            <a href="<?php echo base_url('karyawan/edit_profile') ?>" class="btn btn-primary">Ubah
                                Profile</a>

                        </div>
                    </div>
            </div>
        </div>

        </section>

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

        <script>
        const arrows = document.querySelectorAll(".arrow");

        arrows.forEach((arrow) => {
            arrow.addEventListener("click", (e) => {
                const arrowParent = e.target.closest(".arrow").parentElement.parentElement;
                arrowParent.classList.toggle("showMenu");
            });
        });

        const sidebar = document.querySelector(".sidebar");
        const sidebarBtn = document.querySelector(".fa-bars");

        sidebarBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
        </script>

            </div>
        
    </body>
</html>