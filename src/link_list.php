<?php

function oui_prefs_link_list($name, $val)
{
    $links = safe_rows("title, id", 'textpattern', "title != 'default' ORDER BY id, title");

    if ($links)
    {
        $vals = array();
        foreach ($links as $row) {
            $vals[$row['id']] = $row['title'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_links_recorded');
}
