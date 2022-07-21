<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['email'] ) )
{
  
  if( $_POST['email'] and $_POST['url'] and $_POST['address'] )
  {
    
    $query = 'insert into contact values(null,"'.mysqli_real_escape_string( $connect,$_POST['email']).'","'
        .mysqli_real_escape_string( $connect,$_POST['url']).'",
        "'.mysqli_real_escape_string( $connect,$_POST['address']).'")';
    echo $query;
    mysqli_query( $connect, $query );
    
    set_message( 'Contact has been added' );
    
  }

  header( 'Location: contacts.php' );
  sdie();
  
}

include( 'includes/header.php' );

?>

<h2>Add Contact</h2>

<form method="post">
  
  <label for="email">Email:</label>
  <input type="email" name="email" id="email">
  
  <br>
  
  <label for="url">Url:</label>
  <input type="text" name="url" id="url">
  
  <br>
  
  <label for="address">Address:</label>
    <textarea name="address" id="address" rows="5"></textarea>
  

  <br>
  
  <input type="submit" value="Add Contact">
  
</form>

<p><a href="users.php"><i class="fas fa-arrow-circle-left"></i> Return to User List</a></p>


<?php

include( 'includes/footer.php' );

?>