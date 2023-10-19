<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
.kegiatan {
    margin-left: 30%;
    margin-right: 10px;
    margin-top: 100px;
}
</style>

<body>
    <?php $this->load->view('employee/index'); ?>
    <div class="kegiatan mb-3">
    <form action="<?= base_url('employee/ubah_absensi/' . $absen_id); ?>" method="post">
                                <div class="mb-3">
                                    <label for="kegiatan" class="form-label">Kegiatan:</label>
                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan"
                                        value="<?= $absensi->kegiatan; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_masuk" class="form-label">Jam Masuk:</label>
                                    <input type="text" class="form-control" id="jam_masuk" name="jam_masuk"
                                        value="<?= $absensi->jam_masuk; ?>" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            </form>
                        </div>
                    </div>
            </div>
        </div>

        </section>



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
