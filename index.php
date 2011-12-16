<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportsman's Paradise | Home</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
<!--  STEP ONE: insert path to SWFObject JavaScript -->
<script type="text/javascript" src="js/swfobject/swfobject.js"></script>

<!--  STEP TWO: configure SWFObject JavaScript and embed CU3ER slider -->
<script type="text/javascript">
		var flashvars = {};
		flashvars.xml = "config.xml";
		flashvars.font = "font.swf";
		var attributes = {};
		attributes.wmode = "transparent";
		attributes.id = "slider";
		swfobject.embedSWF("cu3er.swf", "cu3er-container", "800", "360", "9", "expressInstall.swf", flashvars, attributes);
</script>
</head>
<body>
<div id="head">
 <div id="head_cen">
  <div id="head_sup" class="head_height">
  <img src="images/bannerBg.png" alt="" class="ban_bg" />
<?php include ('includes/loginpage.php');?>
    <h1 class="logo"><a href="index.php"></a></h1>
    <ul>
     <li><a class="active" href="index.php">Home</a></li>
     <li><a href="about.php">About</a></li>
     <li><a href="products.php">Products</a></li>
     <li><a href="contact.php">Contact</a></li>
   </ul>
	<div id="cu3er-container">
    <a href="http://www.adobe.com/go/getflashplayer">
		<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" />
    </a>
   </div>
  </div>
 </div>
</div>
<div id="content">
 <div id="content_cen">
  <div id="content_sup">
   <div id="ct_pan">
    <p>Check out our many products and apparel.</p>
     <ul>
       <li><a href="items.php?cat=basketball">Basketball </a></li>
       <li><a href="items.php?cat=soccer">Soccer</a></li>
       <li><a href="items.php?cat=hockey">Hockey</a></li>
     </ul>
     <ul>
       <li><a href="items.php?cat=football">Football</a></li>
       <li><a href="items.php?cat=golf">Golf</a></li>
       <li><a href="items.php?cat=baseball">Baseball</a></li>
     </ul>
     <a href="www.twitter.com" class="tweet"></a>
   </div> 
  </div>
 </div>
</div>
<?php include('includes/footer.html');?>
</body>
</html>
