<?php

include( 'includes/database.php' );
include( 'includes/config.php' );
include( 'includes/functions.php' );

if(isset($_POST['title']))
{
    $query = 'INSERT INTO projects (
        title, 
        projectDescription, 
        usedSkills, 
        photo) VALUES (
        "'.mysqli_real_escape_string($connect, $_POST['title']).'", 
        "'.mysqli_real_escape_string($connect, $_POST['projectDescription']).'", 
        "'.mysqli_real_escape_string($connect, $_POST['usedSkills']).'",
        "'.mysqli_real_escape_string($connect, $_POST['photo']).'"
    )';
    mysqli_query($connect, $query);
    header('Location: projects.php');
    die();
}

include( 'includes/header.php' );

?>

<h2>Add Project</h2>
<form method="post">
    <div>
        <label for="title">Project Title</label>
        <input type="text" id="title" name="title" />
    </div>
    <div>
        <label for="projectDescription">Project Description</label>
        <input type="text" id="projectDescription" name="projectDescription" />
    </div>
    <div>
        <label for="usedSkills">Used Skills</label>
        <input type="text" id="usedSkills" name="usedSkills" />
    </div>
    <input type="submit" value="Add" />
</form>
<p><a href="projects.php">Return to Projects List</a></p>


<?php

include( 'includes/footer.php' );

?>