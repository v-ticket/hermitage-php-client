<?php

namespace livetyping\hermitage\client\signer;

use livetyping\hermitage\client\contracts\signer\Signer as SignerInterface;

/**
 * Class Signer
 *
 * @package livetyping\hermitage\client\signer
 */
class Signer implements SignerInterface
{
    /** @var string */
    protected $secret;
    
    /** @var string */
    protected $algorithm;

    /**
     * Signer constructor.
     *
     * @param string $secret
     * @param string $algorithm
     */
    public function __construct($secret, $algorithm = 'sha256')
    {
        $this->secret = $secret;
        $this->algorithm = $algorithm;
    }

    /**
     * @param string $data
     *
     * @return string
     */
    public function sign($data)
    {
        $signature = hash_hmac($this->algorithm, $data, $this->secret);

        return $signature;
    }
}
