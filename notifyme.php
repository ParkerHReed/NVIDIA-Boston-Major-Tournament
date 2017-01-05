<?php
    $file = 'notifyme.txt';
    $current = file_get_contents($file);
    $current .= $_GET['who'];
    file_put_contents($file, $current);
    ?>
