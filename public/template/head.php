<?php
function display_head() {
    $css_file = "public/assets/css/style.css";
    echo <<<_END
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Game Website</title>
        <link rel="stylesheet" href="$css_file">
    </head>
    <?php
    _END;
}
?>
