<?php

//***************************************************************************//
// EasyWeb                                                                   //
// Jan Inge Pettersen (Xend) http://www.xendtech.com                         //
//                                                                           //
//                                                                           //
//                                                                           //
//                                                                           //
// The Credit of XOOPS is:                                                   //
// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:                                                                 //
// myPHPNUKE Web Portal System - http://myphpnuke.com/                       //
// PHP-NUKE Web Portal System - http://phpnuke.org/                          //
// Thatware - http://thatware.org/                                           //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //

if (!$artid) {
    header('Location: home.php');
}
include 'include/header.php';
$xoopsOption['use_smarty'] = 1;
include '../../header.php';
$content_text = [];
$content_text = "<link rel='stylesheet' type='text/css' media='all' href='include/easyweb.css'>";
global $xoopsConfig, $xoopsUser, $xoopsDB, $xoopsTheme;
$myts = MyTextSanitizer::getInstance();
$xoopsDB->queryF('update ' . $xoopsDB->prefix('eascont') . " set counter=counter+1 where artid='$artid'");
$result = $xoopsDB->query('select artid, easyid, title, content, counter from ' . $xoopsDB->prefix('eascont') . " where artid=$artid");
[$artid, $easyid, $title, $content, $counter] = $xoopsDB->fetchRow($result);
if (!$artid) {
    redirect_header(XOOPS_URL . '/', 3, _MD_NOEXIST);

    exit();
}
$content = $myts->undoHtmlSpecialChars($content);
$content = $myts->xoopsCodeDecode($content);

$result2 = $xoopsDB->query('select easyid, easyname from ' . $xoopsDB->prefix('easyweb') . " where easyid=$easyid");
[$easyid, $easyname] = $xoopsDB->fetchRow($result2);
$easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);
$words = substr_count($content, ' ') + 1;
/* Rip the article into pages. Delimiter string is "[pagebreak]"  */
$contentpages = explode('[pagebreak]', $content);
$pageno = count($contentpages);
/* Define the current page        */
if ('' == $page || $page < 1) {
    $page = 1;
}
if ($page > $pageno) {
    $page = $pageno;
}
$arrayelement = (int)$page;
$arrayelement--;
if ($page >= $pageno) {
    $xoopsTpl->assign('next_link', '');

    $xoopsTpl->assign('next_nav', '');
} else {
    $next_pagenumber = $page + 1;

    $xoopsTpl->assign('next_link', "index.php?artid=$artid&page=$next_pagenumber");

    $xoopsTpl->assign('next_nav', _MD_NEXTPAGE . ' ' . sprintf('(%s/%s)', $next_pagenumber, $pageno));
}
if ($page <= 1) {
    $previous_page = '';

    $xoopsTpl->assign('prev_link', '');

    $xoopsTpl->assign('prev_nav', '');
} else {
    $previous_pagenumber = $page - 1;

    $xoopsTpl->assign('prev_link', "index.php?artid=$artid&page=$previous_pagenumber");

    $xoopsTpl->assign('prev_nav', _MD_PREVPAGE . ' ' . sprintf('(%s/%s)', $previous_pagenumber, $pageno));
}
if ($xoopsUser && $xoopsUser->isAdmin($xoopsModule->mid())) {
    $xoopsTpl->assign('admin_link', XOOPS_URL . "/modules/easyweb/admin/index.php?op=easyartedit&artid=$artid");

    $xoopsTpl->assign('lang_edit', _EDIT);
} else {
    $xoopsTpl->assign('admin_link', '');

    $xoopsTpl->assign('lang_edit', '');
}
$content_text .= ($contentpages[$arrayelement]);
$xoopsTpl->assign('content_text', $content_text);
$xoopsContentsTpl = 'show.html';
require_once XOOPS_ROOT_PATH . '/footer.php';
