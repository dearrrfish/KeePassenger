<?php

function sortArrayBy($arr, $score = "score")
{
    if (!is_array($arr) || empty($arr)) { return $arr; }

    usort($arr, function ($a, $b) {
        if (!isset($a[$score]) || !isset($b[$score])) { return 0; }
        return ($a[$score] > $b[$score]) ? -1 : (($a[$score] == $b[$score]) ? 0 : 1);
    });

    return $arr;
}

// merge two arrays
function merge($a, $b)
{
    foreach($b as $key => $val)
    {
        if (isset($a[$key]) && is_array($a[$key]) && is_array($b[$key]))
        {
            $a[$key] = merge($a[$key], $b[key]);
        }
        else
        {
            $a[$key] = $b[$key];
        }
    }
    return $a;
}


/////////////////////////////////////////////////////////////////////////////////////

function loadClasses($location, $skip = array())
{
    if (!file_exists($location)) return;

    $subdirs = array();
    if ($handle = opendir($location))
    {
        while (false !== ($file = readdir($handle)))
        {
            if (!preg_match('/^[.]/',$file)
                && !preg_match('/~$/',$file)
                && !in_array($file, $skip))
            {
                // If a directory, keep track so we can load them later.
                if (is_dir($location."/".$file))
                {
                    $subdirs[] = $location."/".$file;
                }

                // If it's a class, include it.
                if (strpos($file, "class.php") !== false)
                {
                    include_once($location."/".$file);
                }
            }
        }
        closedir($handle);
    }

    // Recursively load from subdirectories
    foreach ($subdirs as $d) { loadClasses($d); }
}
