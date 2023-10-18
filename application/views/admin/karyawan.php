<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/your/custom.css">
</head>
<style> 
    h2 { 
        margin-top: 10%; 
        margin-left: 20%; 
    } 
 
    .exp { 
        margin-left: 15%; 
    } 
 
    table { 
        margin-top: 1rem; 
        margin-left: 17%; 
        width: 40%; /* Added width to the table */ 
    } 
 
    .btn-success { 
        background-color: #28a745; 
        color: #fff; 
    } 
 
    @media (max-width: 50px) { 
        h2 { 
            margin-top: 50px; 
            margin-left: 10%; 
        } 
 
        table { 
            margin-left: 5%; 
        } 
    } 
</style>

<body>
<?php $this->load->view('admin/index'); ?>

    <div class="comtainer-fluid">
        <div class="col-md-10">
            <h2>Daftar Karyawan</h2>
            <a href="<?php echo base_url('admin/export_karyawan')?>"><button type="submit"
                                    class="btn btn-success">export</button></a>
   <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <li class="item">
                    <a href="<?php echo base_url('admin');?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bxs-home'></i>
                        </span>
                        <span class="navlink">Dashboard</span>
                    </a>
                    <a href="<?php echo base_url('admin/karyawan');
                         ?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bx-calendar'></i>
                        </span>
                        <span class="navlink">karyawan</span>
                    </a>
                    <a href="<?php echo base_url('admin/rekap_bulanan');
                         ?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bxs-user-check'></i>
                        </span>
                        <span class="navlink">Rekap bulanan</span>
                    </a>
                    <a href="<?php echo base_url('admin/Rekap_harian');
                         ?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bxs-user-check'></i>
                        </span>
                        <span class="navlink">Rekap harian</span>
                    </a>
                    <a href="<?php echo base_url('admin/rekapPerMinggu');
                         ?>" class="nav_link submenu">
                        <span class="navlink_icon">
                        <i class='bx bxs-user-check'></i>
                        </span>
                        <span class="navlink">Rekap mingguan</span>
                    </a>
                </li>
                </div>
                </ul>
        </div>
    </nav>

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                     </tr>
                </thead>
                <tbody class="table-group-divider">
                        <?php $no=0;foreach($user as $row): $no++?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $row->username ?></td>
                            <td><?php echo $row->email ?></td>
                            <?php endforeach ?>
                    </tbody>
                        </table>


        </div>
    </div>
    <!-- Tambahkan tag-script Anda di sini, seperti JavaScript yang dibutuhkan -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="path/to/your/custom.js"></script>
</body>

</html>
