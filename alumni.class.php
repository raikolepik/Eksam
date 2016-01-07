<?php
class Alumni {
private $connection;

function __construct($mysqli){
      $this->connection = ($mysqli);
  }

  function getData() {
    $stmt = $this->connection->prepare("SELECT Nimi, Aadress, Telefon, Elektronpost, id FROM vilistlased");
    $stmt->bind_result($name, $address, $telefon, $epost, $id);
    $stmt->execute();

    $array = array();

    while($stmt->fetch()) {
      $data = new StdClass();
      $data->id = $id;
      $data->name = $name;
      $data->address = $address;
      $data->telefon = $telefon;
      $data->epost = $epost;
      array_push($array, $data);
    }

    return $array;

    $stmt->close();
  }


}
 ?>

