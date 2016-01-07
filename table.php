<?php  
    require_once("functions.php");
    
    // kuulan, kas kasutaja tahab kustutada
    // ?delete=... on aadressireal
    if(isset($_SESSION["logged_in_user_id"])){
		
	
	
	
	
	if(isset($_GET["delete"])) {
        ///saadan kustutatava auto id
        deleteGlassData($_GET["delete"]);
    }
    
    //Kasutaja muudab andmeid
    if(isset($_GET["update"])){
        //auto id, auto number, auto värv
        updateGlassData($_GET["evo_glass_id"], $_GET["nimi"], $_GET["aadress"], $_GET["telefon"], $_GET["elektronpost"]);
    }
    }
    $evo_glass_array = getAllData();
	
	    $keyword = "";
    if(isset($_GET["keyword"])){
        $keyword = $_GET["keyword"];
        
        // otsime 
        $evo_glass_array = getAllData($keyword);
        
        
    }else{
        // näitame kõiki tulemusi
        // kõik autod objektide kujul massiivis
        $evo_glass_array = getAllData();
        
    }
	
	
	
	
	
	
    
    
    // kõik autod objektide kujul massiivis

?>
<?php
	$page_title = "Muuda andmeid";
	$page_file_name = "table.php";

?>

<?php require_once("header.php"); ?>
<form action="table.php" method="get">
    <input name="keyword" type="search" value="<?=$keyword?>" >
    <input type="submit" value="otsi">
<form>

<h1>Tabel</h1>
<table border=1>
<tr>
    <th>nimi</th>
    <th>aadress</th>
    <th>telefon</th>
    <th>elektronpost</th>
    
</tr>
<?php 
    
    // autod ükshaaval läbi käia
    for($i = 0; $i < count($evo_glass_array); $i++){
        
        // kasutaja tahab rida muuta
        if(isset($_GET["edit"]) && $_GET["edit"] == $evo_glass_array[$i]->id){
            echo "<tr>";
            echo "<form action='table.php' method='get'>";
            // input mida välja ei näidata
            echo "<input type='hidden' name='evo_glass_id' value='".$evo_glass_array[$i]->id."'>";
            echo "<td>".$evo_glass_array[$i]->id."</td>";
            echo "<td>".$evo_glass_array[$i]->user_id."</td>";
            echo "<td><input name='nimi' value='".$evo_glass_array[$i]->nimi."' ></td>";
            echo "<td><input name='aadress' value='".$evo_glass_array[$i]->aadress."' ></td>";
			echo "<td><input name='telefon' value='".$evo_glass_array[$i]->telefon."' ></td>";
            echo "<td><input name='elektronpost' value='".$evo_glass_array[$i]->elektronpost."' ></td>";
            echo "<td><input name='update' type='submit'></td>";
            echo "<td><a href='table.php'>cancel</a></td>";
            echo "</form>";
            echo "</tr>";
        }else{
            // lihtne vaade
            echo "<tr>";
            echo "<td>".$evo_glass_array[$i]->id."</td>";
            echo "<td>".$evo_glass_array[$i]->user_id."</td>";
            echo "<td>".$evo_glass_array[$i]->prillivarv."</td>";
            echo "<td>".$evo_glass_array[$i]->materjal."</td>";
            if(isset($_SESSION["logged_in_user_id"])){ 
			echo "<td><a href='?delete=".$evo_glass_array[$i]->id."'>X</a></td>";
            echo "<td><a href='?edit=".$evo_glass_array[$i]->id."'>edit</a></td>"; 
			}
            echo "</tr>";
            
        }
        
        
        
        
    }
    
?>
</table>