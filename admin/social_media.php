<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

    $query = 'DELETE FROM social_media
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Social Media has been deleted');

    header('Location: social_media.php');
    die();

}

include('includes/header.php');

$query = 'SELECT *
  FROM social_media
  ORDER BY id DESC';
$result = mysqli_query($connect, $query);

?>

    <h2>Manage Social Media</h2>

    <table>
        <tr>
            <th></th>
            <th align="center">ID</th>
            <th align="left">Name</th>
            <th align="center">Url</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($record = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td align="center">
                    <img src="image.php?type=social&id=<?php echo $record['id']; ?>&width=50&height=50&format=inside">
                </td>
                <td align="center"><?php echo $record['id']; ?></td>
                <td align="left">
                    <?php echo htmlentities($record['title']); ?>
                </td>
                <td><?php echo $record['link']; ?>  </td>
                <td align="center"><a href="socialmedia_photo.php?id=<?php echo $record['id']; ?>">Photo</i></a></td>
                <td align="center"><a href="socialmedia_edit.php?id=<?php echo $record['id']; ?>">Edit</i></a></td>
                <td align="center">
                    <a href="social_media.php?delete=<?php echo $record['id']; ?>"
                       onclick="javascript:confirm('Are you sure you want to delete this project?');">Delete</i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="socialmedia_add.php"><i class="fas fa-plus-square"></i> Add Social Media</a></p>


<?php

include('includes/footer.php');

?>