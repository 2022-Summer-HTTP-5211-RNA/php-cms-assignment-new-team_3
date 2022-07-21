<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

if( !isset( $_GET['id'] ) )
{

    header( 'Location: social_media.php' );
    die();

}

if( isset( $_POST['name'] ) )
{

    if( $_POST['name'] and $_POST['link'] )
    {

        $query = 'UPDATE social_media SET
      title = "'.mysqli_real_escape_string( $connect, $_POST['name'] ).'",
      link = "'.mysqli_real_escape_string( $connect, $_POST['link'] ).'"
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
        mysqli_query( $connect, $query );

        set_message( 'Social Media has been updated' );

    }

    header( 'Location: social_media.php' );
    die();

}


if( isset( $_GET['id'] ) )
{

    $query = 'SELECT *
    FROM social_media
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

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo htmlentities( $record['title'] ); ?>">

        <br>

        <label for="link">Link:</label>
        <textarea type="text" name="link" id="link" rows="5"><?php echo htmlentities( $record['link'] ); ?></textarea>

        <br>

        <input type="submit" value="Edit Project">

    </form>

    <p><a href="projects.php"><i class="fas fa-arrow-circle-left"></i> Return to Project List</a></p>


<?php

include( 'includes/footer.php' );

?>