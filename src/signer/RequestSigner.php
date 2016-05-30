<?php

namespace livetyping\hermitage\client\signer;

use livetyping\hermitage\client\contracts\signer\RequestSigner as RequestSignerInterface;
use livetyping\hermitage\client\contracts\signer\Signer;
use Psr\Http\Message\RequestInterface;

/**
 * Class RequestSigner
 *
 * @package livetyping\hermitage\client\signer
 */
class RequestSigner implements RequestSignerInterface
{
    const TIMESTAMP_HEADER = 'X-Authenticate-Timestamp';
    const SIGNATURE_HEADER = 'X-Authenticate-Signature';

    /** @var \livetyping\hermitage\client\contracts\signer\Signer */
    protected $signer;

    /**
     * RequestSigner constructor.
     *
     * @param \livetyping\hermitage\client\contracts\signer\Signer $signer
     */
    public function __construct(Signer $signer)
    {
        $this->signer = $signer;
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return \Psr\Http\Message\RequestInterface
     */
    public function sign(RequestInterface $request)
    {
        $timestamp = (new \DateTime('now', new \DateTimeZone('UTC')))->getTimestamp();

        $data = implode('|', [$request->getMethod(), rtrim((string)$request->getUri(), '/'), $timestamp]);
        $signature = $this->signer->sign($data);

        return $request->withHeader(self::TIMESTAMP_HEADER, $timestamp)
                       ->withHeader(self::SIGNATURE_HEADER, $signature);
    }
}
