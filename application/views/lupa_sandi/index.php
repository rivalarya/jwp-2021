<div class="wave"></div>
<div class="container-fluid row align-content-center vh-100 mx-auto">
    <?php if ($this->session->flashdata('email_dikirim')) : ?>
        <div class="w-100 alert alert-success text-center" role="alert">
            <?php echo $this->session->flashdata('email_dikirim'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('email_gagal_dikirim')) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo $this->session->flashdata('email_gagal_dikirim'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('belum_daftar')) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo $this->session->flashdata('belum_daftar'); ?>
        </div>
    <?php endif; ?>
    <div class="col-sm-7 p-2 border border-primary mx-auto shadow bg-light rounded">
        <div class="nav-item">
            <a class="nav-link text-center font-weight-bold"><b>Lupa kata sandi</b></a>
        </div>
        <hr>
        <form class="text-center" method="POST" action="<?= base_url('lupa_sandi/kirim_kode'); ?>">
            <div class="col mt-3">
                <div class="form-group">
                    <input type="email" placeholder="Masukkan Email" autocomplete="off" required name="email" class="input--custom mt-1 pl-2">
                </div>
                <button type="submit" class="btn btn-primary mb-2 mt-3">Minta link untuk ganti sandi</button>
            </div>
        </form>
    </div>
</div>