<nav class="navbar navbar-default nnavbar-fixed-top">
	<div class="container">

		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-items">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">DVD Home</a>
		</div><!--/.navbar-header-->

		<div id="nav-items" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li {!!HTML::menuActive('dvds/create')!!}>
					<a href="/dvds/create">
						DVD Insert
					</a>
				</li>
				<li {!!HTML::menuActive('dvds/search')!!}>
					<a href="/dvds/search">
						DVD Search (A7)
					</a>
				</li>
				<li {!!HTML::menuActive('genres/drama/dvds')!!}>
					<a href="/genres/drama/dvds">
						Genre DVDs (Drama)
					</a>
				</li>
			</ul>
		</div><!--/#nav-items-->

	</div><!--/.container-->
</nav>