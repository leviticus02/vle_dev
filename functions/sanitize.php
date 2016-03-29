<?php
require_once __DIR__ . '/../core/init.php';

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}