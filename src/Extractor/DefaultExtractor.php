<?php
namespace App\Extractor;

use App\DTO\Car;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class DefaultExtractor implements ExtractorInterface
{
    private $instanceType;

    private $target;

    private $accessor;

    public function __construct(
        string $instanceType,
        string $target,
        PropertyAccessor $accessor
    ) {
        $this->instanceType = $instanceType;
        $this->target = $target;
        $this->accessor = $accessor;
    }

    /**
     * Extract
     *
     * Extract the value of the given element. Throw Runtime exception
     * if parameter is not of the expected instance.
     *
     * @param mixed $element The element from where extract the value
     *
     * @return string
     * @throws \RuntimeException
     */
    public function extract($element)
    {
        if (! $element instanceof $this->instanceType) {
            throw new \RuntimeException('Instance of '.$this->instanceType.' required');
        }
        if (!$this->accessor->isReadable($element, $this->target)) {
            throw new \LogicException('Property does not exist');
        }

        return $this->accessor->getValue($element, $this->target);
    }

    /**
     * Extract list
     *
     * Extract a list of values from a list of elements.Throw a RuntimeException if
     * one of the given elements is not of the expected type.
     *
     * @param array $elements The list of elements from where extract
     *                        the value.
     *
     * @return array
     * @throws \RuntimeException
     */
    public function extractList(array $elements) : array
    {
        $valueArray = [];
        foreach ($elements as $element) {
            $valueArray[] = $this->extract($element);
        }

        return $valueArray;
    }
}
