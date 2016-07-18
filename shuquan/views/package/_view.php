<?php
use yii\helpers\Html;

?>
					
						<tr style="background-color:;">  
						<td ><input class="check-one check" type="checkbox" name="packageid[]" value=<?= $model->id;?> onclick="change();"/> </td>  
						<td class="goods">
						<div class="row">
							<div class="col-md-3" style="margin-left:-35px;">
								<a href="#"><img src="<?php echo Yii::getAlias('@web'); ?>/img<?= $model->book->bookimg['localurl'];?>" style="width:90px;height:120px;" alt=""></a>
							</div>
							<div class="col-md-9">
								<h4><strong><?= $model->book['bookname'];?></strong></h4>
								<div class="blog-post-metadata">
									<div class="book">作&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp者：<strong><?= $model->book['author'];?></strong></div>
									<div class="book">出&nbsp&nbsp&nbsp&nbsp版社：<strong><?= $model->book['publishing'];?></strong></div>
									<div class="book">IS&nbsp&nbsp&nbsp&nbsp&nbsp&nbspBN：<strong><?= $model->book['isbn'];?></strong></div>
								</div>
							</div>
						</div>
						</td>  
						<td class="number small-bold-red"><?= $model->book['deposit'];?></td>  
						<td class="subtotal number small-bold-red"><?= $model->book['price'];?></td>  
						<td class="subtotal number small-bold-red"><?= $model->book['price']+$model->book['deposit'];?></td>  
						<td class="subtotal number small-bold-red"><?= $model->book['number'];?></td>  
						<td class="operation"><?= Html::a("删除",['package/delete', 'id' => $model->id],['class' => 'delete btn btn-xs btn-primary']); ?></td>  
					</tr>  

