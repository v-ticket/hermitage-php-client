<?php

namespace livetyping\hermitage\client\contracts\signer;

use Psr\Http\Message\RequestInterface as Request;

/**
 * Interface RequestSigner
 *
 * @package livetyping\hermitage\client\contracts\signer
 */
interface RequestSigner
{
    /**
     * @param \Psr\Http\Message\RequestInterface $request
     *
     * @return Request
     */
    public function sign(Request $request);
}
