<?php 
// require_once "database_config_file.php";

function navigation() {
$user_id= $_SESSION['user_id'];
echo<<<DELIMITER
	<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#danikaNav">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
				
				<div class="collapse navbar-collapse" id="danikaNav">
					<ul class="nav navbar-nav">
						<li class="#"><a href="../../index.php">
								<span class="glyphicon glyphicon-home" aria-hidden="true"></span> HOME
							</a>
						</li>
						<li><a href="../view_products/view_products.php">
							<span class="glyphicon glyphicon-tags" aria-hidden="true"></span> STORE
							</a>
						</li>
						<li><a href="../oceanResPage/oceanres.php">
							<span class="glyphicon glyphicon-knight" aria-hidden="true"></span> ABOUT
							</a>
						</li>						
          				<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">ACCOUNT<span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="showuser.php?user_id={$_SESSION['user_id']}">MY PROFILE</a></li>
									<li><a href="../the_ocean_floor/purchase_history/purchase_history.php">PURCHASE HISTORY</a></li>
									<li><a href="../the_ocean_floor/purchase_history/refund/user_returns_table.php">RETURNS</a></li>
									<li><a href="../edit_profile_pic/update_image.php?user_id={$user_id}">EDIT PICTURE</a></li>
									<li><a href="../edit_profile/update_form.php?user_id={$user_id}">EDIT SHIPPING</a></li>
									<li><a href="../change_password/change_password.php">CHANGE PASSWORD</a></li>
								</ul>
						</li>
						<li class="#"><a href="../index_signout/signout.php" id="logout">
							<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> SIGNOUT
							</a>
						</li>
					</ul>
				</div>
		</div>
	</div>
</nav>
DELIMITER;
}
?>