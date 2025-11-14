<?php
function antiinjection($koneksi, $data)
{
    $filter_sql = pg_escape_string($koneksi, stripslashes(strip_tags(htmlspecialchars($data, ENT_QUOTES))));
    return $filter_sql;
}
?>