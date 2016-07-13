<?php

function oui_prefs_cat_file_list($name, $val)
{
    $rs = getTree('root', 'file');

    if ($rs)
    {
        return treeSelectInput($name,$rs,$val);
    }

    return gtxt('no_categories_exist');
}
