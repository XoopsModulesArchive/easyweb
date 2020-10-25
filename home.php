<?php

include 'include/header.php';

$xoopsOption['use_smarty'] = 1;

global $xoopsDB, $xoopsOption;
$xoopsOption['show_rblock'] = 1;

if ('easyweb' == $xoopsConfig['startpage']) {
    $xoopsOption['show_rblock'] = 1;

    require XOOPS_ROOT_PATH . '/header.php';

    make_cblock();
} else {
    $xoopsOption['show_rblock'] = 0;

    require XOOPS_ROOT_PATH . '/header.php';
}
$content_startpage = [];
$content_startpage .= '<br>';
$content_startpage = "<link rel='stylesheet' type='text/css' media='all' href='" . XOOPS_URL . "/modules/easyweb/include/easyweb.css'>";
$myts = MyTextSanitizer::getInstance();
$result = $xoopsDB->query('select content from ' . $xoopsDB->prefix('easyweb_startpage') . " where id='1'");
[$content] = $xoopsDB->fetchRow($result);
$content = $myts->undoHtmlSpecialChars($content);
$content = $myts->xoopsCodeDecode($content);
$content_startpage .= $content;
$xoopsTpl->assign('content_startpage', $content_startpage);
$xoopsContentsTpl = 'startpage.html';
require_once XOOPS_ROOT_PATH . '/footer.php';
