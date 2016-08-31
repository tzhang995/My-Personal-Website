<!--NEED PHP HEADER-->
<?php $currentPage = "Blog"; ?>
<!DOCTYPE html>
<html>
	<head>
		<?php include("head.php"); ?>
	</head>

	<body>
		<?php include("header.php");?>
		<!--Body paragraph-->
		<div id="inner" class="container-fluid">
			<p class="text-center">
				This page is more or less just updating myself, create and access my side projects and self learning. Honestly, it is to learn JavaScript and the many, many, many (sigh) libraries that it has. Feel free to roam around.
			</p>
		</div>
		 <div class="list-group container-fluid">
		  <a href="#" class="list-group-item">Algorithms</a>
		  <a href="./nThings.php" class="list-group-item">N Things</a>
		  <a href="#" class="list-group-item">Other Projects</a>
		</div>
	</body>
	<?php include("script.php");?>
</html>