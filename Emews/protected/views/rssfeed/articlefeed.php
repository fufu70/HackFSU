<?php
	$sql = "SELECT * FROM user_emotion WHERE url = '".$feed_html."' AND token = 'hey'";
	$connection=Yii::app()->db;
	$command=$connection->createCommand($sql);
	$info = $command->queryAll();
?>

<div> 
    <object type="text/html" data="<?php echo $feed_html;?>" width="750px" height="600px" style="margin-left:-30px;overflow:auto;">
  	</object>
</div>

<script>
if(<?php if(sizeof($info) != 0) echo 1; else echo 0; ?>)
{
	document.body.style.backgroundColor="#<?php if(sizeof($info) != 0)
												{
												if($info[0]['mood'] == 0){ echo '4eab5e';}
												else if($info[0]['mood'] == 1){ echo 'EB9316';} 
												else if($info[0]['mood'] == 2){ echo 'e95b4d';}}?>";	
}
</script>