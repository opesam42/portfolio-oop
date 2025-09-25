<?php

$headTitle = "Edit " . $row['title'];
require('include/header.php');

$contentSanitized = "<p>" . preg_replace("/\n/", "</p><p>", $row['content']);
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
    .edit-form-container img {
        border-radius: 8px;
        margin-bottom: 1rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
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
    <h2>Edit Project</h2>
    <form action="" method="post" enctype="multipart/form-data" class="ckeditor_form">        
        <label for="title">Title
            <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>">
        </label>
        
        <?php if ($row['cover_image']) { ?>
            <label for="current_image">Current Cover Image</label>
            <img src="<?php echo append_b2_base_url(htmlspecialchars($row['cover_image'])); ?>" alt="Cover Image" style="width:200px; height:auto;">
        <?php } ?>
        
        <label for="image">Cover Image
            <input type="file" name="cover_image" accept="image/*">
        </label>
        
        <label for="descr">Description
            <textarea name="descr" rows="3"><?php echo htmlspecialchars($row['description']); ?></textarea>
        </label>

        <label for="proj_type">Project type</label>
        <div style="margin-bottom:1rem;">
            <?php foreach ($proj_cats as $proj_cat): ?>
                <label>
                    <input type="radio" name="proj_type" value="<?= htmlspecialchars($proj_cat->id) ?>"
                        <?= ($proj_cat->id == $row['project_category_id']) ? 'checked' : '' ?>>
                    <?= htmlspecialchars($proj_cat->name) ?>
                </label><br>
            <?php endforeach; ?>
        </div>

        <label for="visibility">Visibility</label>
        <div style="margin-bottom:1rem;">
            <input type="radio" name="visibility" value="1" <?php if($row['is_visible']==1) echo 'checked'; ?>> Visible
            <input type="radio" name="visibility" value="0" <?php if($row['is_visible']==0) echo 'checked'; ?>> Not Visible
        </div>

        <label for="design_link">Design File Link
            <input type="url" name="design_link" value="<?php echo htmlspecialchars($row['design_link']); ?>">
        </label>

        <label for="live_site_link">Live Site Link
            <input type="url" name="live_site_link" value="<?php echo htmlspecialchars($row['live_site_link']); ?>">
        </label>

        <label for="github_link">Github Repo Link
            <input type="url" name="github_link" value="<?php echo htmlspecialchars($row['github_link']); ?>">
        </label>

        <label for="content">Content
            <textarea name="content" id="editor" rows="6"><?php echo htmlspecialchars($row['content']); ?></textarea>
        </label>
        
        <input type="submit" name="submit" value="Update">
    </form>
</div>

<script>
    var configBaseDir = '<?=ROOT?>';
    console.log(configBaseDir);
</script>
<script src="<?=ROOT?>scripts/ckeditor.js"></script>

<?php
require('include/footer.php');
?>