<?php
function tgl($tgl) {
    return $tgl;
}
function uang($param) {
    if (is_numeric($param) && $param != 0) {
        if ($param < 0) {
            return "( " . number_format(abs($param), 2, ",", ".") . " )";
        } else {
            return number_format($param, 2, ",", ".");
        }
    }
}

