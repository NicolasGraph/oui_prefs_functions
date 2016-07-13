<?php

function oui_prefs_style_list($name, $val)
{
    $styles = safe_rows("name", 'txp_css', "name != 'default' ORDER BY name");

    if ($styles)
    {
        $vals = array();
        foreach ($styles as $row) {
            $vals[$row['name']] = $row['name'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_styles_recorded');
}
