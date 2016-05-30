<?php

namespace livetyping\hermitage\client;

use GuzzleHttp\ClientInterface as GuzzleClientInterface;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use livetyping\hermitage\client\contracts\Client as ClientInterface;
use livetyping\hermitage\client\contracts\signer\RequestSigner;
use Psr\Http\Message\UriInterface;

/**
 * Class Client
 *
 * @package livetyping\hermitage\client
 */
class Client implements ClientInterface
{
    /** @var \livetyping\hermitage\client\contracts\signer\RequestSigner */
    protected $signer;

    /** @var \GuzzleHttp\ClientInterface */
    protected $guzzle;

    /** @var UriInterface */
    protected $baseUri;

    /** @var array */
    protected $headers = [
        'Accept' => 'application/json',
    ];

    /**
     * Client constructor.
     *
     * @param \livetyping\hermitage\client\contracts\signer\RequestSigner $signer
     * @param \GuzzleHttp\ClientInterface                                 $guzzle
     * @param \Psr\Http\Message\UriInterface|string                       $baseUri
     */
    public function __construct(RequestSigner $signer, GuzzleClientInterface $guzzle, $baseUri)
    {
        $this->signer = $signer;
        $this->guzzle = $guzzle;
        $this->baseUri = \GuzzleHttp\Psr7\uri_for($baseUri);
    }

    /**
     * @param string $filename
     * @param string $version
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($filename, $version = '')
    {
        $request = new Request('GET', $this->uriFor($filename, $version), $this->headers);

        return $this->guzzle->send($request);
    }

    /**
     * @param string $binary
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function upload($binary)
    {
        $request = new Request('POST', $this->baseUri, $this->headers, $binary);
        $request = $request->withHeader('Content-Type', mimetype_from_binary($binary));
        $request = $this->signer->sign($request);

        return $this->guzzle->send($request);
    }

    /**
     * @param string $filename
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function delete($filename)
    {
        $request = new Request('DELETE', $this->uriFor($filename), $this->headers);
        $request = $this->signer->sign($request);

        return $this->guzzle->send($request);
    }

    /**
     * @param string $filename
     * @param string $version
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function uriFor($filename, $version = '')
    {
        $filename = original_version($filename);
        if ($version) {
            $filename .= ":{$version}";
        }

        return Uri::resolve($this->baseUri, $filename);
    }
}
