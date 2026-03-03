<?php

namespace App\DTOs\Requests;

use App\DTOs\AbstractDTO;

/**
 * DTO for updating an existing Cliente.
 */
readonly class UpdateClienteDTO extends AbstractDTO
{
    public function __construct(
        public ?string $telefone = null,
    ) {}

    /**
     * Create DTO from request array.
     *
     * @param array $data
     * @return static
     */
    public static function fromRequest(array $data): static
    {
        return new static(
            telefone: $data['telefone'] ?? null,
        );
    }

    /**
     * Convert to array for model update.
     *
     * @return array
     */
    public function toModelArray(): array
    {
        return array_filter([
            'telefone' => $this->telefone,
        ], fn($value) => $value !== null);
    }
}

