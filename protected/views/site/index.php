<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Добро пожаловать <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<p>создана регистрация пользователя:
 <li>возможность загружать фотографию (только png формат); 
 <li>почта (проверка на валидность) -пароль (от 6-16 [a-Z0-9] ) 
 <li>имя
 <li>логин
<p>после удачного логина пользователь попадает на список товаров
 <li>товар имеет 2 поля:
 <li>имя 
 <li>цена
<p>пользователь может создать товар и удалить;
<p>список товара постранично;

<p>REST API:
<li>на получение всех пользователей, и получение одного пользователя. 
<li>на получение всех товаров, и получение одного товара

<p>Автор: Александр Шамшин</p>

<p>Зарегистрируйтесь или войдите, чтобы увидеть список товаров</p>
<h4>Пример реализации REST API</h4>
<a style="margin: 50px;" href="http://cat.loc/api/tovars/10">REST API на 1 товар</a>
        <br />
     	<a style="margin: 50px;" href="http://cat.loc/api/tovars">REST API на все товары</a>
        <br />
     <a style="margin: 50px;" href="http://cat.loc/api/users/1">REST API на одного пользователя</a>
        <br />
        <a style="margin: 50px;" href="http://cat.loc/api/users">REST API на всех пользователей</a>
        <br /><br />
