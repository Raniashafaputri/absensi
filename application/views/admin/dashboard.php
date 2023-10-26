<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>

<style>
    .card {
        background-color: #f9f9f9;
        margin-top: 100px;
    }

    .table {
        width: 90%;
        margin-left: 200px;
    }

    .row {
        margin-left: 250px;
    }

    .icon {
        margin-top: 20px;
        float: right;
    }

    @media (max-width: 768px) {
        .card {
            background-color: #f9f9f9;
            margin-top: 70px;
        }

        .row {
            margin-left: 0;
        }

        .icon {
            float: none;
            margin-top: 10px;
        }
    }
</style>

<body>
    <?php $this->load->view('admin/index'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fas fa-check fa-4x icon float-end"></i>
                        <h6 class="card-title">Total karyawan</h6>
                        <h1>100</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fas fa-check fa-4x icon float-end"></i>
                        <h6 class="card-title">Total absen</h6>
                        <h1>15</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <i class="fas fa-check fa-4x icon float-end"></i>
                        <h6 class="card-title">Total</h6>
                        <h1>115</h1>
                    </div>
                </div>
            </div>
        </div>
        <style>
    table {
        width: 150%;
        border-collapse: collapse;
    }

    th, td {
        padding: 20px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #007BFF;
        color: #fff;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .number {
        font-weight: bold;
    }
</style>
        <table class="table table-striped mt-5">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kegiatan</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Jam Masuk</th>
                    <th scope="col">Jam Pulang</th>
                    <th scope="col">Keterangan</th>
                </tr>
                <?php $i = 1; ?>
                 <?php foreach ($absen as $row): ?>
                <tr>
                    <td><span class="number"><?php echo $i; ?></span></td>
                    <td><?php echo $row->kegiatan; ?></td>
                    <td><?php echo $row->date; ?></td>
                    <td><?php echo $row->jam_masuk; ?></td>
                    <td>
                        <span id="jam-pulang-<?php echo $i; ?>">
                            <?php echo $row->jam_pulang; ?>
                        </span>
                    </td>
                    <td>
                        <?php if (empty($row->keterangan_izin)): ?>
                        <span>Masuk</span>
                        <?php else: ?>
                        <?= $row->keterangan_izin; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>
