<?php

function oui_prefs_section_list($name, $val)
{
    $sections = safe_rows("name, title", 'txp_section', "name != 'default' ORDER BY title, name");

    if ($sections)
    {
        $vals = array();
        foreach ($sections as $row) {
            $vals[$row['name']] = $row['title'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_sections_available');
}
