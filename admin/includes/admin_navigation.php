	<!-- Navigation -->

	<?php
	if (isset($_GET['user'])) {
		$user_id = $_GET['user'];
	}


	?>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="dashboard.php?user=<?php echo $user_id ?>">Admin Panel</a>
		</div>
		<!-- Top Menu Items -->
		<ul class="nav navbar-right top-nav">
			<li><a href="../../index.php?user=<?php echo $user_id ?>">Home</a></li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu message-dropdown">
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<span class="pull-left">
									<img class="media-object" src="http://placehold.co/50x50" alt="" />
								</span>
								<div class="media-body">
									<h5 class="media-heading">
										<strong><?php echo $_SESSION['username'] ?></strong>
									</h5>
									<p class="small text-muted">
										<i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
									</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<span class="pull-left">
									<img class="media-object" src="http://placehold.co/50x50" alt="" />
								</span>
								<div class="media-body">
									<h5 class="media-heading">
										<strong><?php echo $_SESSION['username'] ?></strong>
									</h5>
									<p class="small text-muted">
										<i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
									</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-preview">
						<a href="#">
							<div class="media">
								<span class="pull-left">
									<img class="media-object" src="http://placehold.co/50x50" alt="" />
								</span>
								<div class="media-body">
									<h5 class="media-heading">
										<strong><?php echo $_SESSION['username'] ?></strong>
									</h5>
									<p class="small text-muted">
										<i class="fa fa-clock-o"></i> Yesterday at 4:32 PM
									</p>
									<p>Lorem ipsum dolor sit amet, consectetur...</p>
								</div>
							</div>
						</a>
					</li>
					<li class="message-footer">
						<a href="#">Read All New Messages</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
				<ul class="dropdown-menu alert-dropdown">
					<li>
						<a href="#">Alert Name
							<span class="label label-default">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name
							<span class="label label-primary">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name
							<span class="label label-success">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name
							<span class="label label-info">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name
							<span class="label label-warning">Alert Badge</span></a>
					</li>
					<li>
						<a href="#">Alert Name
							<span class="label label-danger">Alert Badge</span></a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="#">View All</a>
					</li>
				</ul>
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i>
					<?php echo $_SESSION['username'] ?> <b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li>
						<a href="../admin/profile.php?user=<?php echo $user_id; ?>"><i class="fa fa-fw fa-user"></i>
							Profile</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
					</li>
					<li class="divider"></li>
					<li>
						<a href="includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
					</li>
				</ul>
			</li>
		</ul>
		<!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav side-nav">
				<li>
					<a href="dashboard.php?user=<?php echo $user_id ?>"><i class="fa fa-fw fa-dashboard"></i>
						Dashboard</a>
				</li>
				<!-- <li>
	                <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
	            </li>
	            <li>
	                <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
	            </li>
	            <li>
	                <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
	            </li> -->
				<li>
					<a href="javascript:;" data-toggle="collapse" data-target="#posts_dropdown"><i class="fa fa-fw fa-arrows-v"></i>
						Posts
						<i class="fa fa-fw fa-caret-down"></i></a>
					<ul id="posts_dropdown" class="collapse">
						<li>
							<a href="posts.php?user=<?php echo $user_id ?>">View All Posts</a>
						</li>
						<li>
							<a href="posts.php?user=<?php echo $user_id ?>&source=add_post">Add Posts</a>
						</li>
					</ul>
				</li>
				<li>
					<a href="categories.php?user=<?php echo $user_id ?>"><i class="fa fa-fw fa-wrench"></i> Categories</a>
				</li>
				<?php if (isAdmin($_SESSION['username'])) { ?>
					<li>
						<a href="comments.php?user=<?php echo $user_id ?>"><i class="fa fa-fw fa-file"></i> Comments</a>
					</li>
					<li>
						<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i>
							Users
							<i class="fa fa-fw fa-caret-down"></i></a>
						<ul id="demo" class="collapse">
							<li>
								<a href="users.php?user=<?php echo $user_id ?>">View All Users</a>
							</li>
							<li>
								<a href="users.php?user=<?php echo $user_id ?>&source=add_user">Add User</a>
							</li>
						</ul>
					</li>
				<?php } ?>
				<li>
					<a href="../admin/profile.php?user=<?php echo $user_id; ?>"><i class="fa fa-fw fa-dashboard"></i>
						Profile</a>
				</li>
			</ul>
		</div>
		<!-- /.navbar-collapse -->
	</nav>