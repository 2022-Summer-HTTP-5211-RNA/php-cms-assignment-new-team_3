<?php

include( 'admin/includes/database.php' );
include( 'admin/includes/config.php' );
include( 'admin/includes/functions.php' );

?>
<!doctype html>
<html>
<head>
  
  <meta charset="UTF-8">
  <meta http-equiv="Content-type" content="text/html; charset=UTF-8">
  
  <title>Website Admin</title>
  
  <link href="styles.css" type="text/css" rel="stylesheet">
  
  <script src="https://cdn.ckeditor.com/ckeditor5/12.4.0/classic/ckeditor.js"></script>
  
</head>
<body>

  <h1>Welcome to My Website!</h1>
  <p>This is the website frontend!</p>

  <?php

  $query = 'SELECT *
    FROM projects
    ORDER BY date DESC';
  $result = mysqli_query( $connect, $query );

  ?>

  <h2>Projects</h2>

  <p>There are <?php echo mysqli_num_rows($result); ?> projects in the database!</p>

  <hr>

  <?php while($record = mysqli_fetch_assoc($result)): ?>

    <div>

      <h2><?php echo $record['title']; ?></h2>
      <?php echo $record['content']; ?>

      <?php if($record['photo']): ?>

        <p>The image can be inserted using a base64 image:</p>

        <img src="<?php echo $record['photo']; ?>" width="200">

        <p>Or by streaming the image through the image.php file:</p>

        <img src="admin/image.php?type=project&id=<?php echo $record['id']; ?>&width=100&height=100">

      <?php else: ?>

        <p>This record does not have an image!</p>

      <?php endif; ?>

    </div>

    <hr>

  <?php endwhile; ?>

  <h2>Skills</h2>

  <?php

  $query = 'SELECT *
    FROM skills
    ORDER BY percent DESC';
  $result = mysqli_query( $connect, $query );

  ?>

<?php while($record = mysqli_fetch_assoc($result)): ?>

  <h4><?php echo $record['title']; ?></h4>

  <img src="<?php echo $record['photo']; ?>" width="50">

  <div style="width: 50%; background-color: #5e5e5e; height: 0.7rem; display: inline-block;">
    <div style="width: <?php echo $record['percent']; ?>%; background-color: #78faf8; height: 0.7rem;"></div>
  </div>
  <small style="display: inline-block;"><?php echo $record['percent']; ?>%</small>

<?php endwhile; ?>

<h2>Education</h2>

  <?php

  $query = 'SELECT *
    FROM education
    ORDER BY startDate DESC';
  $result = mysqli_query( $connect, $query );

  ?>

<?php while($record = mysqli_fetch_assoc($result)): ?>

  <h4><?php echo $record['schoolName']; ?></h4>
  <p><?php echo $record['program']; ?></p>
  <small>From <?php echo $record['startDate']; ?> to </small>
  <small><?php echo $record['endDate']; ?></small>

<?php endwhile; ?>

</body>
</html>
