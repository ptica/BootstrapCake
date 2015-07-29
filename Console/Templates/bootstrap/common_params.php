<?php

$include_id_column   = false;
$include_view_action = false;
$include_ord_field   = false;
$top_row_actions = true;
$datetime_format = '%-d.%-m.&nbsp;%Y';

if (!empty($this->params['include_id_column'])) {
    $include_id_column = true;
}

if (!empty($this->params['include_ord_field'])) {
    $include_ord_field = true;
}

if (!empty($this->params['include_view_action'])) {
    $include_view_action = true;
}

if (!empty($this->params['no_top_row_actions'])) {
    $top_row_actions = false;
}
