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
    <form action="<?= base_url('employee/aksi_menu_absen'); ?>" method="post" class="mt-3">
                                    <div class="mb-4">
                                        <label for="kegiatan" class="form-label">
                                            <h4>Kegiatan</h4>
                                        </label>
                                        <textarea class="form-control" id="kegiatan" name="kegiatan" rows="3"
                                            required></textarea>

                                        <button type="submit" class="btn btn-primary">Absen</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan tautan ke SweetAlert JS -->
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.7/dist/sweetalert2.min.js">
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
                    </script>
                    <script src="path/to/your/custom.js"></script>
                    <!-- Tambahkan script JavaScript untuk SweetAlert -->
                    <script>
                    <?php if ($this->session->flashdata('success')) : ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '<?= $this->session->flashdata('success') ?>'
                    });
                    <?php endif; ?>
                    </script>


</body>

</html>
