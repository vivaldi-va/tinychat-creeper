<?php 
	include_once 'controls/session.php';
	include_once 'controls/application.php';
	
	if(isset($_GET['room']))
	{
		$roomName = $_GET['room'];
		$application->setRoom($roomName);
		
	}
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  <title></title>
  <meta name="description" content="">
  <meta name="author" content="">

  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- CSS concatenated and minified via ant build script-->
  <link rel="stylesheet" href="./style.css">
  <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,400italic' rel='stylesheet' type='text/css'>
  <!-- end CSS-->

  <script src="./js/libs/modernizr-2.0.6.min.js"></script>
</head>

<body>

	<div class="wrapper">
		<header>
			<hgroup>
				<h1>tiny chat room viewer</h1>
				<h2>by vivaldi</h2>
			</hgroup>
			<?php if($session->loggedIn){?>
				logged in, ip: <?php echo $session->ip;?>
				<form action="./controls/form-processor.php" method="POST">
					<button type="submit">log out</button>
				</form>
				<?php if(isset($_GET['room'])){?>
				<form method="get" class="room-name-form">
					<label> room name: <input type="text" name="room" value="<?php echo $_GET['room']?>" class="input">
					</label>
					<button type="submit">load room</button>
				</form>
				<?php }?>
			<?php }?>
		</header>
			
			<?php if($session->loggedIn){
				global $application;
				$roomInfoArray = $application->getRoomInfo();
				?>
				<?php if(!isset($_GET['room'])){?>
					<div class="row-fluid">
						<form method="get" class="room-name-form start">
							<legend>Select a Room</legend>
							<label> room name: <input type="text" name="room" class="input">
							</label>
							<button type="submit">load room</button>
						</form>
					</div>
				
				<?php }
				elseif(isset($roomInfoArray['@attributes']['message']) && $roomInfoArray['@attributes']['message'] === "resource not found"){?>
				<div class="room-display">
					<div class="row-fluid">
					<article class="user-box">
						<h2>Room not found or is empty.</h2>
					</article>
					</div>
				</div>
				<?php }
				else {?>
				<div class="room-display">
					<div class="row-fluid">
						<section class="span10 user-cams">
							<header>
								<h2>user cams:</h2>
							</header>
							<?php 

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
				</div>
				<?php }?>
			<?php }
			 else{?>
			 	<form action="controls/form-processor.php" method="POST">
			 		<label>
			 			password:
			 			<input type="password" name="pass" class="input">
			 		</label>
			 		<label>
			 			remember me?
			 			<input type="checkbox" name="remember">
			 		</label>
			 		<input type="hidden" name="procLogin" value="1">
			 		<button type="submit" class="btn">access the tool</button>
			 	</form>
			 <?php }?>
			
		</div>
		
		<footer> </footer>
	</div>
	<!--! end of .wrapper -->


	<script
		src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/libs/jquery.min.js"><\/script>')</script>
	
	<?php //<script defer src="js/interaction.js"></script>?>

	<!-- scripts concatenated and minified via ant build script-->
	<script defer src="js/plugins.js"></script>
	<script defer src="js/script.js"></script>
	<!-- end scripts-->
	

	<script> // Change UA-XXXXX-X to be your site's ID
    window._gaq = [['_setAccount','UAXXXXXXXX1'],['_trackPageview'],['_trackPageLoadTime']];
    Modernizr.load({
      load: ('https:' == location.protocol ? '//ssl' : '//www') + '.google-analytics.com/ga.js'
    });
  </script>


	<!--[if lt IE 7 ]>
    <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
    <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
  <![endif]-->

</body>
</html>
