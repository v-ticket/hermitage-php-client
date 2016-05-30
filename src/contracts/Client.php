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
     * @param string $binary
     *
     * @return ResponseInterface
     */
    public function upload($binary);

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
