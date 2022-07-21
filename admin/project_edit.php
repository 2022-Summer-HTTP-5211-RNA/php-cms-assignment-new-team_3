<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if( isset( $_POST['title'] ) )
{
  
    $query = 'UPDATE projects SET
    title = "'.mysqli_real_escape_string( $connect, $_POST['title'] ).'",
    projectDescription = "'.mysqli_real_escape_string( $connect, $_POST['projectDescription'] ).'",
    usedSkills = "'.mysqli_real_escape_string( $connect, $_POST['usedSkills'] ).'",
    photo = "'.mysqli_real_escape_string( $connect, $_POST['photo'] ).'"
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
    mysqli_query( $connect, $query );

    header( 'Location: projects.php' );
    die();
  
}


if( isset( $_GET['id'] ) )
{
  
  $query = 'SELECT *
    FROM projects
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: projects.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include( 'includes/header.php' );

?>

<h2>Edit Project</h2>
<form method="post">
    <div>
        <label for="title">Project Title</label>
        <input type="text" id="title" name="title" value="<?php echo htmlentities( $record['title'] ); ?>" />
    </div>
    <div>
        <label for="projectDescription">Project Description</label>
        <input type="text" id="projectDescription" name="projectDescription" value="<?php echo htmlentities( $record['projectDescription'] ); ?>" />
    </div>
    <div>
        <label for="usedSkills">Used Skills</label>
        <input type="text" id="usedSkills" name="usedSkills" value="<?php echo htmlentities( $record['usedSkills'] ); ?>" />
    </div>
    <input type="submit" value="Save Changes" />
</form>
<p><a href="projects.php">Return to Projects List</a></p>

<?php

include( 'includes/footer.php' );

?>