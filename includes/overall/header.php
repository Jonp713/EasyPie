<!doctype html>
<html>
<head>

	<title><?php if(!empty($service_in)){echo($service_in);}else{echo('ICU');} ?> <?php if(!empty($community_in)){echo($community_in);}else{echo('Hampy');}  ?></title>
	
	<?php if(isset($_GET['share'])){
		
  		$id = $_GET['share'];
		
		$id = sanitize($id);
	  
	  $data = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE id = '$id' LIMIT 1"));
	  
	  $post = $data['post'];

		echo('<meta name="description" content="'.$post.'">');


		}else{ 
	
		
		?>
		
		<meta name="description" content="Find your secret admirer">
	
	 <?php }?>
	<meta charset="UTF-8">
	 
	<meta name="keywords" content="<?php if(!empty($community_in)){echo($community_in.',');} ?> <?php if(!empty($service_in)){echo($service_in.',');} ?>, college, community, life, tickling, personals, missed connections, compliments, icuhampy">	
	
	<link href="css/bootstrap.css" rel="stylesheet">
	<link href="css/reset.css" rel="stylesheet">
	
	
	<link href="css/screen3.1.css" rel="stylesheet">
	
	<?php if(!empty($service_in)){	$url =  get_logo_picture_url_from_service_name($service_in); }else{  $url = "https://icu.university/images/logonotext.png"; } ?>
	
	<link rel="shortcut icon" type="image/png" href="<?php echo($url); ?>"/>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<![endif]-->
</head>



<body>
	
	
<header>
	
		
<link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300italic,400italic,600,200,200italic,300,600italic,700,700italic,900' rel='stylesheet' type='text/css'>
		<script src="js/moments.js"></script>

		<script>
		    moment().format();
			
			
		</script>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=530304877091308&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="clear"></div>
		
		<div id = "topalert" class="topalert col-xs-12 col-sm-6 col-sm-offset-3"></div>
		
		
		<?php
		/*
		
		
		$iPod    = stripos($_SERVER['HTTP_USER_AGENT'],"iPod");
		$iPhone  = stripos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$iPad    = stripos($_SERVER['HTTP_USER_AGENT'],"iPad");
		$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
		$webOS   = stripos($_SERVER['HTTP_USER_AGENT'],"webOS");
		
		if($Android) {
		
			echo('<div id = "topbanner"><a href = "https://play.google.com/store/apps/details?id=com.snapchat.android">Download our app! Click here</a></div>');
			
		}elseif($iPod || $iPhone || $iPad){
		
			echo('<div id = "topbanner"><a href = "http://itunes.com/apps/snapchat">Download our app! Click here</a></div>');
			
		}else{
			
		
			echo('<div id = "topbanner">Download our app on your Android or iOS phone!</div>');
		
		}
		*/
		
				
		?>
		
		
</header>
<span class = "background"></span>

<div id = "wrapper">

	<?php include 'sidebar.php'; ?>	
	
	<?php include 'navbar.php'; ?>	
	

<div id = "page-content-wrapper">
	<?php include 'includes/widgets/modals.php'; ?>
	
	
<div class="container-fluid" >
	
	
	
