<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
.table {
    width: 78%;
    margin-top: 100px;
    margin-left: 280px;
}
</style>

<body>
    <?php $this->load->view('employee/index'); ?>
    <table class="table text-center table-hover">
    <div class="table-responsive">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; foreach($absensi as $row): $no++ ?>
                                <tr class="text-center">
                                    <td><?php echo $no ?></td>
                                    <td><?php echo $row->date ?></td>

                                    <td><?php echo $row->jam_masuk ?></td>
                                    <td><?php echo $row->jam_pulang ?></td>
                                    <td><?php echo $row->status ?></td>
                                    <td>
                                        <?php if ($row->status == 'Izin'): ?>
                                        Izin
                                        <button onClick="hapus(<?php echo $row->id; ?>)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <?php elseif ($row->status == 'Pulang'): ?>
                                        <button class="btn btn-secondary" disabled>
                                            <i class="fas fa-house-user"></i>Pulang
                                        </button>
                                        <a href="<?php echo base_url('employee/ubah_absensi/') . $row->id ?>"
                                            class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <button onClick="hapus(<?php echo $row->id; ?>)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        <?php else: ?>
                                        <a href="<?php echo site_url('employee/pulang/' . $row->id); ?>"
                                            class="btn btn-success" id="pulangButton_<?php echo $row->id ?>">
                                            <i class="fas fa-house-user"></i> Pulang
                                        </a>
                                        <a href="<?php echo base_url('employee/ubah_absensi/') . $row->id ?>"
                                            class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Ubah
                                        </a>
                                        <button onClick="hapus(<?php echo $row->id; ?>)" class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    function hapus(id) {
        Swal.fire({
            title: 'Yakin DI Hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "<?php echo base_url('employee/hapus_history/') ?>" + id;
            }
        });
    }
    </script>
    <?php if ($this->session->flashdata('success')): ?>
    <script>
    Swal.fire({
        icon: 'success',
        title: '<?= $this->session->flashdata('success') ?>',
        showConfirmButton: false,
        timer: 1500
    });
    </script>
    <?php endif; ?>
    <!-- Bootstrap CSS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
    <?php foreach ($absensi as $row): ?>
    var absenId = <?php echo $row->id; ?>;
    var status = '<?php echo $row->status; ?>';
    disablePulangButton(absenId, status);
    <?php endforeach; ?>

    function showSweetAlert(message) {
        Swal.fire({
            icon: 'info',
            text: message,
            showConfirmButton: false,
            timer: 2000
        });
    }

    function disablePulangButton(absenId, status) {
        var pulangButton = document.getElementById("pulangButton_" + absenId);
        if (status === 'pulang') {
            pulangButton.classList.add("disabled");
            pulangButton.removeAttribute("href");
        }
    }
    </script>
    <script>
    // Mengambil nilai jumlah masuk dan jumlah izin dari PHP dan menampilkannya dalam elemen HTML
    const jumlahMasukElement = document.getElementById('jumlahMasuk');
    const jumlahIzinElement = document.getElementById('jumlahIzin');
    const jumlahTotalElement = document.getElementById('jumlahTotal');

    // Menetapkan nilai yang dihitung ke dalam elemen HTML
    jumlahMasukElement.textContent = '<?php echo $jumlahMasuk; ?>';
    jumlahIzinElement.textContent = '<?php echo $jumlahIzin; ?>';
    jumlahTotalElement.textContent = '<?php echo $jumlahTotal; ?>';
    </script>
<script>
function pulang(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url("employee/pulang/") ?>' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.status === 'true') {
                // Tombol "Pulang" berubah menjadi "Batal Pulang"
                var pulangButton = document.querySelector('a.btn[data-id="' + id + '"]');
                pulangButton.textContent = 'Batal Pulang';
                pulangButton.className = 'btn btn-danger';
                pulangButton.setAttribute('onclick', 'batalPulang(' + id + ');');

                // Update jam pulang dalam tabel
                var jamPulangCell = document.getElementById('jam-pulang-' + id);
                jamPulangCell.textContent = response.jam_pulang;
            }
        }
    };
    xhr.send();
}

function batalPulang(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '<?php echo base_url("employee/batal_pulang/") ?>' + id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);

            if (response.status === 'false') {
                // Tombol "Batal Pulang" berubah kembali menjadi "Pulang"
                var batalPulangButton = document.querySelector('a.btn[data-id="' + id + '"]');
                batalPulangButton.textContent = 'Pulang';
                batalPulangButton.className = 'btn btn-warning';
                batalPulangButton.setAttribute('onclick', 'pulang(' + id + ');');

                // Hapus jam pulang dalam tabel
                var jamPulangCell = document.getElementById('jam-pulang-' + id);
                jamPulangCell.textContent = '';
            }
        }
    };
    xhr.send();
}
</script>


<?php ?>

</html>

