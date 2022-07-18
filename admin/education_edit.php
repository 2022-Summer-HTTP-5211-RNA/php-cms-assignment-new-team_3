<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: education.php' );
  die();
  
}

if( isset( $_POST['schoolName'] ) )
{
  
  if( $_POST['schoolName'])
  {
    
    $query = 'UPDATE education SET
      schoolName = "'.mysqli_real_escape_string( $connect, $_POST['schoolName'] ).'",
      program = "'.mysqli_real_escape_string( $connect, $_POST['program'] ).'",
      startDate = "'.mysqli_real_escape_string( $connect, $_POST['startDate'] ).'",
      endDate = "'.mysqli_real_escape_string( $connect, $_POST['endDate'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been updated' );
    
  }

  header( 'Location: education.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM education
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: education.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

?>

<h2>Edit Education</h2>

<form method="post">
  
  <label for="schoolName">School Name:</label>
  <input type="text" name="schoolName" id="schoolName" value="<?php echo htmlentities( $record['schoolName'] ); ?>">
    
  <br>
  
  <label for="program">Program:</label>
  <input type="text" name="program" id="program" value="<?php echo htmlentities( $record['program'] ); ?>">
    
  <br>
  
  <label for="startDate">Start Date:</label>
  <input type="date" name="startDate" id="startDate" value="<?php echo htmlentities( $record['startDate'] ); ?>">
    
  <br>

  <label for="endDate">End Date:</label>
  <input type="date" name="endDate" id="endDate" value="<?php echo htmlentities( $record['endDate'] ); ?>">
    
  <br>
  
  <input type="submit" value="Edit Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>