<?php
    $headTitle = 'Admin Panel | Gbenga Opeyemi Portfolio';
    require "include/header.php";
?>

<style>
    main.md {
        max-width: 1000px;
        margin: 2rem auto;
        padding: 2rem;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        font-family: Arial, sans-serif;
    }

    main.md h1 {
        text-align: center;
        color: #2d3748;
        font-size: 2rem;
        margin-bottom: 1.5rem;
    }

    .logout-link {
        display: inline-block;
        color: #e53e3e;
        font-weight: bold;
        margin-bottom: 1rem;
        text-decoration: none;
    }
    .logout-link:hover {
        text-decoration: underline;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        padding: 2rem;
        background: #f9fafb;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    form h3 {
        text-align: center;
        margin-bottom: 1rem;
        color: #3182ce;
    }

    form label {
        display: block;
        margin-bottom: 1rem;
        font-weight: 600;
        color: #2d3748;
    }

    form input[type="text"],
    form input[type="password"] {
        width: 100%;
        padding: 0.6rem 0.8rem;
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        margin-top: 0.4rem;
        background: #fff;
        transition: border 0.2s;
    }
    form input[type="text"]:focus,
    form input[type="password"]:focus {
        border-color: #3182ce;
        outline: none;
    }

    form input[type="submit"] {
        display: block;
        width: 100%;
        padding: 0.8rem;
        background: #3182ce;
        color: #fff;
        font-weight: bold;
        border: none;
        border-radius: 8px;
        margin-top: 1rem;
        cursor: pointer;
        transition: background 0.2s;
    }
    form input[type="submit"]:hover {
        background: #2563eb;
    }

    .error {
        color: #e53e3e;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }

    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 2rem 0 1rem;
    }
    .projects-header h3 {
        margin: 0;
        color: #2d3748;
    }
    .projects-header a {
        background: #38a169;
        color: #fff;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: bold;
    }
    .projects-header a:hover {
        background: #2f855a;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 1rem;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    table th {
        background: #3182ce;
        color: #fff;
        text-align: left;
        padding: 0.8rem;
    }
    table td {
        padding: 0.8rem;
        border-bottom: 1px solid #e2e8f0;
    }
    table tr:nth-child(even) {
        background: #f9fafb;
    }

    .actions {
        display: flex;
        gap: 0.5rem;
    }
    .actions a {
        padding: 0.3rem 0.8rem;
        border-radius: 6px;
        font-size: 0.9rem;
        text-decoration: none;
        font-weight: bold;
    }
    .actions a:nth-child(1) {
        background: #3182ce; color: #fff;
    }
    .actions a:nth-child(1):hover {
        background: #2563eb;
    }
    .actions a:nth-child(2) {
        background: #718096; color: #fff;
    }
    .actions a:nth-child(2):hover {
        background: #4a5568;
    }
    .actions a:nth-child(3) {
        background: #e53e3e; color: #fff;
    }
    .actions a:nth-child(3):hover {
        background: #c53030;
    }
</style>

<main class="md">
    <h1>ADMIN PANEL</h1>

    <?php if(isset($admin)): ?>
        <a class="logout-link" href="admin/logout">Logout</a>
    <?php endif; ?>

    <?php if(!isset($admin)){ ?>
        <form action="" method="POST">
            <h3>Login</h3>
            <?php if(isset($_GET['error'])): ?>
                <p class="error">Try again! Invalid username or password</p>
            <?php endif; ?>

            <label for="username">Username
                <input type="text" name="username" required>
            </label>

            <label for="password">Password
                <input type="password" name="password" required>
            </label>

            <input type="submit" name="submit" value="Login">
        </form>
    <?php } else { ?>
        <div class="projects-header">
            <h3>Your Projects</h3>
            <a href="<?php echo getURL(); ?>/add">+ Add Project</a>
        </div>

        <?php if(count($projects) > 0){ ?>
            <table>
                <tr>
                    <th>Title</th>
                    <th>Date Posted</th>
                    <th>Date Modified</th>
                    <th>Action</th>
                </tr>
                <?php foreach($projects as $project){ ?>
                    <tr>
                        <td><?php echo $project->title; ?></td>
                        <td><?php echo date('d/m/Y h:i A', strtotime($project->date_posted)); ?></td>
                        <td><?php echo date('d/m/Y h:i A', strtotime($project->date_modified)); ?></td>
                        <td>
                            <div class="actions">
                                <a href="<?php echo getURL(); ?>/edit/<?php echo $project->slug; ?>">Edit</a>
                                <a href="<?php echo ROOT; ?>project/<?php echo $project->slug; ?>">Read</a>
                                <a href="<?php echo getURL(); ?>/delete/<?php echo $project->slug; ?>">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } ?>
    <?php } ?>
</main>

<?php require('include/footer.php'); ?>
