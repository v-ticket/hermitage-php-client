<?php

namespace livetyping\hermitage\client;

/**
 * Determines the mime-type of a file by its contents.
 *
 * @param string $binary
 *
 * @return string
 */
function mimetype_from_binary($binary)
{
    return (new \finfo(FILEINFO_MIME_TYPE))->buffer($binary);
}

/**
 * Determines the version name of a image by its path.
 *
 * @param string $path
 *
 * @return string
 */
function version_name($path)
{
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $version = '';

    if ($pos = strrpos($extension, ':')) {
        $version = substr($extension, $pos);
    }

    return $version;
}

/**
 * Return the path of an original image.
 *
 * @param string $path
 *
 * @return string
 */
function original_version($path)
{
    $version = version_name($path);
    if ($version) {
        $path = str_replace(":{$version}", '', $path);
    }

    return $path;
}
