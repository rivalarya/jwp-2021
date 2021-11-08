<div class="wave"></div>
<div class="container-fluid row align-content-center vh-100 mx-auto">
	<?php if(validation_errors()): ?>
	<div class="w-100 alert alert-danger text-center" role="alert">  
		<?php echo validation_errors(); ?>
	</div>
	<?php endif;?>
    <div class="container p-2 border border-primary mx-auto shadow bg-light rounded">
        <ul class="nav nav-pills mb-3 justify-content-around" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link aktif" id="pills-login-tab" data-toggle="tab" href="#pills-login" role="tab"
                    aria-controls="pills-login" aria-selected="true"><b>Login</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-daftar-tab" data-toggle="pill" href="#pills-daftar" role="tab"
                    aria-controls="pills-daftar" aria-selected="false"><b>Daftar</b></a>
            </li>
        </ul>
        <hr>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab">
                <form class="text-center" method="POST" action="<?= base_url('login');?>">
                    <div class="col mt-5">
                        <div class="form-group">
                            <input type="text" id="email" placeholder="Masukkan Email" autocomplete="off" required
                                name="email" class="input--custom mt-1 pl-2">
                        </div>
                        <div class="form-group">
                            <input type="password" id="password" placeholder="Masukkan Password" required
                                name="password" class="input--custom mt-2 pl-2">
                        </div>
                        <a href="<?= base_url('lupa_kata_sandi'); ?>" class="justify-content-end row mr-2">Lupa kata
                            sandi?</a>
                        <button type="submit" class="btn btn-primary mb-2 mt-3">Login</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-daftar" role="tabpanel" aria-labelledby="pills-daftar-tab">
                <div class="tab-pane fade show active" id="pills-daftar" role="tabpanel"
                    aria-labelledby="pills-daftar-tab">
                    <form class="text-center" method="POST" enctype="multipart/form-data" action="<?= base_url('home/daftar');?>" accept-charset="utf-8">
                        <div class="col form-group">
                            <figure class="figure">
                                <img src="<?= base_url('assets/img/user.png');?>"
                                    class="figure-img shadow rounded-circle size-foto" alt="Foto">
                            </figure>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="foto" name="foto" onchange="gantiValueLabel(this)" required>
                                <label class="custom-file-label" for="foto">Pilih foto...</label>
                            </div>
                        </div>
                        <div class="col mt-5">
                            <div class="form-group">
                                <input type="text" placeholder="Masukkan Nama" value="<?php echo set_value('nama'); ?>" required name="nama" class="input--custom mt-1 pl-2">
                            </div>
                            <div class="form-group">
                                <input type="text" placeholder="Masukkan Email" required name="email" class="input--custom mt-1 pl-2">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Masukkan Password" required name="password" class="input--custom mt-2 pl-2">
                            </div>
                        </div>
						<button type="submit" class="btn btn-primary mb-2 mt-3">Daftar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>