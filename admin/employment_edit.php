<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if( isset( $_POST['companyName'] ) )
{
  
    $query = 'UPDATE employment SET
    companyName = "'.mysqli_real_escape_string( $connect, $_POST['companyName'] ).'",
    title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
    description = "'.mysqli_real_escape_string( $connect, $_POST['description'] ).'",
    startDate = "'.mysqli_real_escape_string( $connect, $_POST['startDate'] ).'",
    endDate = "'.mysqli_real_escape_string( $connect, $_POST['endDate'] ).'"
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
    mysqli_query( $connect, $query );

    header( 'Location: employments.php' );
    die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM employment
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: employments.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Employment</h2>
<form method="post">
    <div>
        <label for="companyName">Company Name</label>
        <input type="text" id="companyName" name="companyName" value="<?php echo htmlentities( $record['companyName'] ); ?>" />
    </div>
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo htmlentities( $record['title'] ); ?>" />
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" value="<?php echo htmlentities( $record['description'] ); ?>" />
    </div>
    <div>
        <label for="startDate">Start Date</label>
        <input type="date" id="startDate" name="startDate" value="<?php echo htmlentities( $record['startDate'] ); ?>" />
    </div>
    <div>
        <label for="endDate">End Date</label>
        <input type="date" id="endDate" name="endDate" value="<?php echo htmlentities( $record['endDate'] ); ?>" />
    </div>    
    <input type="submit" value="Save Changes" />
</form>
<p><a href="employments.php">Return to Employments List</a></p>

<?php

include( 'includes/footer.php' );

?>