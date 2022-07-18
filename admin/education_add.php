<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( isset( $_POST['schoolName'] ) )
{
  
  if( $_POST['schoolName'])
  {
    
    $query = 'INSERT INTO education (
        schoolName,
        program,
        startDate,
        endDate
      ) VALUES (
         "'.mysqli_real_escape_string( $connect, $_POST['schoolName'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['program'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['startDate'] ).'",
         "'.mysqli_real_escape_string( $connect, $_POST['endDate'] ).'"
      )';
    mysqli_query( $connect, $query );
    
    set_message( 'Education has been added' );
    
  }
  
  header( 'Location: education.php' );
  die();
  
}

?>

<h2>Add Education</h2>

<form method="post">
  
  <label for="schoolName">School Name:</label>
  <input type="text" name="schoolName" id="schoolName">
    
  <br>
  
  <label for="program">Program:</label>
  <input type="text" name="program" id="program">
  
  <br>
  
  <label for="startDate">Start Date:</label>
  <input type="date" name="startDate" id="startDate">
  
  <br>

  <label for="endDate">End Date:</label>
  <input type="date" name="endDate" id="endDate">
  
  <br>
  
  <input type="submit" value="Add Education">
  
</form>

<p><a href="education.php"><i class="fas fa-arrow-circle-left"></i> Return to Education List</a></p>


<?php

include( 'includes/footer.php' );

?>