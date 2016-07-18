<?php
use yii\helpers\Html;

?>
						<tr style="background-color:;">  
						<td ><input class="check-one check" type="checkbox" /> </td>  
						<td class="goods">
						<div class="row">
							<div class="col-md-3" style="margin-left:-35px;">
								<a href="#"><img src="<?php echo Yii::getAlias('@web'); ?>img<?= $model->book->bookimg['localurl'];?>" style="width:90px;height:120px;" alt=""></a>
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
						<td></td>  
						<td class="number small-bold-red"><span><?php $time = $model['time']; echo ($model['resdeposit']-(floor((time()-$time)/24/3600)>365?floor((time()-$time)/24/3600)-365:0)*0.01)>0?($model['resdeposit']-(floor((time()-$time)/24/3600)>365?floor((time()-$time)/24/3600)-365:0)*0.01):0; ?></span></td> 
						<td class="subtotal number small-bold-red" style="font-size:12px;"><?php $time = $model['time'];$endtime = $time+365*24*3600;echo date('Y-m-d h:i:s',$endtime);?></br>还剩<strong class="text-danger"><?php $time = $model['time']; echo $day = (365-floor((time()-$time)/24/3600))>0?(365-floor((time()-$time)/24/3600)):0; ?></strong>天</td>  
						<td class="operation"><?= Html::a("我要还书",['package/back', 'id' => $model->id],['class' => 'delete btn btn-xs btn-primary']); ?></td>  
					</tr>  

