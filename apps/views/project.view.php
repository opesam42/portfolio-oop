<?php
$headTitle = $project['title'] . " | Case Study";
$metaDescr = $project['description'];
require('include/header.php');

?>

<main class="proj">
    <section class="heading">
        <h1><?php echo $project['title']; ?></h1>
        <img src="<?php echo $project['cover_image']; ?>" alt="Cover image for <?php echo $project['title']; ?>" width="100%" style="display:block">

        <?php if (isset($_SESSION['admin'])) { ?>
            <a href="<?php echo ROOT . "admin/edit/" . $project['slug']?>">Edit</a>
        <?php } ?>
    </section>

    <section id="post">
        <div class="links">
            <?php if (!empty($project['live_site_link'])) { ?>
                <div><i class="fa fa-link"></i><a href="<?php echo $project['live_site_link']; ?>" target="_blank"><?php echo $project['live_site_link']; ?></a></div>
            <?php } ?>
            <?php if (!empty($project['github_link'])) { ?>
                <div><i class="fa fa-github"></i><a href="<?php echo $project['github_link']; ?>" target="_blank">Github Repo</a></div>
            <?php } ?>
        </div>
        <?php echo $project['content']; ?>
    </section>
</main>

<aside class="case-studies">
    <h1 class="title-block">OTHER PROJECTS</h1>
    <div class="card-block">
        <?php foreach($otherProjects as $project): ?>
            <a class="card" href="<?=ROOT?>project/<?php echo $project->slug; ?>">
                <article>
                    <div class="img-wrapper">
                        <img src="<?php echo  $project->cover_image; ?>" alt="Cover image for <?php echo $project->title; ?>" width="100%">
                    </div>
                    <div class="detail">
                        <h3 class="proj-title"><?php echo $project->title; ?></h3>
                        <div class="tag">
                            <?php echo ($project->project_type == 'UI-UX') ? 'UI/UX' : 'Web Development'; ?>
                        </div>
                        <p class="descr"><?php echo $project->description; ?></p>
                    </div>
                </article>
            </a>
        <?php endforeach; ?>
    </div>
</aside>

<?php
require('include/footer.php');
?>
