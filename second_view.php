<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>OK</title>
		<link rel='shortcut icon' href='http://localhost/ajax/images/favicon.png' type='image/x-icon'/ >
		<link rel="stylesheet" href="http://localhost/ajax/style/style.css" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	</head>
	<body>
	
		<div class = "container">
			<div class = "user">
				<p><?php echo $us;?></p>
				<img src = "http://localhost/ajax/images/icon.png" height = "50px">
				<div class = "online"></div>
				<script>
					function light(){ 
					document.getElementsByClassName('online')[0].style.backgroundColor="#FF6E03"; 
					};
					function off(){
						document.getElementsByClassName('online')[0].style.backgroundColor="#FFFFFF";
					}
					setInterval(light,500);
					setInterval(off, 550);
				</script>
				<form action = "<?php echo base_url('users/log_out')?>" method = "POST">
					<input type = "submit" value = "Log out">
				</form>	
			</div>
			<div class = "page">
				<input type = "submit" value = "add new user" onclick = add(); class = "new_user">
				<div class = "add">
					<div class = "users">
						<h3><?php 
						for($i=0;$i<count($users);$i++){
							echo "<div class = 'name'>".$users[$i]['surname']." ". $users[$i]['name']."</div>";
							echo "<div class = 'edit'>";
							echo"<input type = 'submit' value = 'Edit' name = 'edit'  onclick ='change(".$users[$i]['id'].")' >";
							echo"<input type = 'submit' value = 'Delete' name = 'delete' onclick ='del(".$users[$i]['id'].")'>";
							echo "<input type = 'hidden' value = '".$users[$i]['surname']."' name = 'surname1'>";
							echo "<input type = 'hidden' value = '".$users[$i]['name']."' name = 'name1'>";
							echo "<input type = 'hidden' value = '".$users[$i]['login']."' name = 'login1'>";
							echo "<input type = 'hidden' value = '".$users[$i]['password']."' name = 'password1'>";
							echo "<input type = 'hidden' value = '".$users[$i]['id']."' name = 'id1'>";
							echo "</div>";
						}
						?>
						</h3>
						<?php echo $this->pagination->create_links();?>
						<script>
							function change(id){
							document.getElementsByClassName('data')[0].style.display = "block";
							var n = document.getElementsByName('name1')[id-1].value;
							document.getElementsByName('name')[0].value = n;
							var s = document.getElementsByName('surname1')[id-1].value;
							 document.getElementsByName('surname')[0].value = s;
							var l = document.getElementsByName('login1')[id-1].value;
							document.getElementsByName('login')[0].value = l;
							var p = document.getElementsByName('password1')[id-1].value;
							document.getElementsByName('password')[0].value = p;
							var i = document.getElementsByName('id1')[id-1].value;
							document.getElementsByName('id')[0].value = i;
									}
									function save(){
							var name = document.getElementsByName('name')[0].value;
							var surname = document.getElementsByName('surname')[0].value;
							var login = document.getElementsByName('login')[0].value;
							var password = document.getElementsByName('password')[0].value;
							var id = document.getElementsByName('id')[0].value;
							
							 $.ajax({
								 type: 'POST',
							 url: "<?php echo base_url('users/change')?>",
								 datatype:'json',
								data:{name:name,surname:surname,login:login,password:password,id:id },
							success:function(msg){
								document.getElementsByClassName('data')[0].style.display = "none";
								window.location;
							}
							}); 
				        }
						function del(id){
							console.log(id);
							$.ajax({
								 type: 'POST',
							 url: "<?php echo base_url('users/del')?>",
								 datatype:'json',
								data:{id:id },
							success:function(msg){
								console.log('end');
							}
							}); 
						}
						function add(){
							document.getElementsByClassName('data')[0].style.display = "block";
						}
							
 						</script>
					</div>
				</div>
				<div class = "data">
					<h3>Name</h3>
					<input type = "text" name = "name">
					<h3>Surname</h3>
					<input type = "text" name = "surname">
					<h3>Login</h3>
					<input type = "text" name = "login">
					<h3>Password</h3>
					<input type = "password" name = "password">
					<input type = "hidden" name = "id">
					<input type = "submit" value = "save" class = "save" onclick = save();>
				</div>
			</div>
			
		</div>
	</body>
</html>
