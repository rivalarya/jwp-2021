<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Aktivasi</title>
	<link rel="stylesheet" href="<?=base_url();?>assets/css/bootstrap.min.css">
</head>
<body>
    <?php if($this->session->flashdata('berhasil_aktivasi')): ?>
            <div class="w-100 alert alert-success text-center" role="alert">  
                <?php echo $this->session->flashdata('berhasil_aktivasi'); ?>
            </div>
    <?php endif;?>
    <?php if($this->session->flashdata('email_tidak_ditemukan')): ?>
            <div class="w-100 alert alert-danger text-center" role="alert">  
                <?php echo $this->session->flashdata('email_tidak_ditemukan'); ?>
            </div>
    <?php endif;?>
    <?php if($this->session->flashdata('token_tidak_ditemukan')): ?>
            <div class="w-100 alert alert-danger text-center" role="alert">  
                <?php echo $this->session->flashdata('token_tidak_ditemukan'); ?>
            </div>
    <?php endif;?>
    <?php if($this->session->flashdata('akun_tidak_ditemukan')): ?>
            <div class="w-100 alert alert-danger text-center" role="alert">  
                <?php echo $this->session->flashdata('akun_tidak_ditemukan'); ?>
            </div>
    <?php endif;?>
    <?php if($this->session->flashdata('sudah_aktivasi')): ?>
            <div class="w-100 alert alert-danger text-center" role="alert">  
                <?php echo $this->session->flashdata('sudah_aktivasi'); ?>
            </div>
    <?php endif;?>

<script src="<?=base_url();?>assets/js/jquery.min.js"></script>
<script src="<?=base_url();?>assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>