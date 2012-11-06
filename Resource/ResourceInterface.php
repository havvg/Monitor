<?php

namespace Havvg\Component\Monitor\Resource;

/**
 * A resource refers to the actual unit to be monitored.
 */
interface ResourceInterface
{
    /**
     * The name of the resource.
     *
     * @return string
     */
    public function getName();
}
