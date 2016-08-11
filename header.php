<header class="header">
	<div class="header-title">
		<h1>
			<a href="./index.php" class="highlight">Tony Zhang</a>
		</h1>
	</div>
	<div class="header-nav">
		<ul class="header-tabs">
			<li id="experiences" class="header-tab
				<?php if($currentPage == "experiences") echo "active"; ?>">
				<a href="./experiences.php" class="highlight">Experiences</a>
			</li>
			<li id="projects" class="header-tab
				<?php if($currentPage == "projects") echo "active"; ?>">
				<a href="./projects.php" class="highlight">Projects</a>
			</li>
			<li id="notes"  class="header-tab
				<?php if($currentPage == "education") echo "active"; ?>">
				<a href="./education.php" class="highlight">Education</a>
			</li>
			<li id="Blog" class="header-tab
				<?php if($currentPage == "Blog") echo "active"; ?>">
				<a href="./blog.php" class="highlight">Blog</a>
		</ul>
	</div>
</header>