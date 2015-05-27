<?php

$include_id_column   = false;
$include_view_action = false;

if (!empty($this->params['include_id_column'])) {
    $include_id_column = true;
}


if (!empty($this->params['include_view_action'])) {
    $include_view_action = true;
}
