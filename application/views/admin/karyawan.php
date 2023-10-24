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
            background-color: skyblue;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .main {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 0;
            max-width: 1200px;
            width: 100%;
        }

        .card {
            margin: 5px;
        }

        .card-header {
            background-color: steelblue;
            color: #fff;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h3 {
            margin: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background-color: steelblue;
            color: #fff;
        }

        .table th, .table td {
            padding: 10px;
            text-align: left;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        .img-account-profile {
            border-radius: 50%;
        }

        /* Style export button */
        .btn-export {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            margin: 10px 0;
        }

        .btn-export:hover {
            background-color: #45a049;
        }

        /* Style navigation link */
        .nav-link {
            color: #007BFF;
            text-decoration: none;
        }

        .nav-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php $this->load->view('admin/index'); ?>
    <div class="main">
        <div class="container">
            <div class="card">
                <div class="card-header">
                    <h3>Daftar Karyawan</h3>
                    <a href="<?php echo base_url('admin/export_karyawan') ?>" class="btn-export">Export</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Foto</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Nama Depan</th>
                                    <th scope="col">Nama Belakang</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach ($user as $row): if ($row->role == 'karyawan') : $no++; ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <img class="img-account-profile rounded-circle" width="50px"
                                            src="<?php echo base_url('assets/images/user/' . $row->image) ?>" alt="">
                                    </td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->nama_depan ?></td>
                                    <td><?php echo $row->nama_belakang ?></td>
                                </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
