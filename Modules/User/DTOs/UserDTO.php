<?php
namespace Modules\User\DTOs;

readonly class UserDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $username,
        public string $status,
        public array $roles = [],
        public ?string $image = null,
        public int $email_enabled = 1,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            first_name: trim($data['first_name']),
            last_name: trim($data['last_name']),
            email: trim($data['email']),
            username: trim($data['username']),
            status: trim($data['status']),
            roles: $data['roles'] ?? [],
            image: $data['image'] ?? null,
            email_enabled: (int) ($data['email_enabled'] ?? 0),
        );
    }

    public function toArray(): array
    {
        return [
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'username'      => $this->username,
            'status'        => $this->status,
            'image'         => $this->image,
            'email_enabled' => $this->email_enabled,
        ];
    }
}
