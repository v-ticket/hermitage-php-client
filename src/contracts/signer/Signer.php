<?php

namespace livetyping\hermitage\client\contracts\signer;

/**
 * Interface Signer
 *
 * @package livetyping\hermitage\client\contracts\signer
 */
interface Signer
{
    /**
     * @param string $data
     *
     * @return string
     */
    public function sign($data);
}
