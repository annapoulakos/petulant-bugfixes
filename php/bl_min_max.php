<?php
# *** Branchless min-max functions
# *** Only use on integers!
# *** You've been warned.
function _min ($a, $b) {
    $c = ($a - $b) >> 31;
    return (($a&$c)|($b&~$c));
}

function _max ($a, $b) {
    $c = ($a - $b) >> 31;
    return (($b&$c)|($a&~$c));
}
