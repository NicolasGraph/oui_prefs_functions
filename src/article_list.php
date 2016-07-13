<?php

function oui_prefs_article_list($name, $val)
{
    $articles = safe_rows("title, id", 'textpattern', "title != 'default' ORDER BY id, title");

    if ($articles)
    {
        $vals = array();
        foreach ($articles as $row) {
            $vals[$row['id']] = $row['title'];
        }
        return selectInput($name, $vals, $val, 'true');
    }
    return gtxt('no_articles_recorded');
}
