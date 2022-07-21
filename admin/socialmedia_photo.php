<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

secure();

include( 'includes/header.php' );

if( !isset( $_GET['id'] ) )
{
  
  header( 'Location: social_media.php' );
  die();
  
}

if( isset( $_FILES['photo'] ) )
{
  
  if( isset( $_FILES['photo'] ) )
  {
  
    if( $_FILES['photo']['error'] == 0 )
    {

      switch( $_FILES['photo']['type'] )
      {
        case 'image/png': 
          $type = 'png'; 
          break;
        case 'image/jpg':
        case 'image/jpeg':
          $type = 'jpeg'; 
          break;
        case 'image/gif': 
          $type = 'gif'; 
          break;      
      }

      $query = 'UPDATE social_media SET
        photo = "data:image/'.$type.';base64,'.base64_encode( file_get_contents( $_FILES['photo']['tmp_name'] ) ).'"
        WHERE id = '.$_GET['id'].'
        LIMIT 1';
      mysqli_query( $connect, $query );

    }
    
  }
  
  set_message( 'Social Media Icon has been updated' );

  header( 'Location: social_media.php' );
  die();
  
}


if( isset( $_GET['id'] ) )
{
  
  if( isset( $_GET['delete'] ) )
  {
    
    $query = 'UPDATE social_media SET
      photo = ""
      WHERE id = '.$_GET['id'].'
      LIMIT 1';
    $result = mysqli_query( $connect, $query );
    
    set_message( 'Social Media Icon has been deleted' );
    
    header( 'Location: social_media.php' );
    die();
    
  }
  
  $query = 'SELECT *
    FROM social_media
    WHERE id = '.$_GET['id'].'
    LIMIT 1';
  $result = mysqli_query( $connect, $query );
  
  if( !mysqli_num_rows( $result ) )
  {
    
    header( 'Location: social_media.php' );
    die();
    
  }
  
  $record = mysqli_fetch_assoc( $result );
  
}

include ( 'includes/header.php' );

include 'includes/wideimage/WideImage.php';

?>

<h2>Edit Social Media</h2>

<p>
  Note: For best results, photos should be approximately 30 x 30 pixels.
</p>

<?php if( $record['photo'] ): ?>

  <?php

  $data = base64_decode( explode( ',', $record['photo'] )[1] );
  $img = WideImage::loadFromString( $data );
  $data = $img->resize( 50, 50, 'outside' )->crop( 'center', 'center', 50, 50 )->asString( 'jpg', 70 );

  ?>
  <p><img src="data:image/jpg;base64,<?php echo base64_encode( $data ); ?>" width="50" height="50"></p>
  <p><a href="socialmedia_photo.php?id=<?php echo $_GET['id']; ?>&delete"><i class="fas fa-trash-alt"></i> Delete this Photo</a></p>

<?php endif; ?>

<form method="post" enctype="multipart/form-data">
  
  <label for="photo">Photo:</label>
  <input type="file" name="photo" id="photo">
  
  <br>
  
  <input type="submit" value="Save Photo">
  
</form>

<p><a href="social_media.php"><i class="fas fa-arrow-circle-left"></i> Return to Social Media List</a></p>


<?php

include( 'includes/footer.php' );

?>