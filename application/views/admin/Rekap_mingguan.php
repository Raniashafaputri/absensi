<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<style>
h2 {
    margin-top: 10px;
    margin-left: 20px;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f3f3f3;
    margin-top: 80px;
    margin-right: 10px;
    padding: 0px;
    margin-left: 130px;
}


form {
    width: 100%;
    margin-left: 200px;
}

.exp {
    margin-top: 100px;
}

.table {
    width: 100%;
    margin-top: 40px;
    margin-left: 30px;
}

@media (max-width: 768px) {
    form {
        margin-left: 10%;
    }

    h2 {
        margin-left: 10%;
    }

    .table {
        margin-left: 10%;
        margin-top: 10px;
    }
}
</style>

<body>
    <?php $this->load->view('admin/index'); ?>
    <div class="main m-4">
        <div class="container w-75">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Rekap Mingguan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/rekapPerMinggu'); ?>" method="get" class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal awal</span>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal akhir</span>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <!-- <button type="submit" class="btn btn-success">Filter</button> -->
                            <button type="submit" name="submit" class="btn btn-success "
                                formaction="<?php echo base_url('admin/export_mingguan')?>">Export</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if (empty($perminggu)): ?>
                        <h5 class="text-center">Tidak ada data diminggu ini ini.</h5>
                        <p class="text-center">Silahkan pilih Minggu lain.</p>
                        <?php else: ?>
                        <table class="table table-responsive table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; foreach ($perminggu as $rekap): $no++; ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= $rekap->kegiatan; ?></td>
                                    <td><?= $rekap->date; ?></td>
                                    <td><?= $rekap->jam_masuk; ?></td>
                                    <td><?= $rekap->jam_pulang; ?></td>
                                    <td>
                                        <?php if(empty($rekap->keterangan_izin) ): ?>
                                        <span>Masuk</span>
                                        <?php else: ?>
                                        <?= $rekap->keterangan_izin; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>