<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/responsive.css'); ?>">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: turquoise;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .main {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 1700px;
            width: 50%;
        }

        .card {
            border: none;
        }

        .card-header {
            background-color: steelblue;
            color: #fff;
            padding: 30px;
            border-radius: 5px 5px 0 0;
        }

        .card-header h5 {
            margin: 0;
        }

        .card-body {
            padding: 25px;
        }

        .btn-primary {
            background-color: #007BFF;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .btn-success:hover {
            background-color: #1e7e34;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        th, td {
            padding: 20px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>

<body>
<?php $this->load->view('admin/index'); ?>

    <div class="main">
        <div class="container">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h1>REKAP HARIAN</h1>
                </div>
                <div class="card-body">
                    <!-- Filter Tanggal -->
                    <form action="<?= base_url('admin/rekapPerHari'); ?>" method="get">
                        <div class="d-flex justify-content-between">
                            <input type="date" class="form-control" id="tanggal" name="tanggal"
                                value="<?php echo isset($_GET['tanggal']) ? $_GET['tanggal'] : ''; ?>">
                            <button type="submit" name="submit" class="btn btn-sm btn-primary"
                                formaction="<?php echo base_url('admin/export_harian')?>">Export</button>
                            <button type="submit" class="btn btn-success ml-3">Filter</button>
                        </div>
                    </form>
                    <br>
                    <hr>
                    <br>
                    <div class="table-responsive">
                        <?php if(!empty($perhari)): ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Kegiatan</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam Masuk</th>
                                    <th scope="col">Jam Pulang</th>
                                    <th scope="col">Keterangan</th>
                                    <th scope="col">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0;foreach ($perhari as $rekap): $no++ ?>
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
                        <?php else: ?>
                        <h5 class="text-center">Tidak ada data untuk tanggal ini.</h5>
                        <p class="text-center">Silahkan pilih tanggal lain.</p>
                        <?php endif; ?>
                    </div>
                </div>
                </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
