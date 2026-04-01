<?php

namespace App\Application\DTOs\Requests;

use App\Application\DTOs\AbstractDTO;

/**
 * DTO for creating a new Cliente.
 */
readonly class CreateClienteDTO extends AbstractDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public ?string $password = null,
        public string $telefone,
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
            name: $data['user']['name'] ?? $data['name'] ?? '',
            email: $data['user']['email'] ?? $data['email'] ?? '',
            password: $data['user']['password'] ?? $data['password'] ?? null,
            telefone: $data['telefone'] ?? '',
        );
    }

    /**
     * Convert to array for user creation.
     *
     * @return array
     */
    public function toUserArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? bcrypt($this->password) : null,
        ];
    }

    /**
     * Convert to array for cliente creation.
     *
     * @param int $userId
     * @return array
     */
    public function toClienteArray(int $userId): array
    {
        return [
            'user_id' => $userId,
            'telefone' => $this->telefone,
        ];
    }
}

