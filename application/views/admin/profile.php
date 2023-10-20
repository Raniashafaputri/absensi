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
    background-color: #f0f0f0;
    margin: 5;
    padding: 5;
}

.container {
    padding: 50px;
}

.profile-card {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    padding: 0px;
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
    font-size: 50px;
    font-weight: bold;
}

.profile-role {
    color: #777;
    margin-bottom: 20px;
}

.profile-actions {
    display: flex;
    justify-content: center;
    margin-top: 40px;
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
}

.profile-details-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 50px;
}

hr {
    border-top: 7.9px solid #ccc;
}
</style>


<body>
    <section style="background-color: #eee;">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                    <section class="home-section">
                    <div class="home-content">
                        <div class="card-body text-center">
                        <div class="profile-image">
                               

                                <button for="image_upload" class="edit-button" data-bs-toggle="modal"
                                    data-bs-target="#editImageModal"><i class="fa-solid fa-pen"></i></button>
                                <input type="file" id="image" name="image" accept="image/*" style="display:none;">
                            </div>
                            <h5 class="card-title">
                                <?php echo $this->session->userdata('username'); ?>
                            </h5>
                            <p class="card-text">
                                <?php echo $this->session->userdata('email'); ?>
                            </p>
                        </div>

                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Username</p>
                                </div>
                                <div class="col-sm-9">
                                  
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                  
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nama Depan</p>
                                </div>
                                <div class="col-sm-9">

                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Nama Belakang</p>
                                </div>
                                <div class="col-sm-9">
                                  
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Role</p>
                                </div>
                                <div class="col-sm-9">
    
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        </div>
        </div>
    </section>
</body>

</html>