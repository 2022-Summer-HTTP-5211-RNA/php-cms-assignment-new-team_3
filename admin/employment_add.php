<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if(isset($_POST['companyName']))
{
    $query = 'INSERT INTO employment (
        companyName, 
        title, 
        description, 
        startDate, 
        endDate) VALUES (
        "'.mysqli_real_escape_string($connect, $_POST['companyName']).'", 
        "'.mysqli_real_escape_string($connect, $_POST['title']).'", 
        "'.mysqli_real_escape_string($connect, $_POST['description']).'",
        "'.mysqli_real_escape_string($connect, $_POST['startDate']).'",
        "'.mysqli_real_escape_string($connect, $_POST['endDate']).'"
    )';
    mysqli_query($connect, $query);
    header('Location: employments.php');
    die();
}

include( 'includes/header.php' );

?>

<h2>Add Employment</h2>
<form method="post">
    <div>
        <label for="companyName">Company Name</label>
        <input type="text" id="companyName" name="companyName" />
    </div>
    <div>
        <label for="title">Title</label>
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="description">Description</label>
        <input type="text" id="description" name="description" />
    </div>
    <div>
        <label for="startDate">Start Date</label>
        <input type="date" id="startDate" name="startDate" />
    </div>
    <div>
        <label for="endDate">End Date</label>
        <input type="date" id="endDate" name="endDate" />
    </div>    
    <input type="submit" value="Add" />
</form>
<p><a href="employments.php">Return to Employments List</a></p>


<?php

include( 'includes/footer.php' );

?>