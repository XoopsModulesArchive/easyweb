<?php

include 'admin_header.php';
switch ($op) {
    default:
        $mappe = 'cache/images/';
        $columns = 1; //How many images displayed per line
        echo "<DIV STYLE='text-align:center'><h4>" . _MD_GALINF . '</h4></DIV>';
        echo "<table border='1' width='100%' bgcolor='" . $xoopsTheme['bgcolor1'] . "'><tr>";
        $i = 0;
        $handle = opendir("../$mappe");
        while (false !== ($file = readdir($handle))) {
            if ('.' != $file && '..' != $file) {
                print '<td>';

                echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'><tr><td>";

                echo "<img src=../$mappe$file border=\"0\" Alt=\"$file\" align=\"left\" hspace=\"10\" vspace=\"10\">";

                echo "</td><td width='50%'>";

                echo "<img src=../$mappe$file border=\"0\" Alt=\"$file\" align=\"right\" hspace=\"10\" vspace=\"10\">";

                echo '</td></tr><tr><td align="left">';

                echo "<form action='images.php' method='post'>\n";

                echo '<input type="submit" name="submit" value="' . _MD_DELETE . "\"> \n";

                echo "<input type='hidden' name='op' value='deleteimage'>";

                echo "<input type='hidden' name='deleteimage' value='" . XOOPS_ROOT_PATH . "/modules/easyweb/$mappe$file'>";

                echo "<input type='hidden' name='file' value='$file'>";

                echo "</form>\n";

                echo "</td><td width='50%' align=\"right\"></td></tr></table>";

                ++$i;

                if ($i == $columns) {
                    print '</tr><tr>';

                    $i = 0;
                }
            }
        }
        closedir($handle);
        echo '</tr></table>';
        break;
    case 'deleteimage':
        global $deleteimage;
        if (file_exists((string)$deleteimage)) {
            unlink((string)$deleteimage);

            if (file_exists((string)$deleteimage)) {
                redirect_header('images.php', 3, _MD_IMGDELERROR);

                exit();
            }

            redirect_header('images.php', 1, '' . _MD_IMGDELOK . "<br><br><b>$file</b>");

            exit();
        }
        break;
}
