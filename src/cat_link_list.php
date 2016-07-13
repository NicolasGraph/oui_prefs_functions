<?php

function oui_prefs_cat_link_list($name, $val)
{
    $rs = getTree('root', 'link');

    if ($rs)
    {
        return treeSelectInput($name,$rs,$val);
    }

    return gtxt('no_categories_exist');
}
