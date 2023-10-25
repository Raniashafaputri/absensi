<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #eee;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 50px;
    }

    .profile-card {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .profile-image {
        position: relative;
        display: inline-block;
    }

    .profile-image img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border: 2px solid #6699ff;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .profile-name {
        font-size: 24px;
        font-weight: bold;
    }

    .profile-role {
        color: #777;
        margin-bottom: 20px;
    }

    .profile-actions {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .profile-actions button {
        padding: 10px 20px;
        margin: 0 10px;
        border: none;
        border-radius: 10px;
        cursor: pointer;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;
    }

    .btn-success {
        background-color: #28a745;
        color: #fff;
    }

    .profile-details {
        text-align: left;
        margin-top: 20px;
    }

    .profile-details-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    hr {
        border-top: 1px solid #ccc;
    }
</style>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="profile-card">
                        <div class="profile-image">
                            <img src="your-image-url" alt="Profile Image">
                        </div>
                        <h5 class="profile-name">
                            <?php echo $this->session->userdata('username'); ?>
                        </h5>
                        <p class="profile-role">
                            <?php echo $this->session->userdata('email'); ?>
                        </p>
                        <div class="profile-actions">
                            <button class="btn btn-warning">Edit</button>
                            <button class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="profile-card">
                        <div class="profile-details">
                            <div class="profile-details-row">
                                <p>Username</p>
                                <p><?php echo $this->session->userdata('username'); ?></p>
                            </div>
                            <hr>
                            <div class="profile-details-row">
                                <p>Email</p>
                                <p><?php echo $this->session->userdata('email'); ?></p>
                            </div>
                            <hr>
                            <div class="profile-details-row">
                                <p>Nama Depan</p>
                            </div>
                            <hr>
                            <div class="profile-details-row">
                                <p>Nama Belakang</p>
                            </div>
                            <hr>
                            <div class="profile-details-row">
                                <p>Role</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
