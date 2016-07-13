<?php

function oui_prefs_file_list($name, $val)
{
    $files = safe_rows("name, id", 'txp_image', "name != 'default' ORDER BY id, name");

    if ($files)
    {
        $vals = array();
        foreach ($files as $row) {
            $vals[$row['id']] = $row['name'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_images_recorded');
}
