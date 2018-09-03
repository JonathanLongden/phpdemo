<html>

  <head>
    <title>Jr Challenge</title>
  </head>
  <body>
    <h1 align="center">Jr Developer Challenge</h1>

   <style>
    table, th, td {
        border: 1px solid green;
    }
    </style>

    <!-- Make inputs for name, address, email -->
    <h1>1. Make inputs for name, address, email</h1>
    <form class='addUser' autocomplete="on">
        <div><input type='text' id="name" placeholder='Firstname' /></div>
        <div><input type='text' id="address" placeholder='Address' /></div>
        <div><input type='text' id="email" placeholder='Email' /></div>
        <div><input type='submit' value='Submit' /></div>
    </form>
    <br/>
    <!-- Make a table header - Include Name, Address, email -->
    <h1>2. Make a table header - Include Name, Address, email</h1>
    <table style="width:100%">
        <thead>
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>             
            </tr>
        </thead>
        <tbody class="display" >
            <tr>
                <td><input type="checkbox" name="record"></td>
                <td>Jonathan</td>
                <td>178 Heidner ln Bozeman MT 59718</td>
                <td>longden.jonathanedgar@gmail.com</td>
            </tr>
            <?php
            //Do something Here
            ?>
        </tbody>
    </table>
    <br>

    <!-- Make a php array, loop to output as a ul html list -->
    <?php
    echo "<h1>3. Make a php array, loop to output as a ul html list</h1>";
    $SuperHeros = array("Batman", "Captain America", "Wolverine");
    echo '<ul>';
    foreach($SuperHeros as $p){
    echo '<li>'.$p.'</li>';
    }
    echo '</ul>';

    ?>
    <br/> 
    <br/>    
    <div align="center">
      <h1>Delete button that Deletess off Both Tables, but not from the DataBase</h1>
      <button type="button"  class="delete-row">Delete Row</button>
    </div>
    <br/>      
    


    <!-- where the response will be displayed -->
    <div align="center" class='response'></div>

    <br/>
    <br/>
    
    

    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
      //1. How do you make a javascipt closure?  What are the benifits.
        //You make a javascript closure by creating a function with varaiables in it that returns something.
        console.log("4.How do you make a javascipt closure?  What are the benifits.")
        var val = 8;
        function createAdder() {
          function addNumbers(a, b) {
              let ret = a + b
              return ret
            }
           return addNumbers
        }
        let adder = createAdder()
        let sum = adder(val, 8)
        console.log('example of function returning a function: ', sum)

        //A closure is an inner function that has access to the outer (enclosing) function's variables—scope chain. 
        //The closure has three scope chains: it has access to its own scope (variables defined between its curly brackets), 
        //it has access to the outer function's variables, and it has access to the global variables
    

      //2. Use JQuery to send the data to the database with an AJAX call.  Add the row to the table dynamically.
      //Post Data
      $(document).ready(function(){

        //Posting Data
        $('.addUser').submit(function(){
            
            //show that something is loading
            $('.response').html("<b>Submitting Data... in 2 Seconds</b><br/><h1>6. Use JQuery to add the row without a page reload.</h1>").show();
            //Please Note...
            //I do not need this timeout function however I added it anyways. 
            setTimeout(function (){
               //This will Display in 2 seconds
               /*
                * 'users.php' - where you will pass the form data
                * $(this).serialize() - to easily read form data
                * function(data){... - data contains the response from users.php
                */
                var name = $("#name").val();
                var email = $("#email").val();
                var address = $("#address").val();
                var dataPost = {name,email,address};
                //console.log(dataPost)
                var markup = "<tr><td><input type='checkbox' name='record'></td><td>" + name + "</td><td>" + email + "</td><td>" + address + "</td></tr>"
                
                
                //console.log(dataPost);
                //console.log($(this).serialize())
                $.post('users.php', dataPost, function(data){
             
                  // show the response
                    $('.response').html(data);
                    $(".display").append(markup);
                }).fail(function() {
                  
                    // just in case posting your form failed
                    alert( "Posting failed." );
                      
                });

             
                

           }, 1000);

            // to prevent refreshing the whole page page
            return false;
    
        });

        // Find and remove selected table rows
        $(".delete-row").click(function(){
            $("table tbody").find('input[name="record"]').each(function(){
            	if($(this).is(":checked")){
                    $(this).parents("tr").remove();
                }
            });
            return false;
        });

 
    });//End of Document

      //3. How do you wait for the page to load before running a function

      //4. Attach an event handler function to the button click.

      //5. Make the handler add a new row to the db by AJAX request.
          
      //6. Use JQuery to add the row without a page reload.
          

    </script>
   
  </body>
</html>
