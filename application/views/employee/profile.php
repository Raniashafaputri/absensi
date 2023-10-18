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
   /* CSS untuk judul card (username) dan informasi tambahan */
   .card h5,
    .card p {
        margin: 0;
        font-size: 1em;
        color: #555;
    }

    .profile-form {
        margin-top: 20px;
        text-align: left;
        max-width: 400px;
        /* Sesuaikan dengan kebutuhan Anda */
        margin-left: auto;
        margin-right: auto;
    }

    .form-group {
        position: relative;
        display: flex;
        flex-direction: column;
        /* Menampilkan label di atas input */
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 5px;
    }

    .form-group input {
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding-right: 40px;
    }

    .form-group .input-group-text {
        position: relative;
        top: 0;
        transform: none;
        cursor: pointer;
    }

    .form-group button {
        font-weight: bold;
        background-color: #343a40;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        display: inline-block;
        align-self: flex-start;
    }


    .form-group.position-relative {
        position: relative;
    }

    .form-group.position-relative input {
        padding-right: 40px;
        /* Biarkan ruang untuk ikon */
    }

    .form-group.position-relative .input-group-text {
        position: absolute;
        right: 10px;
        /* Sesuaikan posisi ikon */
        top: 70%;
        transform: translateY(-50%);
        cursor: pointer;
    }


    @media (max-width: 767px) {
        .profile-form {
            max-width: 100%;
        }

        .form-group label {
            font-size: 14px;
        }

        .form-group input {
            padding: 8px;
        }

        .form-group button {
            font-size: 14px;
        }

        /* Opsi tambahan: menyesuaikan teks tombol */
        button[type="submit"] span {
            margin-left: 3px;
        }
    }

    button[type="submit"]:hover {
        background-color: #343a40;
    }

    button[type="submit"]:focus {
        outline: none;
    }

    /* Opsi tambahan: menyesuaikan teks tombol */
    button[type="submit"] span {
        vertical-align: middle;
        margin-left: 5px;
    }

    /* Style untuk modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.7);
        z-index: 3;
    }

    .modal-content {
        background-color: #fff;
        margin: 15%;
        padding: 20px;
        border-radius: 5px;
        width: 50%;
        position: relative;
    }

    .close {
        position: absolute;
        top: 0;
        right: 0;
        padding: 10px;
        cursor: pointer;
    }

    .close:hover {
        color: #f00;
    }

    /* Memperbaiki tampilan input file */
    input[type="file"] {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 100%;
        margin-bottom: 10px;
    }

    /* Memperbaiki tampilan tombol Simpan dan menambahkan ikon */
    button[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        display: inline-flex;
        align-items: center;
        transition: background-color 0.3s;
    }

    button[type="submit"] i {
        margin-right: 5px;
    }

    /* Tambahkan CSS untuk modal */
    .modalimg {
        display: none;
        position: fixed;
        z-index: 1;
        left: 20%;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.9);
        padding-top: 60px;
    }

    .modalimg-content {
        margin: 5% auto;
        display: block;
        max-width: 700px;
    }

    .closes {
        color: #fff;
        font-size: 35px;
        font-weight: bold;
        position: absolute;
        top: 15px;
        right: 35px;
    }

    .modal-image {
        max-width: 100%;
        max-height: 100%;
        display: block;
        margin: auto;
    }

    .profile-image img {
        cursor: pointer;
    }
    </style>
</head>

<body>
    <?php $this->load->view('employee/index'); ?>
