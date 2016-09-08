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
		<div id="inner" class="container-fluid body-desc">
			<p class="text-center">
				Welcome to my blog... Well this isn't actually a blog but actually a collection of random things that I'm doing during my off time. Think of it like "Tony's random things". lol
			</p>
		</div>
		 <div class="list-group container-fluid">
		  <a href="./nThings.php" class="list-group-item">N Things</a>
		  <a href="#" class="list-group-item filler">Algorithms</a>
		  <a href="#" class="list-group-item filler">Other Projects</a>
		</div>
	</body>
	<?php include("script.php");?>
</html>