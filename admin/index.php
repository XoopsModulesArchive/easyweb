<?php

require_once '../include/wysiwygeditor.php';
include 'admin_header.php';

/*********************************************************/
/* Sections Manager Functions                            */
/*********************************************************/

function easytions()
{
    echo "<csscriptdict>\n";

    echo "        <script><!--\n";

    echo "CSAg = window.navigator.userAgent; CSBVers = parseInt(CSAg.charAt(CSAg.indexOf(\"/\")+1),10);\n";

    echo "function IsIE() { return CSAg.indexOf(\"MSIE\") > 0;}\n";

    echo "function CSIEStyl(s) { return document.all.tags(\"div\")[s].style; }\n";

    echo "function CSNSStyl(s) { return CSFindElement(s,0); }\n";

    echo "function CSFindElement(n,ly) { if (CSBVers < 4) return document[n];\n";

    echo "        var curDoc = ly ? ly.document : document; var elem = curDoc[n];\n";

    echo "        if (!elem) { for (var i=0;i<curDoc.layers.length;i++) {\n";

    echo "                elem = CSFindElement(n,curDoc.layers[i]); if (elem) return elem; }}\n";

    echo "        return elem;\n";

    echo "}\n";

    echo "function CSURLPopupShow(formName, popupName, target) {\n";

    echo "        var form  = CSFindElement(formName);\n";

    echo "        var popup = form.elements[popupName];\n";

    echo "        window.open(popup.options[popup.selectedIndex].value, target);\n";

    echo "        popup.selectedIndex = 0;\n";

    echo "}\n";

    echo "\n";

    echo "// --></script>\n";

    echo '</csscriptdict>';

    global $xoopsConfig, $xoopsDB, $xoopsModule, $checked, $co;

    xoops_cp_header();

    $result = $xoopsDB->query('select easyid, easyname from ' . $xoopsDB->prefix('easyweb') . ' order by easyid');

    if ($xoopsDB->getRowsNum($result) > 0) {
        $myts = MyTextSanitizer::getInstance();

        OpenTable();

        echo '<h4>' . _MD_CURACTIVEEASY . '<h4><br><table border=0 width=100% align=center cellpadding=1><tr><td align=center>';

        echo "<csobj w=\"154\" h=\"24\" t=\"URLPopup\" data='{ 0 = { label = &quot;Choose...&quot;; selected = &quot;YES&quot;; };";

        $co = 1;

        while (list($easyid, $easyname) = $xoopsDB->fetchRow($result)) {
            $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

            echo "$co = { label = &quot;" . $easyname . '&quot;; url = &quot;index.php?op=easytionedit&easyid=' . $easyid . ';; }; ';

            $co++;
        }

        echo " }' target=\"_self\">\n";

        echo "<form method=\"POST\" name=\"cs_form_name_0\">\n";

        echo "<select name=\"cs_popup_name_0\" onchange=\"CSURLPopupShow(/*CMP*/'cs_form_name_0', /*CMP*/'cs_popup_name_0', '_self');\">\n";

        echo '<option value="#" selected>' . _MD_CLICK2EDIT . '.....';

        $result2 = $xoopsDB->query('select easyid, easyname from ' . $xoopsDB->prefix('easyweb') . ' order by easyid');

        while (list($easyid, $easyname) = $xoopsDB->fetchRow($result2)) {
            $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

            echo '<option value="index.php?op=easytionedit&easyid=' . $easyid . '">' . $easyname . "\n";
        }

        echo "</select>\n";

        echo "</form>\n";

        echo '</csobj>';

        echo '</td></tr></table>';

        CloseTable();

        echo '<br>';

        OpenTable();

        echo '<h4>' . _MD_ADDARTICLE . "</h4><br><br>\n";

        echo "<form action='index.php' method='post'>";

        echo '<br>';

        echo '<b>' . _MD_TITLEC . '</b><br>';

        echo "<input class=textbox type='text' name='title' size='60' value=''><br><br>\n";

        echo '<b>' . _MD_TITLEC_URL . '</b> ' . _MD_MAXCHAR16 . '<br>';

        echo "<input class=textbox type='text' name='url_title' size='16' value=''><br><br>\n";

        $checked = 1;

        echo "<select name='easyid' size='4'>";

        $result = $xoopsDB->query('select easyid, easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . ' order by weight');

        while (list($easyid, $easyname, $weight, $isactive) = $xoopsDB->fetchRow($result)) {
            $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

            global $checked;

            if (1 == $isactive) {
                if (1 == $checked) {
                    echo "<option value='$easyid' selected>$easyname";
                } else {
                    echo "<option value='$easyid'>$easyname";
                }

                $checked = 0;
            }
        }

        echo "</select><br>\n";

        echo '<br><b>' . _MD_CONTENTC . "</b><br><br>\n";

        global $HTTP_SERVER_VARS, $xoopsConfig;

        $agent = $HTTP_SERVER_VARS[HTTP_USER_AGENT];

        if (preg_match('/(MSIE [0-9])/i', $agent, $result) && !preg_match('Opera', $agent)) {
            if (preg_match('/([0-9])/i', $result[0], $result1) && $result1[0] >= 5) {
                html_editor('content');
            }
        } else {
            echo "<textarea class=textbox name='content' cols='60' rows='10'></textarea><br><br>\n";
        }

        echo '<br><br><b>';

        echo _MD_POS;

        echo '</b>';

        echo "<input class=textbox type='text' name='weight' size='2' value='0'><br><br>\n";

        echo '<b>' . _MD_ISACTIVE . "</b><input type='checkbox' value='1' name='isactive' checked><br><br>\n";

        echo "<input type='hidden' name='op' value='easyarticleadd'>";

        echo "<input type='submit' value='" . _MD_DOADDARTICLE . "'></form>\n";

        CloseTable();

        echo "<br>\n";

        OpenTable();

        echo "<form method=POST action=index.php enctype=multipart/form-data>\n";

        echo '<p>' . _MD_FILESTOUPLOAD . "<br>\n";

        echo "<input type=file name=img1 size=30><br>\n";

        echo "<input type=file name=img2 size=30><br>\n";

        echo "<input type=file name=img3 size=30><br>\n";

        echo "<input type=file name=img4 size=30><br>\n";

        echo "<input type=file name=img5 size=30><br>\n";

        echo '<input type="submit" name="submit" value="' . _MD_UPLOAD . "\"> \n";

        echo "<input type='hidden' name='op' value='upload'>";

        echo "</form>\n";

        echo "<br>\n";

        CloseTable();

        echo "<br>\n";

        OpenTable();

        echo '<h4>' . _MD_LAST20ART . '</h4><br><br><ul>';

        $result = $xoopsDB->query('select artid, easyid, title from ' . $xoopsDB->prefix('eascont') . ' order by artid desc', 20, 0);

        while (list($artid, $easyid, $title) = $xoopsDB->fetchRow($result)) {
            $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

            $result2 = $xoopsDB->query('select easyid, easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . " where easyid='$easyid'");

            [$easyid, $easyname, $weight, $isactive2] = $xoopsDB->fetchRow($result2);

            $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

            if (1 == $isactive2) {
                echo "<li>$title ($easyname) [ <a href=index.php?op=easyartedit&artid=$artid>" . _MD_EDIT . '</a> ]';
            }
        }

        echo '</ul>';

        echo "<form action='index.php' method='post'>";

        echo _MD_EDITARTID;

        echo "<input class='textbox' type='text' NAME='artid' SIZE='10'><br><br>\n";

        echo "<input type='hidden' name='op' value='easyartedit'>";

        echo "<input type='submit' value='" . _MD_GO . "'></form>";

        CloseTable();
    }

    echo '<br>';

    OpenTable();

    echo '<h4>' . _MD_ADDNEWEASY . "</h4><br><br>\n";

    echo "<form action='index.php' method='post'>";

    echo '<br>';

    echo '<b>' . _MD_EASYNAMEC . '</b>  ' . _MD_MAXCHAR16 . '<br>';

    echo "<input class='textbox' type='text' name='easyname' size='30' maxlength='16'><br><br>\n";

    echo '<b>' . _MD_POSG . '</b>';

    echo "<input class='textbox' type='text' name='weight' size='2' value='0'><br><br>";

    echo '<b>' . _MD_GROUPISACTIVE . "</b><input type='checkbox' value='1' name='isactive' checked><br><br>\n";

    echo "<input type='hidden' name='op' value='easytionmake'>";

    echo "<input type='submit' value='" . _MD_GOADDEASYTION . "'></form>";

    CloseTable();
}

function easyarticleadd($easyid, $url_title, $title, $content, $weight, $isactive)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $title = $myts->addSlashes($title);

    $content = $myts->addSlashes($content);

    $newid = $xoopsDB->genId($xoopsDB->prefix('eascont') . '_artid_seq');

    $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('eascont') . " (artid, easyid, url_title, title, content, counter,weight,isactive) VALUES ($newid,$easyid,'$url_title','$title','$content','0','$weight','$isactive')");

    redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

    exit();
}

