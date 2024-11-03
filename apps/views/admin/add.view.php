<?php
$headTitle = "Add New Project";
require('include/header.php');
?>

<form action="" method="post" enctype="multipart/form-data" class="ckeditor_form">
    <label for="title"> Title<br>
        <input type="text" name="title">
    </label><br>
    <label for="image">Cover Image <br>
        <input type="file" name="image" accept="image/*">
    </label><br>
    <label for="descr">Description<br>
        <textarea type="text" name="descr"></textarea>
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
        <input type="url" name="design_link">
    </label><br>

    <label for="live_site_link"> Live Site Link<br>
        <input type="url" name="live_site_link">
    </label><br>

    <label for="github_link"> Github Repo Link<br>
        <input type="url" name="github_link">
    </label><br>
    <label for="content">Content<br>
        <textarea name="content" id="editor" width="100%"></textarea>
    </label>
    <input type="submit" name="submit">
</form>

<script>
    var configBaseDir = '<?php echo ROOT; ?>';
</script>
<script src="<?=ROOT?>scripts/ckeditor.js"></script>

<?php
require('include/footer.php');
?>