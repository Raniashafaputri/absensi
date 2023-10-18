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
    <form action="<?= base_url('employee/aksi_menu_izin'); ?>" method="post">
                                        <div class="mb-3">
                                            <label for="keterangan">Keterangan Izin</label>
                                            <textarea class="form-control" id="keterangan" name="keterangan" rows="4"
                                                required></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
                                    </form>
    </div>
</body>

</html>
