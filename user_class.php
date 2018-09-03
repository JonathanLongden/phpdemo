<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "demo";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
  

//1. In SQL create a user table with feilds for id, name, email, group_id, address_id

$UserInfo = "CREATE TABLE user_info (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name text,
  email text,
  group_id INT(6),
  address_id INT(6)
)";


//2. Create a group table and address tables include keys to the user table so that join select statements can be done.

$UserAdrress ="CREATE TABLE user_address (
  id integer UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  location text,
  state text,
  zip integer
)";


$UserGroup ="CREATE TABLE user_group (
  id integer UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name text
)";


//3. If there are PHP keywords here that you don't understand, Google it.

// `` are column names
// '' are values


function fill_user_list_variables($args) {
  extract($args);  // What does extract do?
  //converts array keys into variable names and array values into variable value.
  //https://www.geeksforgeeks.org/php-extract-function/
  

  $where_sql = "WHERE 1";
  $sort_sql = "";
  $from_sql = "";
  $search_sql = "";
  $param_array = array();

  // assume that this sets up the database correctly.
  $db = new PDO("config string");
  // $group, $order, $dir, $q - these are the optional variable that may be passed in.

  //select all rows and columns form a table called users.
  $All_user = "SELECT * FROM user_info";

  // select the `name` of all the users in 'guest' `group` if a group variable to be passed to func and set to guest. Assume a $group variable passed in.
  $Name = "SELECT `name` FROM user_info;";

  // Place the selection into a variable $select_sql.  Use conditionals and add to the $where_sql variable.
  $select_sql = $All_user. $where_sql;


  // sort the results by `number_of_files` largest to smallest, make it possible to sort smallest to largest.  Assume a $order and $dir variable - put in $sort_sql
  $number_of_files = "Select * from files_table ORDER BY number_of_files". $sort_sql;


  // Do a text search for a partial name - put in $search_sql
  $search_name = $Name . $where_sql ."name like CONCAT('%',$search_sql,'%')'";


  // combine partial sql stmts into $sql_stmt_st
  $sql_stmt_st =
  //Confused by this question.

  // make the statment - this prepares and executes the statement.
  $sql_stmt = $db->prepare($sql_stmt_st);
  $sql_stmt->execute($param_array);

  $result = $sql_stmt->fetch(); // Use in a loop - this returns one result at a time until
  
  $returnArray = array();


  while($result = true){
    array_push($returnArray,$result);
  }

  return $returnArray;

  // return an array of associtive arrays of all users.
}


function find_address_id($address, $conn){
  //http://php.net/manual/en/mysqli.prepare.php
  //Prepared Statements
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
      //echo '<script>console.log('. json_encode($address) .')</script>';
      if ($stmt = $conn->prepare("SELECT `id`  FROM user_address where `location`=?")) {

          /* bind parameters for markers */
          $stmt->bind_param("s", $address);
  
          /* execute query */
          $stmt->execute();
  
          /* bind result variables */
          $stmt->bind_result($id);
      
          /* fetch value */
          $stmt->fetch();
          if ($id) {
              return $id;
              //echo '<script>console.log('. json_encode($id) .')</script>';
          } else {
              $Insert_New_Address= "INSERT INTO user_address (location, state, zip) VALUES ('$address', 'MT', '59718')";
              if (mysqli_query($conn, $Insert_New_Address)) {
                  echo "New Address was Created";
                  //$result = mysqli_query($conn, $addressId);
                  if ($stmt = $conn->prepare("SELECT `id`  FROM user_address where `location`=?")) {

                    /* bind parameters for markers */
                      $stmt->bind_param("s", $address);
            
                      /* execute query */
                      $stmt->execute();
            
                      /* bind result variables */
                      $stmt->bind_result($id);
                
                      /* fetch value */
                      $stmt->fetch();
                      if ($id) {
                          return $id;
                          //echo '<script>console.log('. json_encode($id) .')</script>';
                      } else {
                          echo "ERROR: Could not able to execute $Insert_New_Address. " . mysqli_error($conn);
                      }
                  } else {
                      echo "ERROR: Could not able to execute $Insert_New_Address. " . mysqli_error($conn);
                  }
              }
  
              /* close statement */
              //$stmt->close();
          }
      }
  }
 
}

function find_group_id($name, $conn){
  //http://php.net/manual/en/mysqli.prepare.php
  //Prepared Statements
  // echo '<script>console.log('. json_encode($name) .')</script>';
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  } else {
      
      if ($stmt = $conn->prepare("SELECT `id`  FROM user_group where `name`=?")) {

          /* bind parameters for markers */
          $stmt->bind_param("s", $name);
  
          /* execute query */
          $stmt->execute();
  
          /* bind result variables */
          $stmt->bind_result($id);
      
          /* fetch value */
          $stmt->fetch();
          
          if ($id != null) {
              return $id;
              echo '<script>console.log('. json_encode($id) .')</script>';
          } else {
              
              $Insert_new_group = "INSERT INTO user_group (name) VALUES ('$name')";
              if (mysqli_query($conn, $Insert_new_group)) {
                  echo "New Goup was Created";
                  echo '<script>console.log('. json_encode( $Insert_new_group) .')</script>';
                  //$result = mysqli_query($conn, $group_Id);
                  if ($stmt = $conn->prepare("SELECT `id`  FROM user_group where `name`=?")) {

                      /* bind parameters for markers */
                      $stmt->bind_param("s", $name);
            
                      /* execute query */
                      $stmt->execute();
            
                      /* bind result variables */
                      $stmt->bind_result($id);
                
                      /* fetch value */
                      $stmt->fetch();
                      if ($id) {
                          return $id;
                          //echo '<script>console.log('. json_encode($id) .')</script>';
                      } else {
                          echo "ERROR: Could not able to execute $InsertNewUser. " . mysqli_error($conn);
                      }
                  } else {
                      echo "ERROR: Could not able to execute $InsertNewUser. " . mysqli_error($conn);
                  }
              }
  
              /* close statement */
              //$stmt->close();
          }
      }
  }
 
}

function add_user($args, $conn){
    echo '<script>console.log('. json_encode($args) .')</script>';
    extract($args);
    // Insert a row into the user table.  Data -> username, Full Name, email, group id

    $group_id = find_group_id($name, $conn);
    $address_id = find_address_id(trim($address), $conn);
    // echo '<script>console.log('. json_encode($group_id) .')</script>';
    // echo '<script>console.log('. json_encode($address_id) .')</script>';
    if ($address_id  > 0 && $group_id > 0) {
        $Insert_new_user = "INSERT INTO user_info (name, email, group_id, address_id) 
        VALUES('$name', '$email', '$group_id', '$address_id')";

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        } else {
            if (mysqli_query($conn, $Insert_new_user)) {
                echo "New record created successfully";
            } else {
                echo "ERROR: Could not able to execute $Insert_new_userr. " . mysqli_error($conn);
            }
        }

        return json_ecncode(array('error'=>0, 'msg'=>''));
    }
    else
    {
      echo "Failed on getting or creating AddressId of $address_id or Failed on getting or creating GroupId of $group_id";
    }
}

 ?>
