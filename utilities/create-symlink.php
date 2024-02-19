<?php
// Define paths
$target = '../storage/app/public/uploads';
$link = '../public/storage';

// Create symbolic link
if (!is_link($link)) {
    symlink($target, $link);
    echo 'Symbolic link created successfully.';
} else {
    echo 'Symbolic link already exists.';
}