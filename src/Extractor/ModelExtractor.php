<?php
namespace App\Extractor;

use App\DTO\Car;

class ModelExtractor implements ExtractorInterface
{
    /**
     * Extract
     *
     * Extract the model of the given car. Throw Runtime exception
     * if parameter is not a Car instance.
     *
     * @param Car $element The car from where extract the model
     *
     * @return string
     * @throws \RuntimeException
     */
    public function extract($element)
    {
        if (! $element instanceof Car) {
            throw new \RuntimeException('Instance of car required');
        }

        return $element->getModel();
    }

    /**
     * Extract list
     *
     * Extract a list of model from a list of car.Throw a RuntimeException if
     * one of the given elements is not a car.
     *
     * @param array $elements The list of car from where extract
     *                        the models.
     *
     * @return array
     * @throws \RuntimeException
     */
    public function extractList(array $elements) : array
    {
        $modelArray = [];
        foreach ($elements as $element) {
            $modelArray[] = $this->extract($element);
        }

        return $modelArray;
    }
}

