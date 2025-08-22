<?php
$headTitle = "Add New Project";
require('include/header.php');
?>

<style>
    .edit-form-container {
        max-width: 600px;
        margin: 2rem auto;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        padding: 2rem 2.5rem;
    }
    .edit-form-container label {
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 0.5rem;
        display: block;
    }
    .edit-form-container input[type="text"],
    .edit-form-container input[type="url"],
    .edit-form-container input[type="file"],
    .edit-form-container textarea {
        width: 100%;
        padding: 0.7rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        background: #f7fafc;
        transition: border-color 0.2s;
    }
    .edit-form-container input[type="text"]:focus,
    .edit-form-container input[type="url"]:focus,
    .edit-form-container textarea:focus {
        border-color: #3182ce;
        outline: none;
    }
    .edit-form-container input[type="radio"] {
        margin-right: 0.5rem;
    }
    .edit-form-container input[type="submit"] {
        background: #3182ce;
        color: #fff;
        font-weight: bold;
        padding: 0.8rem 2rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        margin-top: 1rem;
        transition: background 0.2s;
    }
    .edit-form-container input[type="submit"]:hover {
        background: #2563eb;
    }
    .edit-form-container h2 {
        text-align: center;
        color: #3182ce;
        margin-bottom: 2rem;
        font-size: 2rem;
        font-weight: 700;
    }
</style>

<div class="edit-form-container">
    <h2>Add New Project</h2>
    <form action="" method="post" enctype="multipart/form-data" class="ckeditor_form">

        <label for="title">Title
            <input type="text" name="title">
        </label>
        
        <label for="image">Cover Image
            <input type="file" name="image" accept="image/*">
        </label>
        
        <label for="descr">Description
            <textarea name="descr" rows="3"></textarea>
        </label>

        <label for="proj_type">Project type</label>
        <div style="margin-bottom:1rem;">
            <input type="radio" name="proj_type" value="UI-UX" checked> UI/UX
            <input type="radio" name="proj_type" value="Web"> Web
        </div>

        <label for="visibility">Visibility</label>
        <div style="margin-bottom:1rem;">
            <input type="radio" name="visibility" value="1" checked> Visible
            <input type="radio" name="visibility" value="0"> Not Visible
        </div>

        <label for="design_link">Design File Link
            <input type="url" name="design_link">
        </label>

        <label for="live_site_link">Live Site Link
            <input type="url" name="live_site_link">
        </label>

        <label for="github_link">Github Repo Link
            <input type="url" name="github_link">
        </label>

        <label for="content">Content
            <textarea name="content" id="editor" rows="6"></textarea>
        </label>

        <input type="submit" name="submit" value="Create Project">
    </form>
</div>

<script>
    var configBaseDir = '<?php echo ROOT; ?>';
</script>
<script src="<?=ROOT?>scripts/ckeditor.js"></script>

<?php
require('include/footer.php');
?>
