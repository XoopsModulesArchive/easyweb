<?php

include 'admin_header.php';
//////////...Xend :-)
function clean_filename($string)
{
    $string = eregi_replace("\.\.", '', $string);

    $string = eregi_replace("[^([:alnum:]|\.)]", '_', $string);

    return eregi_replace('_+', '_', $string);
}

$abpath = '../cache/images'; //Absolute path to where images are uploaded. No trailing slash
$sizelim = 'no'; //Do you want size limit, yes or no
$size = '2500000'; //What do you want size limited to be if there is one
//all image types to upload
$cert1 = 'image/pjpeg'; //Jpeg type 1
$cert2 = 'image/jpeg'; //Jpeg type 2
$cert3 = 'image/gif'; //Gif type
$cert4 = 'image/ief'; //Ief type
$cert5 = 'image/png'; //Png type
$cert6 = 'image/tiff'; //Tiff type
$cert7 = 'image/bmp'; //Bmp Type
$cert8 = 'image/vnd.wap.wbmp'; //Wbmp type
$cert9 = 'image/x-cmu-raster'; //Ras type
$cert10 = 'image/x-x-portable-anymap'; //Pnm type
$cert11 = 'image/x-portable-bitmap'; //Pbm type
$cert12 = 'image/x-portable-graymap'; //Pgm type
$cert13 = 'image/x-portable-pixmap'; //Ppm type
$cert14 = 'image/x-rgb'; //Rgb type
$cert15 = 'image/x-xbitmap'; //Xbm type
$cert16 = 'image/x-xpixmap'; //Xpm type
$cert17 = 'image/x-xwindowdump'; //Xwd type
$log = '';
//////////...Xend :-)
$img1_name = clean_filename($img1_name);
$img2_name = clean_filename($img2_name);
$img3_name = clean_filename($img3_name);
$img4_name = clean_filename($img4_name);
$img5_name = clean_filename($img5_name);
//begin upload 1
//checks if file exists
if ('' == $img1_name) {
    $log .= '' . _MD_NOUPLOAD1 . '<br>';
}
if ('' != $img1_name) {
    //checks if file exists

    if (file_exists("$abpath/$img1_name")) {
        $log .= '' . _MD_FILE1EXIST . '<br>';
    } else {
        //checks if files to big

        if (('yes' == $sizelim) && ($img1_size > $size)) {
            $log .= '' . _MD_FILE1TOOBIG . '<br>';
        } else {
            //Checks if file is an image

            if (($img1_type == $cert1)
                or ($img1_type == $cert2) or ($img1_type == $cert3) or ($img1_type == $cert4) or ($img1_type == $cert5) or ($img1_type == $cert6) or ($img1_type == $cert7) or ($img1_type == $cert8) or ($img1_type == $cert9) or ($img1_type == $cert10) or ($img1_type == $cert11) or ($img1_type == $cert12) or ($img1_type == $cert13) or ($img1_type == $cert14) or ($img1_type == $cert15) or ($img1_type == $cert16)
                or ($img1_type == $cert17)) {
                @copy($img1, "$abpath/$img1_name") or $log .= '' . _MD_NOCOPYSERVER1 . '<br>';

                if (file_exists("$abpath/$img1_name")) {
                    $log .= '' . _MD_FILE1UPLOADED . '<br>';
                }
            } else {
                $log .= '' . _MD_NOTIMAGES1 . '<br>';
            }
        }
    }
}
//Upload #2
//checks if file exists
if ('' == $img2_name) {
    $log .= '' . _MD_NOUPLOAD2 . '<br>';
}
if ('' != $img2_name) {
    //checks if file exists

    if (file_exists("$abpath/$img2_name")) {
        $log .= '' . _MD_FILE2EXIST . '<br>';
    } else {
        //checks if files to big

        if (('yes' == $sizelim) && ($img2_size > $size)) {
            $log .= '' . _MD_FILE2TOOBIG . '<br>';
        } else {
            //Checks if file is an image

            if (($img2_type == $cert1)
                or ($img2_type == $cert2) or ($img2_type == $cert3) or ($img2_type == $cert4) or ($img2_type == $cert5) or ($img2_type == $cert6) or ($img2_type == $cert7) or ($img2_type == $cert8) or ($img2_type == $cert9) or ($img2_type == $cert10) or ($img2_type == $cert11) or ($img2_type == $cert12) or ($img2_type == $cert13) or ($img2_type == $cert14) or ($img2_type == $cert15) or ($img2_type == $cert16)
                or ($img2_type == $cert17)) {
                @copy($img2, "$abpath/$img2_name") or $log .= '' . _MD_NOCOPYSERVER2 . '<br>';

                if (file_exists("$abpath/$img2_name")) {
                    $log .= '' . _MD_FILE2UPLOADED . '<br>';
                }
            } else {
                $log .= '' . _MD_NOTIMAGES2 . '<br>';
            }
        }
    }
}
//Upload #3
if ('' == $img3_name) {
    $log .= '' . _MD_NOUPLOAD3 . '<br>';
}
if ('' != $img3_name) {
    //checks if file exists

    if (file_exists("$abpath/$img3_name")) {
        $log .= '' . _MD_FILE3EXIST . '<br>';
    } else {
        //checks if files to big

        if (('yes' == $sizelim) && ($img3_size > $size)) {
            $log .= '' . _MD_FILE3TOOBIG . '<br>';
        }

        //Checks if file is an image

        if (($img3_type == $cert1)
            or ($img3_type == $cert2) or ($img3_type == $cert3) or ($img3_type == $cert4) or ($img3_type == $cert5) or ($img3_type == $cert6) or ($img3_type == $cert7) or ($img3_type == $cert8) or ($img3_type == $cert9) or ($img3_type == $cert10) or ($img3_type == $cert11) or ($img3_type == $cert12) or ($img3_type == $cert13) or ($img3_type == $cert14) or ($img3_type == $cert15) or ($img3_type == $cert16)
            or ($img3_type == $cert17)) {
            @copy($img3, "$abpath/$img3_name") or $log .= '' . _MD_NOCOPYSERVER3 . '<br>';

            if (file_exists("$abpath/$img3_name")) {
                $log .= '' . _MD_FILE3UPLOADED . '<br>';
            }
        } else {
            $log .= '' . _MD_NOTIMAGES3 . '<br>';
        }
    }
}
if ('' == $img4_name) {
    $log .= '' . _MD_NOUPLOAD4 . '<br>';
}
if ('' != $img4_name) {
    //checks if file exists

    if (file_exists("$abpath/$img4_name")) {
        $log .= '' . _MD_FILE4EXIST . '<br>';
    } else {
        //checks if files to big

        if (('yes' == $sizelim) && ($img4_size > $size)) {
            $log .= '' . _MD_FILE4TOOBIG . '<br>';
        } else {
            //Checks if file is an image

            if (($img4_type == $cert1)
                or ($img4_type == $cert2) or ($img4_type == $cert3) or ($img4_type == $cert4) or ($img4_type == $cert5) or ($img4_type == $cert6) or ($img4_type == $cert7) or ($img4_type == $cert8) or ($img4_type == $cert9) or ($img4_type == $cert10) or ($img4_type == $cert11) or ($img4_type == $cert12) or ($img4_type == $cert13) or ($img4_type == $cert14) or ($img4_type == $cert15) or ($img4_type == $cert16)
                or ($img4_type == $cert17)) {
                @copy($img4, "$abpath/$img4_name") or $log .= '' . _MD_NOCOPYSERVER4 . '<br>';

                if (file_exists("$abpath/$img4_name")) {
                    $log .= '' . _MD_FILE4UPLOADED . '<br>';
                }
            } else {
                $log .= '' . _MD_NOTIMAGES4 . '<br>';
            }
        }
    }
}
//Upload #5
if ('' == $img5_name) {
    $log .= '' . _MD_NOUPLOAD5 . '<br>';
}
if ('' != $img5_name) {
    //checks if file exists

    if (file_exists("$abpath/$img5_name")) {
        $log .= '' . _MD_FILE5EXIST . '<br>';
    } else {
        //checks if files to big

        if (('yes' == $sizelim) && ($img5_size > $size)) {
            $log .= '' . _MD_FILE5TOOBIG . '<br>';
        } else {
            //Checks if file is an image

            if (($img5_type == $cert1)
                or ($img5_type == $cert2) or ($img5_type == $cert3) or ($img5_type == $cert4) or ($img5_type == $cert5) or ($img5_type == $cert6) or ($img5_type == $cert7) or ($img5_type == $cert8) or ($img5_type == $cert9) or ($img5_type == $cert10) or ($img5_type == $cert11) or ($img5_type == $cert12) or ($img5_type == $cert13) or ($img5_type == $cert14) or ($img5_type == $cert15) or ($img5_type == $cert16)
                or ($img5_type == $cert17)) {
                @copy($img5, "$abpath/$img5_name") or $log .= '' . _MD_NOCOPYSERVER5 . '<br>';

                if (file_exists("$abpath/$img5_name")) {
                    $log .= '' . _MD_FILE5UPLOADED . '<br>';
                }
            } else {
                $log .= '' . _MD_NOTIMAGES5 . '<br>';
            }
        }
    }
}
redirect_header(XOOPS_URL . '/modules/easyweb/admin/', 4, $log);
exit();
