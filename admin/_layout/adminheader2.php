</head>
<body>
<div id="wrap">
<div id="header">
		<div>
			<a href="<?php links("default.php");?>"><h1>CCC DATA MANAGEMENT SERVICES INC.</h1></a>
		</div>	
		<div id="userinfo">
			<img src="<?php links("_userimage/"); echo htmlentities($session->operator_id);?>.jpg" />
			<span class="logininfo"><?php echo htmlentities($session->operator_id); ?></span><br>
			<span class="logininfo"><?php echo htmlentities($session->name); ?></span><br>
			<span class="logininfo"><?php echo date('F j, Y')." "; ?></span>
			<span class="logininfo"><a href="<?php logout_user();?>">Logout</a></span>
		</div>
</div> <!-- end of header -->
<nav>
    <ul>
        <li><a id="home" href="<?php links("default.php");?>"><img src="<?php links("_images/home.png");?>"/>Home</a></li>
        <li><a id="download" href="<?php links("downloads/default.php?status=OPEN&state=&pubname=&pubdate=");?>"><img src="<?php links("_images/download.png");?>"/>Download</a></li>
        <li><a id="reports" href="<?php links("reports.php");?>"><img src="<?php links("_images/reports.png");?>"/>Reports</a></li>
        <li><a id="exports" href="<?php links("exports.php");?>"><img src="<?php links("_images/exports.png");?>"/>Exports</a></li>
		<?php if($session->access_level == 9){;?>
			<li><a id="setup" href="<?php links("setup.php");?>"><img src="<?php links("_images/setup.png");?>"/>Setup</a></li>
			<li><a id="utilities" href="<?php links("utilities.php");?>"><img src="<?php links("_images/utilities.png");?>"/>Utilities</a></li>
		<?php }?>
        <li><a id="contact" href="<?php links("contact.php");?>"><img src="<?php links("_images/contact.png");?>"/>Contact</a></li>
    </ul>
</nav>