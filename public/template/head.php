<?php
function display_head() {
    $document_root = $_SERVER['DOCUMENT_ROOT'];
    $css_file = "/public/assets/css/styles.css";
    echo <<<_END
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Your Game Website</title>
        <link rel="stylesheet" href="$document_root$css_file">
    </head>
    <?php
    _END;
}
?>
