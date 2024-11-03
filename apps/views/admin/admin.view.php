<?php
    $headTitle = 'Admin Panel | Gbenga Opeyemi Portfolio';
    require "include/header.php";
?>

<main class="md">
    <h1>ADMIN PANEL</h1>
    <?php if(isset($admin)): ?>
        <a style="color:red;" href="admin/logout">Logout</a>
    <?php endif; ?>
    <!-- if  session is on - no need to show the login form -->
<?php if(!isset($admin)){ ?>
    <form action="" method="POST">
        <h3>Login</h3>
        <!-- if there is an invalid login detail entered -->
        <?php
        if(isset($_GET['error'])){
            echo "<p class='error' style='margin:0; text-align:center'>Try again! Invalid username or password</p>";
        }
        ?>
        <label for="username">Username<br>
            <input type="text" name="username" required>
        </label>
        <br>
        <label for="password">Password<br>
            <input type="password" name="password" required>
        </label><br>
        <input type="submit" name="submit" value="Login">
    </form>
<!-- end if statement -->
<?php
} else{

    echo "<h3>Your Projects</h3>";
    echo "<div><a href='" . getURL() . "/add'>Add Project</a></div>";

    
    if(count($projects) > 0){
        echo "<table border=1>";
        echo "<tr>";
            echo "<th>Title</th>";
            echo "<th>Date Posted</th>";
            echo "<th>Date Modified</th>";
            echo "<th>Action</th>";
        echo "</tr>";
        foreach($projects as $project){
            echo "<tr>";
                echo "<td>" . $project->title . "</td>";
                echo "<td>" . date('d/m/Y h:i A', strtotime($project->date_posted)) . "</td>";
                echo "<td>" . date('d/m/Y h:i A', strtotime($project->date_modified)). "</td>";
                echo "<td style='display:flex; flex-direction:column; '>";
                    echo "<a href='" . getURL() . "/edit/" . $project->slug . "'>Edit</a>";
                    echo "<a href='" . ROOT . "project/" . $project->slug . "'>Read</a>";
                    echo "<a href='" . getURL() . "/delete/" . $project->slug . "'>Delete</a>";
                echo "</td>";
                
            echo "</tr>";
            
        }
        echo "</table>";
    }

?>


<?php
}
?>
</main>

 
<?php
require('include/footer.php');
?> 