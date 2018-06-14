<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <title>
        teste
    </title>
    <?= $this->Html->css('style.css', ['fullBase' => true]) ?>
</head>
<body>
    <div id="container">
        <div id="content">
            <?= $this->fetch('content') ?>
        </div>
    </div>
</body>
</html>