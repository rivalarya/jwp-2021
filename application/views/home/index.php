<div class="container-fluid row align-content-center vh-100 mx-auto">
    <div class="col-sm-9 h-25 mx-auto rounded">
        <div class="row bg-home rounded position-relative shadow">
    <div class="col d-flex justify-content-center align-items-center">
        <figure class="figure mt-3">
            <img src="<?= base_url('assets/img/'); ?><?= $_SESSION['foto']; ?>" class="figure-img shadow rounded-circle size-foto"
                alt="Foto">
        </figure>
    </div>
    <div class="col d-flex justify-content-center align-items-center flex-column p-3">
        <div class="card">
  <div class="card-header text-center">
    <b>Data</b>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Nama : <?= $_SESSION['nama']; ?></li>
    <li class="list-group-item">Username : <?= $_SESSION['email']; ?></li>
    <li class="list-group-item">Password : <?= $_SESSION['password']; ?></li>
  </ul>
  <!-- <a href="<?= base_url('home/logout') ?>">
    <button class="btn p-1 btn-primary rounded">Keluar</button>
</a> -->
</div>
        <!-- <div class="">
            <label for="nama">Nama</label> 
            <input type="text"><?= $_SESSION['nama']; ?>
        </div>
        <div class="mt-2">
            <?= $_SESSION['email']; ?>
        </div>
        <div class="mt-2">
           <?= $_SESSION['password']; ?>
        </div>
    </div> -->
    <!-- <a href="<?= base_url('home/logout') ?>">
    <button class=" p-1 btn-primary rounded">Keluar</button>
</a> -->
    
</div>
<a href="<?= base_url('home/logout') ?>">
    <button class="btn p-1 btn-primary rounded keluar">Keluar</button>
</a>
    </div>
</div>
