<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( isset( $_POST['name'] ) )
{
  
  if( $_POST['name'] and $_POST['link'] )
  {
    
    $query = 'INSERT INTO social_media (
        title,
        link
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['link'] ).'"
      )';
    echo $query;
    mysqli_query( $connect, $query );
    
    set_message( 'Social Media has been added' );
    
  }
  
  header( 'Location: social_media.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Add Social Media</h2>

<form method="post">
  
  <label for="name">Name:</label>
  <input type="text" name="name" id="name">
    
  <br>
  
  <label for="link">Link:</label>
  <textarea  name="link" id="link" rows="10"></textarea>
      
 <br>
  <input type="submit" value="Add Social Media">
  
</form>

<p><a href="social_media.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a></p>


<?php

include( 'includes/footer.php' );

?>