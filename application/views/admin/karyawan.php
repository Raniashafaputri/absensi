<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include your custom CSS here -->
    <link rel="stylesheet" href="path/to/your/custom.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: skyblue;
            margin: 20px;
            padding: 10px;
        }

        .main {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 1000px;
            width: 1200%;
            margin: 20px auto;
        }

        .card {
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #007BFF;
            color: #fff;
            padding: 10px;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
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
            background-color: skyblue;
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
    </style>
</head>

<body>
    <?php $this->load->view('admin/index'); ?>
    <!-- <div class="main"> -->
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
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; foreach ($user as $row): if ($row->role == 'karyawan') : $no++; ?>
                                <tr>
                                    <td><?php echo $no ?></td>
                                    <td>
                                        <img class="img-account-profile" width="50px"
                                            src="<?php echo base_url('assets/images/user/' . $row->image) ?>" alt="">
                                    </td>
                                    <td><?php echo $row->username ?></td>
                                    <td><?php echo $row->email ?></td>
                                    <td><?php echo $row->nama_depan ?></td>
                                    <td><?php echo $row->nama_belakang ?></td>
                                    <td><button type="button" class="btn btn-danger" onclick="hapus(<?php echo $row->id; ?>)"> <i class="fas fa-trash"></i> Hapus
                                        </button>

                                </tr>
                                <?php endif; endforeach; ?>
                            </tbody>
                        </table>
                        <script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin Di Hapus?',
            text: "Anda tidak dapat mengembalikannya!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url(
                    'admin/hapusKaryawan/'
                ); ?>" + id;
            }
        });
    }
    </script>

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
