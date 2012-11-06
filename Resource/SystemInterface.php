<?php

namespace Havvg\Component\Monitor\Resource;

/**
 * A system describes a set of resources to be monitored.
 *
 * For example a system may be a specific service, like your caching infrastructure.
 * Each server (or memcache instance) may be a child system containing the resources to measure (connectivity, cache misses, ...).
 */
interface SystemInterface extends ResourceInterface
{
    /**
     * Retrieve the list of systems that are part of this system.
     *
     * @return SystemInterface[]
     */
    public function getChildren();

    /**
     * Retrieve the list of resources to be monitored.
     *
     * @return SystemAwareResourceInterface[]|ResourceInterface[]
     */
    public function getResources();
}
