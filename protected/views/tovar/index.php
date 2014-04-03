<?php
/* @var $this TovarController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Tovars',
);

$this->menu=array(
	array('label'=>'Создать товар', 'url'=>array('create')),
	array('label'=>'Редактирование', 'url'=>array('admin')),
);
?>

<h1>Список товаров</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
