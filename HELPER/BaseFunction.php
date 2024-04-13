<?php
function formatMoney($amount) {
    // Format the number with dot (.) as thousands separator and comma (,) as decimal separator
    return number_format($amount, 0, ',', '.');
}

function roundToNearestTenth($num) {
    return round($num, 1);
}