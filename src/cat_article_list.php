<?php

function oui_prefs_cat_article_list($name, $val)
{
    $rs = getTree('root', 'article', "title != 'default' ORDER BY id, title");

    if ($rs)
    {
        return treeSelectInput($name,$rs,$val);
    }

    return gtxt('no_categories_exist');
}
