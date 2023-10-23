<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Include CSS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
/* CSS styling for body */
body {
    font-family: Arial, sans-serif;
    background-color: turquoise;
    margin: 20px; /* Mengubah margin ke 0 dari 5 */
    padding: 20px; /* Mengubah padding ke 0 dari 5 */
}

/* CSS untuk judul card (username) dan informasi tambahan */
.card h5,
.card p {
    margin: 0;
    font-size: 1em;
    color: #555;
}

/* CSS styling for profile form */
.profile-form {
    margin-top: 20px;
    text-align: left;
    max-width: 700px; /* Sesuaikan dengan kebutuhan Anda */
    margin: 0 auto; /* Mengubah margin-left dan margin-right ke 0 auto */
}

/* CSS styling for form groups */
.form-group {
    position: relative;
    display: flex;
    flex-direction: column;
    margin-bottom: 15px;
}

.form-group label {
    font-weight: bold;
    margin-bottom: 5px;
}


/* CSS styling for smaller screens (max-width: 767px) */
@media (max-width: 767px) {
    .profile-form {
        max-width: 200%;
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

    button[type="submit"] span {
        margin-left: 2px;
    }
}

/* CSS styling for buttons */
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

/* CSS styling for modal */
.modal {
    display: none;
    position: fixed;
    top: 0;
    width: 300%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 3;
}

.modal-content {
    background-color: #fff;
    margin: 15%;
    padding: 50px;
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

/* CSS styling for input file */
input[type="file"] {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    width: 100%;
    margin-bottom: 10px;
}

/* CSS styling for modal image */
.modalimg {
    display: none;
    position: fixed;
    z-index: 1;
    left: 20%;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
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

/* CSS styling for profile image */
.profile-image img {
    cursor: pointer;
}
</style>
<body>
    <!-- Your PHP code and HTML content here -->

<?php $this->load->view('employee/index'); ?>
<?php foreach ($akun as $user): ?>
        <div class="">
            <div class=" container py-5 row" style="margin-left:500px">
                <div class="col-lg-4">
                <section class="home-section">
                    <div class="home-content">

                    </div>
                    <div class="card p-4">
                        <div class=" text-center">
                            <div class="profile-image">
                                <img src="<?php echo base_url('images/user/' . $user->image) ?>" alt="profileImg"
                                    class="rounded-circle" width="70%">

                                <input class="form-control" name="id" type="hidden" value="<?php echo $user->id ?>">
                                <button for="image_upload" class="edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editImageModal"><i class="fa-solid fa-pen"></i></button>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                            <h5 class="card-title">
                                <?php echo $this->session->userdata('username'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $this->session->userdata('email'); ?>
                            </p>
                        </div>
                    </div>
                    <div class="card p-4">
                        <form action="<?php echo base_url('employee/edit_profile'); ?>" class="profile-form"
                            enctype="multipart/form-data" method="post">

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" id="email" name="email" value="<?php echo $user->email ?>">
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input class="form-control" type="text" id="username" name="username" value="<?php echo $user->username ?>">
                            </div>
                            <div class="form-group">
                                <label for="first_name">Nama Depan</label>
                                <input class="form-control" type="text" id="nama_depan" name="nama_depan"
                                    value="<?php echo $user->nama_depan ?>">
                            </div>
                            <div class="form-group">
                                <label for="last_name">Nama Belakang</label>
                                <input class="form-control" type="text" id="nama_belakang" name="nama_belakang"
                                    value="<?php echo $user->nama_belakang ?>">
                            </div>
                            <div class="form-group position-relative">
                                <label for=" password_baru">Kata Sandi Baru</label>
                                <input class="form-control" type="password" id="password_baru" name="password_baru">
                            </div>
                            <div class="form-group position-relative">
                                <label for=" konfirmasi_password">Konfirmasi Kata Sandi Baru</label>
                                <input class="form-control" type="password" id="konfirmasi_password" name="konfirmasi_password">
                            </div>
                            <button class="save" type="submit"><i class="fa-solid fa-save"></i><span>Simpan
                                    Perubahan</span></button>

                        </form>

                    </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="imageModal" style="margin-left:300px">
                <div class="modal-content">
                    <span class="close" id="closeModal">&times;</span>
                    <form action="<?php echo base_url('employee/edit_image'); ?>" method="post"
                        enctype="multipart/form-data">
                        <input class="form-control" type="hidden" name="id" value="<?php echo $user->id; ?>">
                        <label for="image">Pilih gambar:</label>
                        <input class="form-control" type="file" id="image" name="image" accept="image/*">
                        <button type="submit">Simpan</button>
                    </form>
                </div>
            </div>

            <!-- Modal Image-->
            <div class="modalimg" id="imageModall">
                <div class="modal-content">
                    <span class="closes" id="closeModall">&times;</span>
                    <img src="<?php echo base_url('images/user/' . $user->image) ?>" alt="profileImg"
                        class="modal-image">
                </div>
            </div>

            </body>
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
           
</html>