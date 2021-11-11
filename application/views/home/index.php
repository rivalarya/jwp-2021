<div class="container-fluid row align-content-center vh-100 mx-auto">
    <div class="col-sm-7 h-25 mx-auto rounded">
        <div class="row bg-home rounded position-relative shadow">
            <a href="<?= base_url('home/logout') ?>" class="keluar">
                <button class="btn p-1 btn-primary rounded">Keluar</button>
            </a>
            <div class="col d-flex justify-content-center align-items-center">
                <figure class="figure mt-3">
                    <img src="<?= base_url('assets/img/'); ?><?= $_SESSION['foto']; ?>" class="figure-img shadow rounded-circle size-foto" alt="Foto">
                </figure>
            </div>
            <div class="col d-flex justify-content-center align-items-center flex-column p-3">
                <div class="card">
                    <div class="card-header text-center">
                        <b>Data</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama : <?= $_SESSION['nama']; ?></li>
                        <li class="list-group-item">Email : <?= $_SESSION['email']; ?></li>
                        <li class="list-group-item">Password : <?= $_SESSION['password']; ?></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>