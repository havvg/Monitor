<?php

namespace Havvg\Component\Monitor\Result\Handler;

use Havvg\Component\Monitor\Result\ResultInterface;

/**
 * A handler processes results.
 *
 * A handler may for example send an email whenever the result is of a specific status.
 */
interface HandlerInterface
{
    /**
     * Process the given result.
     *
     * @param ResultInterface $result
     *
     * @return bool
     */
    public function process(ResultInterface $result);
}
