<?= $this->extend('rrhh/main'); ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.css') ?>"> <?= $this->endSection() ?>
<?= $this->section('title') ?>RRHH<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container w-100 vh-100 position-relative d-flex justify-content-center align-items-center">
    <div class="row w-100 p-2 rounded">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="<?= base_url('/login')?>" class="p-5 border border-2 rounded rgba-opacity" method="POST" autocomplete="off">
            <h1 class="text-center text-white">Login</h1>
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label text-white text-center"><strong>Usuario:</strong></label>
                        <input type="text" class="form-control" name="user" required>
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label text-white text-center"><strong>Contraseña:</strong></label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Enviar" class="btn btn-primary btn-block w-100 text-center mt-3">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</div>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
<?= $this->EndSection() ?>