<div class="wave"></div>
<div class="container-fluid row align-content-center vh-100 mx-auto">
    <?php if ($this->session->flashdata('berhasil_diganti')) : ?>
        <div class="w-100 alert alert-success text-center" role="alert">
            <?php echo $this->session->flashdata('berhasil_diganti'); ?>
        </div>
    <?php endif; ?>
    <?php if ($this->session->userdata('ganti_sandi') == '') : ?>
        redirect('welcome');
        <!-- <div class="w-100 alert alert-success text-center" role="alert">
            <?php echo $this->session->flashdata('berhasil_diganti'); ?>
        </div> -->
    <?php endif; ?>
    <div class="col-sm-7 p-2 border border-primary mx-auto shadow bg-light rounded">
        <div class="nav-item">
            <a class="nav-link text-center font-weight-bold"><b>Ganti kata sandi</b></a>
        </div>
        <hr>
        <form class="text-center" method="POST" action="<?= base_url('lupa_sandi/ganti_sandi'); ?>">
            <div class="col mt-3">
                <div class="form-group">
                    <input type="email" required name="email" class="sr-only" value="<?php echo $this->session->userdata('email_ganti'); ?>">
                    <label for="password"></label>
                    <input type="text" placeholder="Masukkan password baru" autocomplete="off" required name="password" class="input--custom mt-1 pl-2">
                </div>
                <button type="submit" class="btn btn-primary mb-2 mt-3">Ganti sandi</button>
            </div>
        </form>
    </div>
</div>