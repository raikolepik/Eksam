<?php
    require_once("functions.php");
    
    //kui kasutaja on sisse logitud, suuna teisele lehele
    //kontrollin kas sessiooni muutuja olemas
    if(isset($_SESSION['logged_in_user_id'])){
        header("Location: data.php");
    }
  // muuutujad errorite jaoks
	$email_error = "";
	$password_error = "";
	$create_email_error = "";
	$create_password_error = "";
  // muutujad väärtuste jaoks
	$email = "";
	$password = "";
	$create_email = "";
	$create_password = "";
	if($_SERVER["REQUEST_METHOD"] == "POST") {
    // *********************
    // **** LOGI SISSE *****
    // *********************
		if(isset($_POST["login"])){
			if ( empty($_POST["email"]) ) {
				$email_error = "See väli on kohustuslik";
			}else{
        // puhastame muutuja võimalikest üleliigsetest sümbolitest
				$email = cleanInput($_POST["email"]);
			}
			if ( empty($_POST["password"]) ) {
				$password_error = "See väli on kohustuslik";
			}else{
				$password = cleanInput($_POST["password"]);
			}
      // Kui oleme siia jõudnud, võime kasutaja sisse logida
			if($password_error == "" && $email_error == ""){
				echo "Võib sisse logida! Kasutajanimi on ".$email." ja parool on ".$password;
			
                $hash = hash("sha512", $password);
                
                loginUser($email, $hash);
            
            }
		} // login if end
    // *********************
    // ** LOO KASUTAJA *****
    // *********************
    if(isset($_POST["create"])){
			if ( empty($_POST["create_email"]) ) {
				$create_email_error = "See väli on kohustuslik";
			}else{
				$create_email = cleanInput($_POST["create_email"]);
			}
			if ( empty($_POST["create_password"]) ) {
				$create_password_error = "See väli on kohustuslik";
			} else {
				if(strlen($_POST["create_password"]) < 8) {
					$create_password_error = "Peab olema vähemalt 8 tähemärki pikk!";
				}else{
					$create_password = cleanInput($_POST["create_password"]);
				}
			}
			if(	$create_email_error == "" && $create_password_error == ""){
				//echo hash("sha512", $create_password);
                //echo "Võib kasutajat luua! Kasutajanimi on ".$create_email." ja parool on ".$create_password;
                
                // tekitan parooliräsi
                $hash = hash("sha512", $create_password);
                
                //functions.php's funktsioon
                createUser($create_email, $hash);
                
                
            }
        } // create if end
	}
  // funktsioon, mis eemaldab kõikvõimaliku üleliigse tekstist
  function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
?>
<?php
	$page_title = "Logi sisse";
	$page_file_name = "login.php";

?>
	<?php require_once("header.php"); ?>
		<h4>See veebileht on loodud selleks, et tellida endale omapärased prillid, mis sobiksid vastavalt inimese peakujuga ja oleksid sobiva hinnaga.</h4>
		<h4>Lähemalt tutvimiseks minge sellele leheküljele : http://evoklaas.blogspot.com.ee/ </h4>
		<h4>Facebookist leiate meid leheküljelt : https://www.facebook.com/EVOGlasses?fref=ts </h4>
		
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
				<input name="email" type="email" placeholder="Email" value="<?php echo $email; ?>">* <?php echo $email_error; ?> <br> <br> 
				<input name="password" type="password" placeholder="Password">* <?php echo $password_error; ?>	<br> <br>	
				<input name="login" type="submit" value="log in">
				</form>
				<h2>Tee kasutaja</h2>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				
				
				<input name="test" type="text" placeholder="vanus">* <br> <br>
				<input name="id_number" type="text" placeholder="Email">*  <br><br>
				<input name="test" type="text" placeholder="parool">* <br> <br>
			Sugu:
			<input type="radio" name="Sugu"
			<?php if (isset($Sugu) && $Sugu=="naine") echo "checked";?>
			value="Naine">Naine
			<input type="radio" name="Sugu"
			<?php if (isset($Sugu) && $Sugu=="mees") echo "checked";?>
			value="Mees">Mees	<br> <br>
		
		<input name="sign_up" type="submit" value="sign up">	
			</form>
	<?php require_once("footer.php"); ?>