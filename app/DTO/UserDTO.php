<?php

namespace App\DTO;

use App\Http\Requests\Project\UserRequest;

readonly class UserDTO
{
    public function __construct(
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $phone,
    )
    {
    }

    public static function fromRequest(UserRequest $request): self
    {
        return new self(
            first_name: $request->input('first_name'),
            last_name: $request->input('last_name'),
            email: $request->input('email'),
            phone: $request->input('phone')
        );

//        return new self(
//            ...$request->validated()
//        );

    }

    public static function toArray(): array
    {
        return [];
    }
}
