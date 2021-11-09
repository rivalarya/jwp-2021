<div class="container-fluid row align-content-center vh-100 mx-auto">
    <div class="col-10 h-25 p-2mx-auto shadow rounded">
        <div class="row bg-dark rounded">
    <div class="col d-flex justify-content-center align-items-center">
        <figure class="figure mt-3">
            <img src="http://localhost/jwp-2021/assets/img/user.png" class="figure-img shadow rounded-circle size-foto"
                alt="Foto">
        </figure>
    </div>
    <div class="col d-flex justify-content-center align-items-center flex-column">
        <div class="">
            nama
        </div>
        <div class="mt-2">
            <?= $_SESSION['email']; ?>
        </div>
        <div class="mt-2">
           <?= $_SESSION['password']; ?>
        </div>
    </div>
    <a href="<?= base_url('home/logout') ?>">
    <button class=" p-1 btn-primary rounded">Keluar</button>
</a>
    
</div>
    </div>
</div>
