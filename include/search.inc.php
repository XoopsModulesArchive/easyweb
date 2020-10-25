<?php

function easyweb_search($queryarray, $andor, $limit, $offset, $userid)
{
    global $xoopsDB;

    $sql = 'SELECT artid,title,content,weight FROM ' . $xoopsDB->prefix('eascont') . ' WHERE isactive=1';

    $count = count($queryarray);

    if ($count > 0 && is_array($queryarray)) {
        $sql .= " AND ((title LIKE '%$queryarray[0]%' OR content LIKE '%$queryarray[0]%')";

        for ($i = 1; $i < $count; $i++) {
            $sql .= " $andor ";

            $sql .= "(title LIKE '%$queryarray[$i]%' OR content LIKE '%$queryarray[$i]%')";
        }

        $sql .= ') ';
    }

    $sql .= 'ORDER BY weight DESC';

    $result = $xoopsDB->query($sql, $limit, $offset);

    $ret = [];

    $i = 0;

    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $ret[$i]['link'] = 'index.php?artid=' . $myrow['artid'] . '';

        $ret[$i]['title'] = $myrow['title'];

        $i++;
    }

    return $ret;
}