<?php foreach ($akun as $users): ?>


 <section class="home-section">
                    <div class="home-content">

                    </div>
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="profile-image">
                                <img src="<?php echo base_url('images/user/' . $users->image) ?>" alt="profileImg"
                                    class="rounded-circle">

                                <input name="id" type="hidden" value="<?php echo $users->id ?>">
                                <button for="image_upload" class="edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editImageModal"><i class="fa-solid fa-pen"></i></button>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                            <h5 class="card-title">
                                <?php echo $this->session->userdata('username'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $this->session->userdata('email'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <form action="<?php echo base_url('karyawan/edit_profile'); ?>" class="profile-form"
                            enctype="multipart/form-data" method="post">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $users->email ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" id="username" name="username" value="<?php echo $users->username ?>">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Nama Depan</label>
                                <input type="text" id="nama_depan" name="nama_depan"
                                    value="<?php echo $users->nama_depan ?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Nama Belakang</label>
                                <input type="text" id="nama_belakang" name="nama_belakang"
                                    value="<?php echo $users->nama_belakang ?>">
                            </div>
                            <div class="form-group position-relative"">
                                <label for=" password_baru">Kata Sandi Baru</label>
                                <input type="password" id="password_baru" name="password_baru">
                            </div>
                            <div class="form-group position-relative"">
                                <label for=" konfirmasi_password">Konfirmasi Kata Sandi Baru</label>
                                <input type="password" id="konfirmasi_password" name="konfirmasi_password">
                            </div>
                            <button class="save" type="submit"><i class="fa-solid fa-save"></i><span>Simpan
                                    Perubahan</span></button>

                        </form>

                    </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="imageModal">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <form action="<?php echo base_url('karyawan/edit_image'); ?>" method="post"
                        enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $users->id; ?>">
                        <label for="image">Pilih gambar:</label>
                        <input type="file" id="image" name="image" accept="image/*">
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Modal Image-->
            <div class="modalimg" id="imageModall">
                <div class="modal-content">
                    <span class="closes" id="closeModall">&times;</span>
                    <img src="<?php echo base_url('images/karyawan/' . $user->image) ?>" alt="profileImg"
                        class="modal-image">
                </div>
            </div>

            </section>
            <script>
            function togglePassword(inputId) {
                var x = document.getElementById(inputId);
                var icon = document.getElementById("icon-" + inputId);

                if (x.type === "password") {
                    x.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    x.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
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
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
            <!-- LOGOUT -->
            <script>
            function confirmLogout() {
                Swal.fire({
                    title: 'Yakin mau LogOut?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "<?php echo base_url('auth') ?>";
                    }
                });
            }
            </script>
            <?php if ($this->session->flashdata('kesalahan_password')) { ?>
            <script>
            Swal.fire({
                title: "Error!",
                text: "<?php echo $this->session->flashdata('kesalahan_password'); ?>",
                icon: "warning",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>

            <?php if ($this->session->flashdata('gagal_update')) { ?>
            <script>
            Swal.fire({
                title: "Error!",
                text: "<?php echo $this->session->flashdata('gagal_update'); ?>",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>

            <?php if ($this->session->flashdata('error_profile')) { ?>
            <script>
            Swal.fire({
                title: "Error!",
                text: "<?php echo $this->session->flashdata('error_profile'); ?>",
                icon: "error",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>

            <?php if ($this->session->flashdata('berhasil_ubah_foto')) { ?>
            <script>
            Swal.fire({
                title: "Berhasil",
                text: "<?php echo $this->session->flashdata('berhasil_ubah_foto'); ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>

            <?php if ($this->session->flashdata('ubah_password')) { ?>
            <script>
            Swal.fire({
                title: "Success!",
                text: "<?php echo $this->session->flashdata('ubah_password'); ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>

            <?php if ($this->session->flashdata('update_user')) { ?>
            <script>
            Swal.fire({
                title: "Success!",
                text: "<?php echo $this->session->flashdata('update_user'); ?>",
                icon: "success",
                showConfirmButton: false,
                timer: 1500
            });
            </script>
            <?php } ?>
            <script>
            // Membuka modal saat tombol edit diklik
            document.querySelector('.edit-button').addEventListener('click', () => {
                document.querySelector('.modal').style.display = 'block';
            });

            // Menutup modal saat tombol close pada modal diklik
            document.querySelector('#closeModal').addEventListener('click', () => {
                document.querySelector('.modal').style.display = 'none';
            });

            // Menutup modal jika area luar modal diklik
            window.addEventListener('click', (e) => {
                if (e.target == document.querySelector('.modal')) {
                    document.querySelector('.modal').style.display = 'none';
                }
            });
            </script>
            <script>
            // Script untuk membuka modal ketika gambar diklik
            document.querySelectorAll('.trigger-modall').forEach(item => {
                item.addEventListener('click', event => {
                    document.getElementById('imageModall').style.display = "block";
                });
            });

            // Script untuk menutup modal
            document.getElementById('closeModall').addEventListener('click', function() {
                document.getElementById('imageModall').style.display = "none";
            });
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
                crossorigin="anonymous"></script>
            <?php endforeach ?>
            </section>
            <script>
            function togglePassword(inputId) {
                var x = document.getElementById(inputId);
                var icon = document.getElementById("icon-" + inputId);

                if (x.type === "password") {
                    x.type = "text";
                    icon.classList.remove("fa-eye");
                    icon.classList.add("fa-eye-slash");
                } else {
                    x.type = "password";
                    icon.classList.remove("fa-eye-slash");
                    icon.classList.add("fa-eye");
                }
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
        
    </body>
</html>