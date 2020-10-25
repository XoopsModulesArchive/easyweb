<?php

require_once '../include/wysiwygeditor.php';
include 'admin_header.php';
/*********************************************************/
/* Startpage Manager Functions                            */
/*********************************************************/

function startpage()
{
    global $xoopsDB, $xoopsConfig, $xoopsModule, $conttex;

    $myts = MyTextSanitizer::getInstance();

    xoops_cp_header();

    $result = $xoopsDB->query('select id,content from ' . $xoopsDB->prefix('easyweb_startpage') . " where id='1'");

    [$id, $content] = $xoopsDB->fetchRow($result);

    $content = htmlspecialchars($content, ENT_QUOTES | ENT_HTML5);

    OpenTable();

    echo '<h3>' . _MD_STARTPAGE . "</h3><br>\n";

    echo '<b>' . _MD_MAKESTARTPAGE . "</b><br>\n";

    echo "<br>\n";

    echo "<form action='startpage.php' method='post'>";

    global $HTTP_SERVER_VARS, $xoopsConfig;

    $agent = $HTTP_SERVER_VARS[HTTP_USER_AGENT];

    if (preg_match('/(MSIE [0-9])/i', $agent, $result) && !preg_match('Opera', $agent)) {
        if (preg_match('/([0-9])/i', $result[0], $result1) && $result1[0] >= 5) {
            $conttex = $content;

            html_editor('content');
        }
    } else {
        echo "<textarea class=textbox name='content' cols='60' rows='10'>$content</textarea><br><br>\n";
    }

    echo "<input type='hidden' name='op' value='save'>";

    echo "<input type='hidden' name='id' value='$id'>";

    echo "<table border='0'><tr><td>";

    echo "<input type='submit' value='" . _MD_SAVECHANGES . "'>";

    echo "</form></td></tr></table>\n";

    CloseTable();
}

function save($id, $content)
{
    global $xoopsDB;

    if (!$id) {
        $myts = MyTextSanitizer::getInstance();

        $content = $myts->addSlashes($content);

        make($content);

        exit();
    }

    $myts = MyTextSanitizer::getInstance();

    $content = $myts->addSlashes($content);

    $xoopsDB->query('update ' . $xoopsDB->prefix('easyweb_startpage') . " set content='$content' where id='1'");

    redirect_header('startpage.php?op=startpage', 2, _MD_DBUPDATED);

    exit();
}

function make($content)
{
    global $xoopsDB;

    $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('easyweb_startpage') . " set id='1',content='$content'");

    redirect_header('startpage.php?op=startpage', 2, _MD_DBUPDATED);

    exit();
}

switch ($op) {
    default:
        startpage();
        break;
    case 'save':
        save($id, $content);
        break;
}
xoops_cp_footer();
