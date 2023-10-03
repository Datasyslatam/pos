<?php

session_destroy();
//header("Location:login.php");
//die();
echo "<div> 
		window.location = 'vistas/login'; 
		window.location.replace('login'); 
	</div>";