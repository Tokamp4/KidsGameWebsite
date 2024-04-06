<?php
include("config.php");
create_database();
display_header();
display_navigation_menu();
?>
<body>
    <section>
        <h2>Featured Games</h2>
        <div>
            <h3>Sign up</h3>
            <button>
                <a href="src/features/signup.php">Sign up</a>
            </button>
        </div>
        <div>
            <h3>Sign in</h3>
            <button>
                <a href="src/features/signin.php" >Sign in</a>
            </button>
        </div>
    </section>
    <?php
    display_footer();
    ?>
</body>
</html>
