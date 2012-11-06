<?php

namespace Havvg\Component\Monitor\Resource;

/**
 * A resource which is part of a defined system.
 */
interface SystemAwareResourceInterface extends ResourceInterface
{
    /**
     * Return the system this resource belongs to.
     *
     * @return SystemInterface
     */
    public function getSystem();
}
