<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivasi</title>
    <link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
</head>
<style>
    body {
        font-weight: 600;
    }

    .green {
        color: green;
        background-color: rgba(11, 255, 2, 0.271);
        padding: 2%;
    }

    .red {
        color: red;
        background-color: rgba(255, 11, 2, 0.271);
        padding: 2%;
    }
</style>

<body>
    <div class="container-fluid row align-content-center vh-100 mx-auto">
        <div class="col-10 h-25 p-2 border border-primary mx-auto shadow bg-light rounded">
            <?php if($this->session->flashdata('berhasil_aktivasi')): ?>
            <div class="w-100 d-flex justify-content-center align-items-center text-center green h-100">
                <h2><?php echo $this->session->flashdata('berhasil_aktivasi'); ?></h2>
            </div>
            <?php endif;?>
            <?php if($this->session->flashdata('email_tidak_ditemukan')): ?>
            <div class="w-100 d-flex justify-content-center align-items-center text-center red h-100">
                <h2><?php echo $this->session->flashdata('email_tidak_ditemukan'); ?></h2>
            </div>
            <?php endif;?>
            <?php if($this->session->flashdata('token_tidak_ditemukan')): ?>
            <div class="w-100 d-flex justify-content-center align-items-center text-center red h-100">
                <h2><?php echo $this->session->flashdata('token_tidak_ditemukan'); ?></h2>
            </div>
            <?php endif;?>
            <?php if($this->session->flashdata('akun_tidak_ditemukan')): ?>
            <div class="w-100 d-flex justify-content-center align-items-center text-center red h-100">
                <h2><?php echo $this->session->flashdata('akun_tidak_ditemukan'); ?></h2>
            </div>
            <?php endif;?>
            <?php if($this->session->flashdata('sudah_aktivasi')): ?>
            <div class="w-100 d-flex justify-content-center align-items-center text-center red h-100">
                <h2><?php echo $this->session->flashdata('sudah_aktivasi'); ?></h2>
            </div>
            <?php endif;?>
        </div>
    </div>


    <script src="<?=base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?=base_url();?>assets/js/bootstrap.bundle.min.js"></script>

</body>

</html>