<?php

namespace App\DTOs;

/**
 * Abstract base class for all DTOs.
 * Provides common functionality for data transfer objects.
 */
abstract readonly class AbstractDTO
{
    /**
     * Create a DTO instance from an array of data.
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(...$data);
    }

    /**
     * Convert the DTO to an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $data = [];
        $reflection = new \ReflectionClass($this);

        foreach ($reflection->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
            $value = $property->getValue($this);

            if ($value instanceof AbstractDTO) {
                $data[$property->getName()] = $value->toArray();
            } elseif ($value instanceof \DateTimeInterface) {
                $data[$property->getName()] = $value->format('d-m-Y');
            } elseif (is_array($value)) {
                $data[$property->getName()] = array_map(function ($item) {
                    if ($item instanceof AbstractDTO) {
                        return $item->toArray();
                    }
                    return $item;
                }, $value);
            } else {
                $data[$property->getName()] = $value;
            }
        }

        return $data;
    }

    /**
     * Get only the specified fields from the DTO.
     *
     * @param array $fields
     * @return array
     */
    public function only(array $fields): array
    {
        $data = $this->toArray();
        return array_intersect_key($data, array_flip($fields));
    }

    /**
     * Get all fields except the specified ones.
     *
     * @param array $fields
     * @return array
     */
    public function except(array $fields): array
    {
        $data = $this->toArray();
        return array_diff_key($data, array_flip($fields));
    }
}

