<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?=$this->renderSection('css')?>
    <title><?= $this->renderSection('title') ?></title>
</head>
<body>
    <?= $this->include('rrhh/templates/header');?>

    <?= $this->renderSection('content');?>

    <?= $this->include('rrhh/templates/footer');?>
</body>
</html>