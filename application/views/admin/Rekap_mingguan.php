<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3;
            margin: 0;
            padding: 0;
        }

        .main {
            background-color: turquoise;
            padding: 190px;
        }

        .card-header {
            background-color: steelblue;
            color: #fff;
        }

        .input-group {
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
<?php $this->load->view('admin/index'); ?>

    <div class="main m-4">
        <div class="container w-75">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5>Rekap Mingguan</h5>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/Rekapmingguan'); ?>" method="get">
                        <div class="d-flex justify-content-between">
                            <div class="input-group">
                                <span class="input-group-text">Tanggal awal</span>
                                <input type="date" class="form-control" id="start_date" name="start_date"
                                    value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>">
                            </div>
                            <div class="input-group">
                                <span class="input-group-text">Tanggal akhir</span>
                                <input type="date" class="form-control" id="end_date" name="end_date"
                                    value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>">
                            </div>
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"
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
                        <table class="table">
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
                                    <td><?= $rekap->date; ?></td>
                                    <td><?= $rekap->kegiatan; ?></td>
                                    <td><?= $rekap->jam_masuk; ?></td>
                                    <td><?= $rekap->jam_pulang; ?></td>
                                    <td><?= $rekap->keterangan_izin; ?></td>
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