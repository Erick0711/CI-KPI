<?= $this->extend('rrhh/main'); ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>"> <?= $this->endSection() ?>
<?= $this->section('css') ?>
<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap/bootstrap.css') ?>"> <?= $this->endSection() ?>
<?= $this->section('title') ?>RRHH<?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container w-100 vh-100 position-relative d-flex justify-content-center align-items-center">
    <div class="row w-75 p-2 border border-info-subtle rounded">
        <div class="col-md-12">
            <form action="<?= base_url('kpi/rrhh/obtener-valores') ?>" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-12">
                        <label for="" class="form-label text-white text-center"><h3><strong>Dato:</strong></h3></label>
                        <?php if (session('menssage')) {?><?= session('menssage'); } ?>
                        <textarea name="dato" id="dato" rows="15" class="form-control text-tarea" required></textarea>
                    </div>
                    <div class="col-md-12">
                        <input type="submit" value="Enviar" class="btn btn-primary btn-block w-100 text-center mt-3">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="http://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="http://threejs.org/examples/js/libs/stats.min.js"></script>
<?= $this->EndSection() ?>