<?php

function sanitize_input ($input) {
    return htmlentities(strip_tags(trim($input)));
}

?>