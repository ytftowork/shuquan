<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312"/>
<title>付款成功</title>
<script type="text/javascript"> 
function countDown(secs,surl){ 
 //alert(surl); 
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs; 
 if(--secs>0){ 
  setTimeout("countDown("+secs+",'"+surl+"')",1000); 
 }
 else
 {  
  location.href=surl; 
 } 
} 
</script>
</head>
<body>
付款成功<span id="jumpTo">5</span>秒后自动跳转到待收书
<script type="text/javascript">
countDown(5,'waitbook');
</script> 
</body>
</html>