function easyartedit($artid)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule, $conttex;

    $myts = MyTextSanitizer::getInstance();

    xoops_cp_header();

    $result = $xoopsDB->query('select artid, easyid,url_title,title,content,weight,isactive from ' . $xoopsDB->prefix('eascont') . " where artid='$artid'");

    [$artid, $easyid, $url_title, $title, $content, $weight, $isactive] = $xoopsDB->fetchRow($result);

    $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

    $content = htmlspecialchars($content, ENT_QUOTES | ENT_HTML5);

    OpenTable();

    echo '<h4>' . _MD_EDITARTICLE . "</h4><br><br>\n";

    echo "<form action='index.php' method='post'>";

    echo '<br>';

    echo '<b>' . _MD_TITLEC . '</b><br>';

    echo "<input class='textbox' type='text' name='title' size='60' value='$title'><br><br>\n";

    echo '<b>' . _MD_TITLEC_URL . '</b> ' . _MD_MAXCHAR16 . '<br>';

    echo "<input class='textbox' type='text' name='url_title' size='16' value='$url_title'><br><br>\n";

    echo "<select name='easyid' size='4'>";

    $result2 = $xoopsDB->query('select easyid, easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . ' order by weight');

    while (list($easyid2, $easyname, $weight3, $isactive3) = $xoopsDB->fetchRow($result2)) {
        $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

        if ($easyid2 == $easyid) {
            $che = 'selected';
        }

        if (1 == $isactive3) {
            echo "<option value='$easyid2' $che>$easyname";
        }

        $che = '';
    }

    echo '</select><br>';

    echo '<br>';

    echo '<b>' . _MD_CONTENTC . "</b><br>\n";

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

    echo '<br><br><b>' . _MD_POS . '</b>';

    echo "<input class='textbox' type='text' name='weight' size='2' value='$weight'><br><br>\n";

    echo '<b>' . _MD_ISACTIVE . "</b><input type='checkbox' value='1' name='isactive'";

    if (1 == $isactive) {
        echo 'checked';
    }

    echo "><br><br>\n";

    echo "<input type='hidden' name='artid' value='$artid'>";

    echo "<input type='hidden' name='op' value='easyartchange'>";

    echo "<table border='0'><tr><td>";

    echo "<input type='submit' value='" . _MD_SAVECHANGES . "'>";

    echo '</form></td><td>';

    echo "<form action='index.php' method='post'>";

    echo "<input type='hidden' name='artid' value='$artid'>";

    echo "<input type='hidden' name='op' value='easyartdelete'>";

    echo "<input type='submit' value='" . _MD_DELETE . "'>";

    echo "</form></td></tr></table>\n";

    CloseTable();
}

