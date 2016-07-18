<?php
use yii\helpers\Html;

?>
						<div class="photo app pull-left" style="margin-left:6px;margin-bottom:6px;">
							<div class="pull-left" >
								<a href="#"><img src="<?php echo Yii::getAlias('@web'); ?>/img<?= $model->book->bookimg['localurl'];?>" style="width:90px;height:120px;" alt=""></a>
							</div>
							<div class="pull-left" style="margin-left:6px;width:150px;overflow:hidden;">
								<strong style="font-size:8px;"><?= $model->book['bookname'];?></strong>
								<div class="blog-post-metadata">
									<div>作&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp者：<strong><?= $model->book['author'];?></strong></div>
									<div>出&nbsp&nbsp&nbsp&nbsp版社：<strong><?= $model->book['publishing'];?></strong></div>
									<div>IS&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBN：<strong><?= $model->book['isbn'];?></strong></div>
								</div>
							</div>
						</div>

