
<!-- Lien simple -->
<?= html::link('Editer', 'http://www.google.fr'); ?>
<br>
<!-- Lien avec options -->
<?= html::link('Editer', 'www.google.fr', array('title' => 'lien vers google')); ?>
<br>
<!--Lien pour appeler un controller et une vue -->
<?= html::link('Editer', array('controller' => 'Editors', 'view'=>'edit')); ?>
<br>
<!-- Pour transmettre des paramètres -->
<?= html::link('Editer', array('controller' => 'Editors', 'view'=>'edit', 'params'=>33)); ?>