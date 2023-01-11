<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('assets/css/particles.css') ?>">
    <link rel="icon" href="<?= base_url('assets/img/kpi.png') ?>">
    <?=$this->renderSection('css')?>
    <title>KPI - <?= $this->renderSection('title') ?></title>
</head>
<body class="body">
    <div id="particles-js"></div>
    <?= $this->include('rrhh/templates/header');?>

    <?= $this->renderSection('content');?>

    <?= $this->include('rrhh/templates/footer');?>

    <script src="<?= base_url('assets/js/particles.js') ?>"></script>
</body>
</html>