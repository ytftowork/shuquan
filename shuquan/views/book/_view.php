<?php
use yii\helpers\Html;

?>

<!--<div class="sq-home-item">-->
<!--	<div class="sq-home-item-left"></div>-->
<!--	<div class="sq-home-item-right"></div>-->
<!---->
<!--</div>-->

<div class="sq-home-item">
	<div class="sq-home-item-left" >
		<img src="<?php echo Yii::getAlias('@web'); ?>/img<?= $model->bookimg['localurl'];?>">
	</div>
	<div class="sq-home-right" >
		<h4><?= mb_substr(strip_tags($model->bookname),0,30,'utf-8'); ?></h4>
		<div class="sq-home-right-info">
			<div class="book">作&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp者：<strong><?= $model->author;?></strong></div>
			<div class="book">出&nbsp&nbsp&nbsp&nbsp版社：<strong><?= $model->publishing;?></strong></div>
			<div class="book">IS&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBN：<strong><?= $model->isbn;?></strong></div>
			<div class="book">出版时间：<?= $model->publictime;?></div>
			<div class="book">印刷时间：<?= $model->printtime;?></div>
			<div class="book">版&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp次：<?= $model->printrun;?></div>
			租&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp金：<strong class="text-danger" style="font-size:48px;"><?= $model->price;?></strong>元 原书售价：<?= $model->oldprice;?>元</br>

			<?= Html::a("+塞进书包",['package/addbook', 'id' => $model->id],['class' => 'btn btn-danger btn-lg'],['style' => 'margin-top:9px;']); ?>
		</div>
	</div>
</div>

