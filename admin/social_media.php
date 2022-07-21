<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

    $query = 'DELETE FROM social_media
    WHERE socialMediaid = ' . $_GET['delete'] . '
    LIMIT 1';
    mysqli_query($connect, $query);

    set_message('Social Media has been deleted');

    header('Location: social_media.php');
    die();

}

include('includes/header.php');

$query = 'SELECT *
  FROM social_media
  ORDER BY socialMediaid DESC';
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
                    <?php if ($record['socialMediaIcon'] != null){ ?>
                    <img src="<?php echo $record['socialMediaIcon'] ?>">
                    <p>
                        <?php
                        echo "photo.php?type=socialmedia&id=" . $record['socialMediaid'] . "&width=300&height=300&format=inside";
                        } ?> </p>
                </td>
                <td align="center"><?php echo $record['socialMediaid']; ?></td>
                <td align="left">
                    <?php echo htmlentities($record['socialMediaName']); ?>
                </td>
                <td><?php echo $record['socialMediaLink']; ?>  </td>
                <td align="center"><a href="socialmedia_photo.php?id=<?php echo $record['socialMediaid']; ?>">Photo</i></a></td>
                <td align="center"><a href="socialmedia_edit.php?id=<?php echo $record['socialMediaid']; ?>">Edit</i></a></td>
                <td align="center">
                    <a href="social_media.php?delete=<?php echo $record['socialMediaid']; ?>"
                       onclick="javascript:confirm('Are you sure you want to delete this project?');">Delete</i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="socialmedia_add.php"><i class="fas fa-plus-square"></i> Add Social Media</a></p>


<?php

include('includes/footer.php');

?>