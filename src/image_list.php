<?php

function oui_prefs_image_list($name, $val)
{
    $images = safe_rows("name, id", 'txp_image', "name != 'default' ORDER BY id, name");

    if ($images)
    {
        $vals = array();
        foreach ($images as $row) {
            $vals[$row['id']] = $row['name'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_images_recorded');
}
