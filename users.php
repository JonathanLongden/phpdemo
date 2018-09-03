<?php


// echo "<pre>";
//     print_r($_POST);
// echo "</pre>";

//echo '<script>console.log('. json_encode( $_POST ) .')</script>';

$users = array //$conn->query($QuerySelect);
          (
          array("Jon","400 N Kennedy", "Fred@gmail.com"),
          array("Rebecca","350 Heidner Ln", "Barney@yahoo.com"),
          array("Thomas","178 Heidner Ln", "Dino@hotmail.com"),
          array("Isa","Hwy 85 N", "BamBam@aol.com"),
          );
//creates new Array php
$addingNewPerson = array();
foreach( $_POST as $prop) {
    $prop;
    //echo '<script>console.log('. json_encode( $prop ) .')</script>';
    if($prop != null){
        array_push($addingNewPerson, $prop);
    }
    //push string into the Array of addingNewPerson
    
    }
//push array into $users as it is an Array of Arrays
array_push($users, $addingNewPerson);



//Table
echo "<h1 align='center'>Table From DataBase</h1>";
echo "<table style='width:100%' border='1' align='center'>";
echo "<thead>";
    echo "<tr>";    
        echo "<th>First Name</th>";
        echo "<th>Last Name</th>";
        echo "<th>Email</th>";
        echo "<th>Select</th>";
    echo "</tr>";
echo "</thead>";


foreach ($users as $row) {
    //echo '<script>console.log('. json_encode( $row ) .')</script>';       
    echo "<tr>";
    foreach ($row as $col) {
        //echo '<script>console.log('. json_encode( $col) .')</script>';
        echo "<th>".$col."</th>";
    }   
    echo "<th><input type='checkbox' name='record'></th>";
    echo "</tr>";
 }


//Theses Things needs to be Done

// users.php - this will be called by ajax in the other codeshare.



// Call the populate_user_row function with POST data
include 'user_class.php';
if ($conn) {
    add_user($_POST, $conn);
}

?>
