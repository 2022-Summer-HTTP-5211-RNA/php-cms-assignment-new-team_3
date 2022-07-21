<?php

include('includes/database.php');
include('includes/config.php');
include('includes/functions.php');

secure();

if (!isset($_GET['id'])) {

    header('Location: contacts.php');
    die();

}

if (isset($_POST['email'])) {

    if ($_POST['email'] and $_POST['url'] and $_POST['address']) {
        $query = 'UPDATE contact SET 
    email="' . mysqli_real_escape_string($connect, $_POST['email']) . '",
    url="' . mysqli_real_escape_string($connect, $_POST['url']) . '",
    address="' . mysqli_real_escape_string($connect, $_POST['address']) . '"';
        //echo $query;
        mysqli_query($connect, $query);


        set_message('Contact has been updated');

    }

    header('Location: contacts.php');
    die();

}


if (isset($_GET['id'])) {

    $query = 'SELECT *
    FROM contact
    WHERE id = ' . $_GET['id'] . '
    LIMIT 1';
    $result = mysqli_query($connect, $query);

    if (!mysqli_num_rows($result)) {

        header('Location: contacts.php');
        die();

    }

    $record = mysqli_fetch_assoc($result);

}

include('includes/header.php');

?>

    <h2>Edit Contact</h2>

    <form method="post">

        <label for="first">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo htmlentities($record['email']); ?>">

        <br>

        <label for="url">Url:</label>
        <input type="text" name="url" id="url" value="<?php echo htmlentities($record['url']); ?>">

        <br>


        <label for="password">Address:</label>
        <textarea name="address" id="address" rows="5"><?php echo htmlentities($record['address']); ?></textarea>

        <br>


        <input type="submit" value="Edit Contact">

    </form>

    <p><a href="contacts.php"><i class="fas fa-arrow-circle-left"></i> Return to Contact List</a></p>


<?php

include('includes/footer.php');

?>