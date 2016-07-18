<?php
	//	修改过期订单 恢复库存
	//	作者：司玮辰
	
	include_once('config.php');
// ?>
<?php
		echo $filepath = dirname(dirname(__FILE__))."/shuquan"."/runtime/lock.txt";
		$fp = fopen($filepath, "w+");
		if(flock($fp,LOCK_EX))
		{
			// echo dirname(dirname(__FILE__))."\shuquan\runtime\lock.txt";
			$start = microtime();
			$sql1 = "SELECT `order`.`id` FROM `order` WHERE `order`.`overtime` < unix_timestamp(now()) and `order`.`status` = '1'";
			$result1 = mysqli_query($conn,$sql1);
			// print_r($result);
			while ($row=mysqli_fetch_assoc($result1)) 
			{ 
				// echo $row['id'];
				$sql2 = "select `package`.`bookid` FROM `orderpackage` left join `package` on (`orderpackage`.`packageid` = `package`.`id`)  WHERE `orderpackage`.`orderid` = '".$row['id']."'";
				$result2 = mysqli_query($conn,$sql2);
				while ($row2=mysqli_fetch_assoc($result2)) 
				{
					$sql3 = "select `book`.`id`,`book`.`number` FROM `book` WHERE `book`.`id` = '".$row2['bookid']."'";
					$result3 = mysqli_query($conn,$sql3);
					while ($row3=mysqli_fetch_assoc($result3)) 
					{
						$number = $row3['number']+1;
						$sql4 = "UPDATE `shuquan`.`book` SET `number` = '".$number."' WHERE `book`.`id` = '".$row3['id']."'";
						$result4 = mysqli_query($conn,$sql4);;
					}
					
				}
			}
			$sql =  "UPDATE `shuquan`.`order` SET `order`.`status` = '3' WHERE `order`.`overtime` < unix_timestamp(now()) and `order`.`status` = '1'";
			$result = mysqli_query($conn,$sql);
			$end = microtime();		
			echo $start-$end;
		 flock($fp,LOCK_UN);
		}
		// fclose($fp);
	
	?>