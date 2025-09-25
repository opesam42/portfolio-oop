<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- DESCRIPTION TAG -->
    <?php if( relURL() != 'project' ): ?>
            <meta name="description" content="Gbenga Opeyemi is a UI/UX designer and junior web developer. Open to freelancing opportunities to improve user experience and help businesses achieve their goals.">
    <?php else: ?>
            <meta name='description' content='" .$metaDescr . "'> 
    <?php endif; ?>


    <meta name="keywords" content="UI, UX, Web Designer, Web Developer, Portfolio, Gbenga, Opeyemi">
    <meta name="author" content="Gbenga Opeyemi">
    <meta name="robots" content="index, follow">

    <title><?php echo $headTitle; ?></title>
    <link rel="icon" src="<?php echo ROOT?>assets/favicon.png" type="image/png">

    <!-- add tailwind css -->
    <!-- <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet"> -->
    <!--font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,100..1000;1,9..40,100..1000&display=swap" rel="stylesheet">
    <!-- font awesome -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- preloaded image start  -->
    <link rel="preload" as="image" href="assets/dp_photo1.png">
    <link rel="preload" as="image" href="assets/Hand coding-pana.png">
    <link rel="preload" as="image" href="assets/dp.png">
    <!-- preloaded image end -->

        
        <?php if( relURL() == 'admin' ): ?>
            <!-- load CKEDITOR FOR EDITING CONTENT -->
            <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/43.1.1/ckeditor5.css" />
            <script src="https://cdn.ckeditor.com/ckeditor5/43.1.1/ckeditor5.umd.js"></script>

        <?php elseif( relURL() == 'project' || relURL() == 'contact' || relURL() == 'edit' || relURL('') == 'add' || relURL('') == 'admin' || relURL('') == 'about'): ?>
            <!-- load project css -->
            <link rel='stylesheet' href="<?=ROOT?>styles/proj.css" >
        
        <?php endif; ?>

        <!--main styles-->
        <link href="<?=ROOT?>styles/main.css" rel="stylesheet">
        <link href="<?=ROOT?>styles/output.css" rel="stylesheet">
</head>



<body>
        <!-- <section class="header-hero"> -->
            <header>
                <a href="<?php echo ROOT?>" class="logo">
                    <img src="<?php echo ROOT?>assets/dp.png" width="32px">
                    <span>Gbenga Opeyemi</span>
                </a>
                <nav>
                    <div class="mobile-header">
                        <a href="<?php echo ROOT?>" class="logo">
                            <img src="<?php echo ROOT?>assets/dp.png" width="32px">
                            <span>Gbenga Opeyemi</span>
                        </a>
                        <div class="toggle-bar close"><i class="fa-lg fa fa-close"></i></div>
                    </div>
                    <!-- <div class="main-nav"> -->
                        <a href="<?php echo ROOT?>">Home</a>
                        <a href="<?php echo ROOT . 'about'?>">About</a>
                        <!-- <a href="<?php echo ROOT . 'resume.php'?>">Resume</a> -->
                        <a href="<?php echo ROOT . 'contact'?>">Contact</a>
                    <!-- </div> -->
                </nav>
                <div class="toggle-bar open"><i class="fa-lg fa fa-bars"></i></div>
            </header>

            <!-- icon bar -->
            <div class="social-bar">
                <a href="https://www.facebook.com/ope.oluwagbemiga" target="_blank" rel="noopener noreferrer" aria-label="Visit my Facebook profile"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="https://github.com/opesam42" target="_blank" rel="noopener noreferrer" aria-label="Visit my GitHub profile"><i class="fa fa-github" aria-hidden="true"></i></a>
                <a href="https://wa.me/+2349057339147" target="_blank" rel="noopener noreferrer" aria-label="Chat via WhatsApp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                <a href="https://linkedin.com/in/opeyemi-oluwagbemiga-2ba61423b" target="_blank" rel="noopener noreferrer" aria-label="Connect via LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a href="mailto:gbengaopeyemi04@gmail.com" target="_blank" rel="noopener noreferrer" aria-label="Send a mail"><i class="fa fa-envelope" aria-hidden="true"></i></a>
            
            </div>
        <!-- </section> -->