function easytionmake($easyname, $weight, $isactive)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $easyname = $myts->addSlashes($easyname);

    $newid = $xoopsDB->genId($xoopsDB->prefix('easyweb') . '_easyid_seq');

    $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('easyweb') . " (easyid, easyname, weight, isactive) VALUES ($newid,'$easyname','$weight','$isactive')");

    redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

    exit();
}

function easytionedit($easyid)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    xoops_cp_header();

    $myts = MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('select easyid, easyname,weight,isactive from ' . $xoopsDB->prefix('easyweb') . " where easyid=$easyid");

    [$easyid, $easyname, $weight, $isactive] = $xoopsDB->fetchRow($result);

    $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

    $result2 = $xoopsDB->query('select artid from ' . $xoopsDB->prefix('eascont') . " where easyid=$easyid");

    $number = $xoopsDB->getRowsNum($result2);

    OpenTable();

    echo '<h4>';

    printf(_MD_EDITTHISEASY, $easyname);

    echo '</h4><br>';

    $help = sprintf(_MD_THISEASYHAS, $number);

    echo (string)$help;

    echo '<br><br>';

    echo "<form action='index.php' method='post'>";

    echo '<br>';

    echo '<b>' . _MD_EASYNAMEC . '</b> ' . _MD_MAXCHAR16 . "<br>\n";

    echo "<input class='textbox' type='text' name='easyname' size='30' maxlength='16' value='$easyname'><br><br>\n";

    echo '<b>' . _MD_POSG . '</b>';

    echo "<input class='textbox' type='text' name='weight' size='2' value='$weight'><br><br>\n";

    echo '<b>' . _MD_GROUPISACTIVE . "</b><input type='checkbox' value='1' name='isactive'";

    if (1 == $isactive) {
        echo 'checked';
    }

    echo "><br><br>\n";

    echo "<input type='hidden' name='easyid' value='$easyid'>";

    echo "<input type='hidden' name='op' value='easytionchange'>";

    echo "<table border='0'><tr><td>";

    echo "<INPUT type='submit' value='" . _MD_SAVECHANGES . "'>";

    echo '</form></td><td>';

    echo "<form action='index.php' method='post'>";

    echo "<input type='hidden' name='easyid' value='$easyid'>";

    echo "<input type='hidden' name='op' value='easytiondelete'>";

    echo "<INPUT type='submit' value='" . _MD_DELETE . "'>";

    echo "</form></td></tr></table>\n";

    CloseTable();
}

