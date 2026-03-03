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

            $data[$property->getName()] = match (true) {
                $value instanceof AbstractDTO => $value->toArray(),
                $value instanceof \DateTimeInterface => $value->format('d-m-Y'),
                is_array($value) => array_map(
                    fn($item) => $item instanceof AbstractDTO ? $item->toArray() : $item,
                    $value
                ),
                default => $value,
            };
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

