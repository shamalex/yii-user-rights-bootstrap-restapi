<?php
/* @var $this TovarController */
/* @var $model Tovar */

$this->breadcrumbs=array(
	'Tovars'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index')),
	array('label'=>'Создать товар', 'url'=>array('create')),
	array('label'=>'Просмотр товаров', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Редактирование', 'url'=>array('admin')),
);
?>

<h1>Обновить товар <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>