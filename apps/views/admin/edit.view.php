<?php

$headTitle = "Edit " . $row['title'];
require('include/header.php');

$contentSanitized = "<p>" . preg_replace("/\n/", "</p><p>", $row['content']);
// echo $admin;
?>
<form action="" method="post" enctype="multipart/form-data" class="ckeditor_form">
    <input type="hidden" name="validproj" value="<?php echo $validproj; ?>">
    
    <label for="title"> Title<br>
        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
    </label><br>
    
    <?php if ($row['cover_image']) { ?>
        <label for="current_image">Current Cover Image <br>
            <img src="<?php echo ROOT . "uploads/cover/" . htmlspecialchars($row['cover_image']); ?>" alt="Cover Image" style="width:200px; height:auto;">
        </label><br>
    <?php } ?>
    
    <label for="image">Cover Image <br>
        <input type="file" name="image" accept="image/*">
    </label><br>
    
    <label for="descr">Description<br>
        <textarea type="text" name="descr"><?php echo htmlspecialchars($row['description']); ?></textarea>
    </label><br>

    <label for="proj_type">Project type<br>
        <input type="radio" name="proj_type" value="UI-UX" checked> UI/UX<br>
        <input type="radio" name="proj_type" value="Web"> Web
    </label>
    <label for="visibility">Visibility<br>
        <input type="radio" name="visibility" value="1" checked>Visible<br>
        <input type="radio" name="visibility" value="0">Not Visible
    </label>

    <label for="design_link"> Design File Link<br>
        <input type="url" name="design_link" value="<?php echo htmlspecialchars($row['design_link']); ?>">
    </label><br>

    <label for="live_site_link"> Live Site Link<br>
        <input type="url" name="live_site_link" value="<?php echo htmlspecialchars($row['live_site_link']); ?>">
    </label><br>

    <label for="github_link"> Github Repo Link<br>
        <input type="url" name="github_link" value="<?php echo htmlspecialchars($row['github_link']); ?>">
    </label><br>

    <label for="content">Content<br>
        <textarea name="content" id="editor" width="100%"><?php echo htmlspecialchars($contentSanitized); ?></textarea>
    </label>
    
    <input type="submit" name="submit" value="Update">
</form>

<script>
    var configBaseDir = '<?=ROOT?>';
    console.log(configBaseDir);
</script>
<script src="<?=ROOT?>scripts/ckeditor.js"></script>

<?php

require('include/footer.php');
?>
