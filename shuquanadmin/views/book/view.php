<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Book */

$this->title = $model->bookname;
$this->params['breadcrumbs'][] = ['label' => '书籍管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('修改', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => '确定要修改其为不显示?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'bookname',
            'author',
            'publishing',
            'publictime',
            'printtime',
            'printrun',
            'binding',
            'edition',
            'booksize',
            'pagenumber',
            'wordnumber',
            'isbn',
            'info:ntext',
            'price',
            'deposit',
            'oldprice',
			 [                      // the owner name of the model
				'attribute' => 'schoolid',
				'value' => $model->school->name,
			],
		   [
				'attribute' => 'isshow',  
				'value' => $model->isshow==1?'显示':'不显示',
			],
            'number',
			[
				'attribute'=>'图片',
				'format' => 'raw',
				'value'=>'<img src =http://shuquan.53.haitou.cc/img' . $model->bookimg->localurl . ' height="200" width="200"' .   '>',

			],
        ],
    ]) ?>

</div>
