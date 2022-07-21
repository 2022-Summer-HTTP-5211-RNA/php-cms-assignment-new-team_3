<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (isset($_GET['delete'])) {

    $query = 'DELETE FROM contact
    WHERE id = ' . $_GET['delete'] . '
    LIMIT 1';
    mysqli_query($connect, $query);

    set_message('User has been deleted');

    header('Location: contacts.php');
    die();

}

include('includes/header.php');

$query = 'SELECT * FROM contact';
$result = mysqli_query($connect, $query);

?>

    <h2>Manage Users</h2>

    <table>
        <tr>
            <th align="center">Id</th>
            <th align="left">Email</th>
            <th align="left">URL</th>
            <th align="left">Address</th>
            <th></th>
            <th></th>
        </tr>
        <?php while ($record = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td align="center"><?php echo $record['id']; ?></td>
                <td align="left"><?php echo htmlentities($record['email']); ?> </td>
                <td align="left"><?php echo htmlentities($record['url']); ?> </td>
                <td align="left"><?php echo htmlentities($record['address']); ?> </td>
                <td align="center"><a href="contact_edit.php?id=<?php echo $record['id']; ?>">Edit</a></td>
                <td align="center">
                    <a href="contacts.php?delete=<?php echo $record['id']; ?>" onclick="javascript:confirm('Are you sure you want to delete this project?');">Delete</i></a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>

    <p><a href="contact_add.php"><i class="fas fa-plus-square"></i> Add Contact</a></p>


<?php

include('includes/footer.php');

?>