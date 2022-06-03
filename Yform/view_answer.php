
<!DOCTYPE html>
<html lang="en">
<head>
	</head>
	
	<?php include('header.php') ?>
	<?php include('auth.php') ?>
	<?php include('db_connect.php') ?>
	<?php
	$quiz = $conn->query("SELECT * FROM quiz_list where id =".$_GET['id'])->fetch_array();
	$hist = $conn->query("SELECT * FROM history where quiz_id =".$_GET['id']." and user_id = ".$_SESSION['login_id'])->fetch_array();
	?>
	<title><?php echo $quiz['title'] ?> | Answer Sheet</title>
</head>
<body>
	<style>
		/*li.answer{
			cursor: pointer;
		}
		li.answer:hover{
			background: #00c4ff3d;
		}*/
		li.answer input:checked{
			background: #00c4ff3d;
		}
	</style>
	<?php include('nav_bar.php') ?>
	
	<div style="padding-top:0 ;margin-top:0" class="container-fluid admin">
		<div style="font-size:30px;background-color:darkturquoise" class="col-md-12 alert alert-dark"><?php echo $quiz['title'] ?> | <?php echo $quiz['qpoints'] .' Points Each Question' ?></div>
		<div class="col-md-12 alert alert-success">SCORE : <?php echo $hist['score'] .' / ' .  $hist['total_score'] ?></div>
	    
					
		<br>
		<?php 
		$status = $conn->query("SELECT * from students where user_id ='".$_SESSION['login_id']."' ")->fetch_array();

		$user_quiz_id = $quiz["user_id"];
		$user_quiz_score = $hist['score'];
		$user_dev_mark = $status['dev_mark'];
		$user_dev_appr = $status['dev_appreciation'];
		$user_cs_mark = $status['cs_mark'];
		$user_cs_appr = $status["cs_appreciation"];

		if ($user_quiz_id == 17) {
			if( $user_quiz_score > 4 && $user_dev_mark >= 14 || $user_dev_appr >= 3){
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your Dev mark is: <strong> $user_dev_mark</strong>/20</br>- ― ――― ― -</br>								
																															  ◉ Your number of Appreciations in Dev is: <strong> $user_dev_appr</strong>/5</div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-success'>― ――― ―</br>✧ CONGRATULATION ✧</br>✓ YOU HAVE ALL THE CONDITIONS TO CHOOSE THE DEV SPECIALITY ✓</br>― ――― ―</div>";
			}
			elseif( $user_quiz_score < 4 && $user_dev_mark >= 14 && $user_dev_appr >= 3){
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your Dev mark is: <strong> $user_dev_mark</strong>/20</br>- ― ――― ― -</br>								
																															  ◉ Your number of Appreciations in Dev is: <strong> $user_dev_appr</strong>/5</div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-success'>― ――― ―</br>✧ CONGRATULATION ✧</br>✓ YOU HAVE ALL THE CONDITIONS TO CHOOSE THE DEV SPECIALITY ✓</br>― ――― ―</div>";
			}
			else{
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your Dev mark is: <strong> $user_dev_mark</strong></br>- ― ――― ― -</br>								
																															  ◉ Your number of Appreciations in Dev is: <strong> $user_dev_appr</strong></div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-danger'>― ――― ―</br>⤫ SADLY YOU DONT HAVE ALL THE CONDITIONS FOR THIS SPECIALITY ⤬</br>►► TRY ANOTHER SPECIALITY FORM ◄◄</br>― ――― ―</div>";
		}}
		if ($user_quiz_id == 6) {
			if( $user_quiz_score > 4 && $user_cs_mark >= 14 || $user_cs_appr >= 3){
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your CS mark is: <strong> $user_cs_mark</strong>/20</br>- ― ――― ― -</br>								
																															  ◉ Your number of Appreciations in CS is: <strong> $user_cs_appr</strong>/5</div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-success'>― ――― ―</br>✧ CONGRATULATION ✧</br>✓ YOU HAVE ALL THE CONDITIONS TO CHOOSE THE CS SPECIALITY ✓</br>― ――― ―</div>";
				}
		    elseif( $user_quiz_score < 4 && $user_cs_mark >= 14 && $user_cs_appr >= 3){
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your CS mark is: <strong> $user_cs_mark</strong>/20</br>- ― ――― ― -</br>								
																																  ◉ Your number of Appreciations in CS is: <strong> $user_cs_appr</strong>/5</div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-success'>― ――― ―</br>✧ CONGRATULATION ✧</br>✓ YOU HAVE ALL THE CONDITIONS TO CHOOSE THE CS SPECIALITY ✓</br>― ――― ―</div>";
				}	
			else{
				echo "<div style='text-align: center ;font-size: 22px; margin-bottom: 40px' class='col-md-12 alert alert-secondary'>◉ Your CS mark is: <strong> $user_cs_mark</strong></br>- ― ――― ― -</br>								
																															  ◉ Your number of Appreciations in CS is: <strong> $user_cs_appr</strong></div>";
				echo "<div style='text-align: center ;font-size: 30px; font-weight: bold;' class='col-md-12 alert alert-danger'>― ――― ―</br>⤫ SADLY YOU DONT HAVE ALL THE CONDITIONS FOR THIS SPECIALITY ⤬</br>►► TRY ANOTHER SPECIALITY FORM ◄◄</br>― ――― ―</div>";
		}}
		?>
	</div>
</body>
<script>
	$(document).ready(function(){
		$('input').attr('readonly',true)
		
	})
</script>
</html>