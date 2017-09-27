<?php

namespace livetyping\hermitage\client\contracts;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Interface Client
 *
 * @package livetyping\hermitage\client\contracts
 */
interface Client
{
    /**
     * @param $binary
     * @param string $extension
     * @return ResponseInterface
     */
    public function upload($binary,  $extension = '');

    /**
     * @param string $filename
     *
     * @return ResponseInterface
     */
    public function delete($filename);

    /**
     * @param string $filename
     * @param string $version
     *
     * @return ResponseInterface
     */
    public function get($filename, $version = '');

    /**
     * @param string $filename
     * @param string $version
     *
     * @return UriInterface
     */
    public function uriFor($filename, $version = '');
}
