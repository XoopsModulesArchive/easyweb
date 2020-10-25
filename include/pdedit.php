<?php

$display_font = 'Verdana, Helvetica';
$display_size = 'xx-small';
echo "<html>\n";
echo "<head>\n";
echo "<style type=\"text/css\">\n";
echo "body {\n";
echo "margin: 0pt;\n";
echo "padding: 0pt;\n";
echo "border: none;\n";
echo "}\n";
echo "\n";
echo "iframe {\n";
echo "width: 100%;\n";
echo "height: 100%;\n";
echo "border: none;\n";
echo "}\n";
echo "</style>\n";
echo "<script type=\"text/javascript\">\n";

echo "var format=\"HTML\"\n";
echo "\n";
echo "function setFont() {\n";
echo "textEdit.document.body.style.fontFamily = \"$display_font\";\n";
echo "textEdit.document.body.style.fontSize = \"$display_size\";\n";
echo "}\n";
echo "\n";
echo "function setFocus() {\n";
echo "textEdit.focus();\n";
echo "}\n";
echo "\n";
echo "function execCommand(command) {\n";
echo "textEdit.focus();\n";
echo "\n";
echo "if (format==\"HTML\") {\n";
echo "var edit = textEdit.document.selection.createRange();\n";
echo "\n";
echo "if (arguments[1]==null) {\n";
echo "edit.execCommand(command);\n";
echo "\n";
echo "} else {\n";
echo "edit.execCommand(command,false, arguments[1]);\n";
echo "edit.select();\n";
echo "textEdit.focus();\n";
echo "}}}\n";
echo "\n";
echo "function selectAllText(){\n";
echo "var edit = textEdit.document;\n";
echo "edit.execCommand('SelectAll');\n";
echo "textEdit.focus();\n";
echo "}\n";
echo "\n";
echo "function newDocument() {\n";
echo "textEdit.document.open();\n";
echo "textEdit.document.write(\"\");\n";
echo "textEdit.document.close();\n";
echo "textEdit.focus();\n";
echo "}\n";
echo "\n";
echo "function initEditor() {\n";
echo "var htmlString = parent.document.all.$textareaname.value;\n";
echo "textEdit.document.designMode=\"On\";\n";
echo "textEdit.document.open();\n";
echo "textEdit.document.write(htmlString);\n";
echo "textEdit.document.close();\n";
echo "setFont();\n";
echo "textEdit.focus();\n";
echo "}\n";
echo "\n";
echo "function swapModes() {\n";
echo "if (format==\"HTML\") {\n";
echo "textEdit.document.body.innerText = textEdit.document.body.innerHTML;\n";
echo "format=\"Text\";\n";
echo "\n";
echo "} else {\n";
echo "textEdit.document.body.innerHTML = textEdit.document.body.innerText;\n";
echo "format=\"HTML\";\n";
echo "}\n";
echo "var s = textEdit.document.body.createTextRange();\n";
echo "s.collapse(false);\n";
echo "s.select();\n";
echo "textEdit.focus();\n";
echo "}\n";
echo "\n";
echo "window.onload = initEditor;\n";
echo "</script>\n";
echo "</head>\n";
echo "\n";
echo "<body scroll=\"No\">\n";
echo "<iframe id=\"textEdit\"></iframe>\n";
echo "</body>\n";
echo '</html>';