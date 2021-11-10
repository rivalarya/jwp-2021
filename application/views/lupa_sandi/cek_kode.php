<div class="wave"></div>
<div class="container-fluid row align-content-center vh-100 mx-auto">
    <?php if (validation_errors()) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('kode_salah')) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo $this->session->flashdata('kode_salah'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('kode_salah')) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo $this->session->flashdata('kode_salah'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('akun_tidak_minta')) : ?>
        <div class="w-100 alert alert-danger text-center" role="alert">
            <?php echo $this->session->flashdata('akun_tidak_minta'); ?>
        </div>
    <?php endif; ?>
    <div class="col-sm-7 p-2 border border-primary mx-auto shadow bg-light rounded">
        <div class="nav-item">
            <a class="nav-link text-center font-weight-bold"><b>Masukan Email dan kode verifikasi</b></a>
        </div>
        <hr>
        <form class="text-center" method="POST" action="<?= base_url('lupa_sandi/cek_kode'); ?>">
            <div class="col mt-3">
                <div class="form-group">
                    <input type="email" required name="email" placeholder="Masukkan email" class="input--custom mb-2 pl-2" value="<?= $this->session->userdata('email_ganti') ?>">
                    <input type="text" placeholder="Masukkan kode" autocomplete="off" required name="kode" class="input--custom mt-1 pl-2" value="<?= $this->input->get('kode'); ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2 mt-3">Kirim</button>
            </div>
        </form>
    </div>
</div>