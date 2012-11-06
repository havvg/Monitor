<?php

namespace Havvg\Component\Monitor\Result\Handler;

use SplObjectStorage;

use Havvg\Component\Monitor\Resource\ResourceInterface;
use Havvg\Component\Monitor\Resource\SystemAwareResourceInterface;
use Havvg\Component\Monitor\Resource\SystemInterface;
use Havvg\Component\Monitor\Result\ResultInterface;

/**
 * This handler stores all results in an object storage for further access.
 */
class StorageHandler implements HandlerInterface
{
    /**
     * @var SplObjectStorage
     */
    protected $storage;

    /**
     * @var SystemInterface
     */
    protected $system;

    /**
     * Constructor.
     *
     * @param SystemInterface $system   The system to attach all resources to, which are not assigned to any system.
     * @param SplObjectStorage $storage The storage to expand.
     */
    public function __construct(SystemInterface $system = null, SplObjectStorage $storage = null)
    {
        if (null === $storage) {
            $storage = new SplObjectStorage();
        }

        $this->storage = $storage;
        $this->system = $system;
    }

    /**
     * Return the storage containing the results.
     *
     * @return SplObjectStorage
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * Process the given result.
     *
     * @param ResultInterface $result
     *
     * @return bool
     */
    public function process(ResultInterface $result)
    {
        $resource = $result->getResource();

        if ($resource instanceof SystemAwareResourceInterface) {
            $this->addResultToResource($result, $resource->getSystem());
        }

        $this->addResultToResource($result, $resource);

        return true;
    }

    /**
     * Add the result to the list of results on the given resource.
     *
     * @param ResultInterface $result
     * @param ResourceInterface $resource
     */
    protected function addResultToResource(ResultInterface $result, ResourceInterface $resource)
    {
        $results = $this->getResultsForResource($resource);

        array_push($results, $result);

        $this->storage[$resource] = $results;
    }

    /**
     * Retrieve the results for the given resource.
     *
     * @param ResourceInterface $resource
     *
     * @return ResultInterface[]
     */
    public function getResultsForResource(ResourceInterface $resource)
    {
        if (!$this->storage->contains($resource)) {
            return array();
        }

        return $this->storage[$resource];
    }
}
