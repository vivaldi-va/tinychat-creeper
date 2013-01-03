<?php 
if(isset($_GET['room']))
{
	$roomName = $_GET['room'];
	$application->setRoom($roomName);

}
?>
<div class="row-fluid">
	<section class="span10 user-cams">
		<header>
			<h2>user cams:</h2>
		</header>
		<?php 
		global $application;
		$roomInfoArray = $application->getRoomInfo();
		$userCount = $roomInfoArray['@attributes']['total_count'];
		$modCount = $roomInfoArray['@attributes']['mod_count'];
		$camCount = $roomInfoArray['@attributes']['broadcaster_count'];
		if(count($roomInfoArray['pic']) > 0)
		{
			asort($roomInfoArray['pic']);
			foreach($roomInfoArray['pic'] AS $key => $value)
			{
				?>
		<?php if(!empty($value)){?>
		<article class="user-box">
			<div class="avatar">
				<img src="<?php echo $value;?>">
			</div>

			<span class="name"><?php echo $roomInfoArray['names'][$key];?> </span>
		</article>
		<?php }?>
		<?php
			}
		}
		?>
	</section>

	<section class="span2 user-list">
		<header>
			<h2>user list</h2>
			<p>
				users:
				<?php echo $userCount?>
			</p>
			<p>
				moderators:
				<?php echo $modCount?>
			</p>
			<p>
				cams:
				<?php echo $camCount?>
			</p>
			<hr>
		</header>
		<?php 
		if($roomInfoArray['@attributes']['total_count'] > 1)
		{
			asort($roomInfoArray['names']);
			foreach($roomInfoArray['names'] AS $key => $value)
			{
				?>
		<article class="user">
			<span class="name"><?php echo $value; ?> </span>
		</article>
		<?php
			}
		}
		else
		{
			?>
		<article class="user">
			<span class="name"><?php echo $roomInfoArray['names']; ?> </span>
		</article>
		<?php
		}
		?>

	</section>

</div>
<section class="info">
	<header>
		<h2>room info dump:</h2>
	</header>
	<?php 
	ob_start();
	var_dump($roomInfoArray);
	$roomInfoDump = ob_get_clean();
	?>
	<h3>
		<?php echo $roomName;?>
	</h3>
	<p>
		Info in room array: <br>
		<?php echo $roomInfoDump;?>
	</p>
</section>
