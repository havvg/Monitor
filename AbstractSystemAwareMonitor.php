<?php

namespace Havvg\Component\Monitor;

use Havvg\Component\Monitor\Resource\SystemInterface;
use Havvg\Component\Monitor\Resource\ResourceInterface;

abstract class AbstractSystemAwareMonitor extends AbstractMonitor
{
    /**
     * Register a system on this monitor.
     *
     * @param SystemInterface $system
     *
     * @return AbstractSystemAwareMonitor
     */
    public function addSystem(SystemInterface $system)
    {
        foreach ($system->getChildren() as $eachSystem) {
            $this->addSystem($eachSystem);
        }

        foreach ($system->getResources() as $eachResource) {
            $this->addResource($eachResource);
        }

        // Add the system itself as resource.
        parent::addResource($system);

        return $this;
    }

    /**
     * Register a resource on this monitor.
     *
     * @param ResourceInterface $resource
     *
     * @return AbstractSystemAwareMonitor
     */
    public function addResource(ResourceInterface $resource)
    {
        if ($resource instanceof SystemInterface) {
            return $this->addSystem($resource);
        }

        return parent::addResource($resource);
    }
}
