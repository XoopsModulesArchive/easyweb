<?php

function b_easyweb_show1($options)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule, $xoopsUser, $REQUEST_URI, $QUERY_STRING, $PHP_SELF;

    $block = [];

    $block['title'] = _EASYWEB_TITLE;

    $block['content'] = '';

    $content = '';

    $sublinks = [];

    $result1 = $xoopsDB->query('select easyid,easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . ' WHERE isactive=1 ORDER BY weight ASC');

    while (list($easyid, $easyname, $weight, $isactive) = $xoopsDB->fetchRow($result1)) {
        $result3 = $xoopsDB->query('select artid from ' . $xoopsDB->prefix('eascont') . " WHERE easyid=$easyid");

        [$artid] = $xoopsDB->fetchRow($result3);

        if (!$artid) {
        } else {
            $content .= "<div><b>$easyname</b></div>";

            $result2 = $xoopsDB->query('select artid,easyid,title,url_title,isactive from ' . $xoopsDB->prefix('eascont') . " WHERE isactive=1 and easyid=$easyid ORDER BY weight ASC");

            while (list($artid, $easyid, $title, $url_title, $isactive) = $xoopsDB->fetchRow($result2)) {
                $content .= "&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href='" . $xoopsConfig['xoops_url'] . "/modules/easyweb/?artid=$artid'>$url_title</a><br>";
            }
        }
    }

    $block['content'] = $content;

    return $block;
}

function b_easyweb_show2($options)
{
    global $xoopsDB;

    require XOOPS_ROOT_PATH . '/modules/system/cache/mainmenu.php';

    $block = [];

    $block['title'] = _MB_SYSTEM_MMENU;

    $block['content'] = $mainmenu;

    $block['content'] .= '<br>';

    $result1 = $xoopsDB->query('select easyid,easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . ' WHERE isactive=1 ORDER BY weight ASC');

    while (list($easyid, $easyname, $weight, $isactive) = $xoopsDB->fetchRow($result1)) {
        $result3 = $xoopsDB->query('select artid from ' . $xoopsDB->prefix('eascont') . " WHERE easyid=$easyid");

        [$artid] = $xoopsDB->fetchRow($result3);

        if (!$artid) {
        } else {
            $block['content'] .= "<strong><big>&middot;</big></strong>&nbsp;<b>$easyname</b><br>";

            $result2 = $xoopsDB->query('select artid,easyid,title,url_title,isactive from ' . $xoopsDB->prefix('eascont') . " WHERE isactive=1 and easyid=$easyid ORDER BY weight ASC");

            while (list($artid, $easyid, $title, $url_title, $isactive) = $xoopsDB->fetchRow($result2)) {
                $block['content'] .= "&nbsp;&nbsp;<strong><big>&middot;</big></strong>&nbsp;<a href='" . $xoopsConfig['xoops_url'] . "/modules/easyweb/?artid=$artid'>$url_title</a><br>";
            }
        }
    }

    return $block;
}
