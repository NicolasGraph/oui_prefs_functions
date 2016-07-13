<?php

function oui_prefs_category_list($name, $val)
{
    $rs = getTree('root', '');

    if ($rs)
    {
        return treeSelectInput($name,$rs,$val);
    }

    return gtxt('no_categories_exist');
}
