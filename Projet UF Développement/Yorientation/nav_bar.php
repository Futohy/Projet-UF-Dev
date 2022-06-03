			<nav style="height: 80px;" class = "navbar navbar-header navbar-light bg-light">
			<div style="border-radius:10px/10px;background-color:darkturquoise; padding-left:30px;padding-right:30px;width:110%" class = "container-fluid">
					<div class = "navbar-header">
						<img src="image/Y•Form2.png" alt="" width="auto" height="55px" style="margin-right:auto; margin-left:auto; display:block;">
				</div>
				<div class = "nav navbar-nav navbar-right">
					<a style="color: white;" href="logout.php" class="text-dark"><?php echo $name ?> <i class="fa fa-power-off"></i></a>
				</div>
			</div>
		</nav>
		<div style="font-family:Trebuchet MS" id="sidebar" class="bg-light">
			<div style="margin:10px;margin-top:0px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="home.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-home"> </i></div>  Home
				</a>
			</div>
			<?php if($_SESSION['login_user_type'] != 3): ?>
			<?php if($_SESSION['login_user_type'] == 1): ?>
			<div style="margin:10px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="faculty.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-users"> </i></div>  Teacher List
				</a>
			</div>
			<?php endif; ?>
			<div style="margin:10px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="student.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-users"> </i></div>  Student List
				</a>
			</div>
			<div style="margin:10px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="quiz.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-list"> </i></div>  Form List
				</a>
			</div>
			<div style="margin:10px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="history.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-history"> </i></div>  Form Records
				</a>
			</div>
			<?php else: ?>
			<div style="margin:10px" id="sidebar-field">
				<a style="background-color:darkturquoise;border-bottom:1px solid white;border-radius:10px/10px" href="student_quiz_list.php" class="sidebar-item text-dark">
						<div class="sidebar-icon"><i class="fa fa-list"> </i></div>  Form List
				</a>
			</div>
			<?php endif; ?>

		</div>
		<script>
			$(document).ready(function(){
				var loc = window.location.href;
				loc.split('{/}')
				$('#sidebar a').each(function(){
				// console.log(loc.substr(loc.lastIndexOf("/") + 1),$(this).attr('href'))
					if($(this).attr('href') == loc.substr(loc.lastIndexOf("/") + 1)){
						$(this).addClass('active')
					}
				})
			})
			
		</script>