function easytionchange($easyid, $easyname, $weight, $isactive)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $easyname = $myts->addSlashes($easyname);

    $xoopsDB->query('update ' . $xoopsDB->prefix('easyweb') . " set easyname='$easyname', weight='$weight', isactive='$isactive' where easyid=$easyid");

    redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

    exit();
}

function easyartchange($artid, $easyid, $url_title, $title, $content, $weight, $isactive)
{
    global $xoopsDB;

    $myts = MyTextSanitizer::getInstance();

    $title = $myts->addSlashes($title);

    $content = $myts->addSlashes($content);

    $xoopsDB->query('update ' . $xoopsDB->prefix('eascont') . " set easyid='$easyid', url_title='$url_title', title='$title', content='$content', weight='$weight', isactive='$isactive' where artid=$artid");

    redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

    exit();
}

function easytiondelete($easyid, $ok = 0)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    if (1 == $ok) {
        $xoopsDB->query('delete from ' . $xoopsDB->prefix('eascont') . " where easyid='$easyid'");

        $xoopsDB->query('delete from ' . $xoopsDB->prefix('easyweb') . " where easyid='$easyid'");

        redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

        exit();
    }

    xoops_cp_header();

    $myts = MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('select easyname from ' . $xoopsDB->prefix('easyweb') . " where easyid=$easyid");

    [$easyname] = $xoopsDB->fetchRow($result);

    $easyname = htmlspecialchars($easyname, ENT_QUOTES | ENT_HTML5);

    OpenTable();

    echo "<h4 style='color:#ff0000;'>" . sprintf(_MD_DELETETHISEASY, $easyname) . '</h4><br>
         ' . _MD_RUSUREDELEASY . '<br>
         ' . _MD_THISDELETESALL . "<br><br>\n";

    echo "<table><tr><td>\n";

    echo myTextForm("index.php?op=easytiondelete&easyid=$easyid&ok=1", _MD_YES);

    echo "</td><td>\n";

    echo myTextForm('index.php?op=easytions', _MD_NO);

    echo "</td></tr></table>\n";

    CloseTable();
}

function easyartdelete($artid, $ok = 0)
{
    global $xoopsDB, $xoopsConfig, $xoopsModule;

    if (1 == $ok) {
        $xoopsDB->query('delete from ' . $xoopsDB->prefix('eascont') . " where artid='$artid'");

        redirect_header('index.php?op=easytions', 2, _MD_DBUPDATED);

        exit();
    }

    xoops_cp_header();

    $myts = MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('select title from ' . $xoopsDB->prefix('eascont') . " where artid=$artid");

    [$title] = $xoopsDB->fetchRow($result);

    $title = htmlspecialchars($title, ENT_QUOTES | ENT_HTML5);

    OpenTable();

    echo '<div><b>' . sprintf(_MD_DELETETHISART, $title) . '</b><br><br>
         ' . _MD_RUSUREDELART . "<br><br>\n";

    echo "<table><tr><td>\n";

    echo myTextForm("index.php?op=easyartdelete&artid=$artid&ok=1", _MD_YES);

    echo "</td><td>\n";

    echo myTextForm('index.php?op=easytions', _MD_NO);

    echo "</td></tr></table>\n";

    echo '</div>';

    CloseTable();
}

switch ($op) {
    default:
        easytions();
        break;
    case 'easytions':
        easytions();
        break;
    case 'easytionedit':
        easytionedit($easyid);
        break;
    case 'easytionmake':
        easytionmake($easyname, $weight, $isactive);
        break;
    case 'easytiondelete':
        easytiondelete($easyid, $ok);
        break;
    case 'easytionchange':
        easytionchange($easyid, $easyname, $weight, $isactive);
        break;
    case 'easyarticleadd':
        easyarticleadd($easyid, $url_title, $title, $content, $weight, $isactive);
        break;
    case 'easyartedit':
        easyartedit($artid);
        break;
    case 'easyartchange':
        easyartchange($artid, $easyid, $url_title, $title, $content, $weight, $isactive);
        break;
    case 'easyartdelete':
        easyartdelete($artid, $ok);
        break;
    case 'upload':
        include 'do_upload.php';
        break;
}
xoops_cp_footer();
