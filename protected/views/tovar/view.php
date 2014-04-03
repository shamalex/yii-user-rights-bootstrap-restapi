<?php
/* @var $this TovarController */
/* @var $model Tovar */

$this->breadcrumbs=array(
	'Tovars'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список товаров', 'url'=>array('index')),
	array('label'=>'Создать товар', 'url'=>array('create')),
	array('label'=>'Обновить товар', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Удалить товар', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Редактирование', 'url'=>array('admin')),
);
?>

<h1>Просмотр #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'price',
	),
)); ?>
