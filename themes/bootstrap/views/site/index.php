<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<?php $this->beginWidget('bootstrap.widgets.TbHeroUnit',array(
    'heading'=>'Добро пожаловать на '.CHtml::encode(Yii::app()->name),
)); ?>

<p>Автор: Александр Шамшин</p>

<?php $this->endWidget(); ?>

<p>Зарегистрируйтесь или войдите, чтобы увидеть список товаров</p>
<h2>Пример реализации REST API</h2>
<a style="margin: 50px;" href="http://cat.loc/api/tovars/10">REST API на 1 товар</a>
        <br />
     	<a style="margin: 50px;" href="http://cat.loc/api/tovars">REST API на все товары</a>
        <br />
     <a style="margin: 50px;" href="http://cat.loc/api/users/1">REST API на одного пользователя</a>
        <br />
        <a style="margin: 50px;" href="http://cat.loc/api/users">REST API на всех пользователей</a>
        <br /><br />


