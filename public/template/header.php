<?php
function display_header() {
    include("head.php");
    echo <<<_END
    <!DOCTYPE html>
    <html lang="en">
    _END;
    display_head();
    echo <<<_END
    <body>
    <header>
        <h1>Kids Games</h1>
    </header>
    _END;
}
?>
