<?php

namespace App\Application\DTOs\Responses;

use App\Application\DTOs\AbstractDTO;
use App\Models\User;

/**
 * DTO for User response data.
 */
readonly class UserDTO extends AbstractDTO
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?string $email = null,
    ) {}

    /**
     * Create DTO from User model.
     *
     * @param User $user
     * @return static
     */
    public static function fromModel(User $user): static
    {
        return new static(
            id: $user->id,
            name: $user->name,
            email: $user->email,
        );
    }

    /**
     * Create DTO from array (e.g., from relationship).
     *
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            email: $data['email'] ?? null,
        );
    }
}

