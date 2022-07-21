<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if( isset( $_GET['delete'] ) )
{
  
  $query = 'DELETE FROM employment
    WHERE id = '.$_GET['delete'].'
    LIMIT 1';
  mysqli_query( $connect, $query );
    
  
  header( 'Location: employments.php' );
  die();
  
}

include( 'includes/header.php' );

?>

<h2>Employments</h2>

<?php

$query = 'SELECT * FROM employment';
$result = mysqli_query($connect, $query);


?>

<table border="3">
    <tr>
        <th>Company Name</th>
        <th>Title</th>
        <th>Description</th>
        <th>Start Date</th>
        <th>End Date</th>
        <th></th>
        <th></th>
    </tr>
    <?php while( $record = mysqli_fetch_assoc( $result ) ): ?>
    <tr>
      <td><?php echo $record['companyName'] ?></td>
      <td><?php echo $record['title'] ?></td>
      <td><?php echo $record['description'] ?></td>
      <td><?php echo $record['startDate'] ?></td>
      <td><?php echo $record['endDate'] ?></td>
      <td>
        <a href="employment_edit.php?id=<?php echo $record['id'] ?>">Edit</a>
      </td>
      <td>
        <a href="employments.php?delete=<?php echo $record['id'] ?>" onclick="javascript:confirm('Are you sure you want to delete this employment?');">Delete</a>
      </td>
    </tr>
    <?php endwhile; ?>
</table>

<a href="employment_add.php">Add Employment</a>

<?php

include( 'includes/footer.php' );

?>