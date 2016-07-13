<?php

function oui_prefs_cat_image_list($name, $val)
{
    $rs = getTree('root', 'image');

    if ($rs)
    {
        return treeSelectInput($name,$rs,$val);
    }

    return gtxt('no_categories_exist');
}
