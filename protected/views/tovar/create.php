<?php
/* @var $this TovarController */
/* @var $model Tovar */

$this->breadcrumbs=array(
	'Tovars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index')),
	array('label'=>'Редактирование', 'url'=>array('admin')),
);
?>

<h1>Создать товар</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>