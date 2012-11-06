<?php

namespace Havvg\Component\Monitor\Exception\Measurement;

use Havvg\Component\Monitor\Exception\ExceptionInterface;
use Havvg\Component\Monitor\Exception\InvalidArgumentException;

class UnsupportedResourceException extends InvalidArgumentException implements ExceptionInterface
{

}
