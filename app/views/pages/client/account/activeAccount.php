<section class="active-account-area">
    <div class="container text-center ">
        <div class="active-account-main">
            <span class="icon <?php echo $dataRegister['icon'] == 'times' ? 'danger' : '' ?>"><i class="fas fa-<?php echo $dataRegister['icon'] ?>"></i></span>
            <h1><?php echo $dataRegister['h1'] ?></h1>
            <h5><?php echo $dataRegister['h5'] ?></h5>
            <a href="login" target="_blank" class="btn btn-custom">Trở lại đăng nhập </a>
        </div>
    </div>
</section>