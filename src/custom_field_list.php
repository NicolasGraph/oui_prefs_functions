<?php

function oui_prefs_custom_field_list($name, $val)
{
    $custom_fields = safe_rows("name, val", 'txp_prefs', "name LIKE 'custom_%_set' AND val<>'' ORDER BY name");

    if ($custom_fields)
    {
        $vals = array();
        foreach ($custom_fields as $row) {
            $vals[$row['val']] = $row['val'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_custom_fields_recorded');
}
