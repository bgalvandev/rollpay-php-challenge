<?php

namespace App\Domain\Repositories;

use App\Domain\Models\User;

interface UserRepository {
    public function findUserByUsername(string $username): ?User;
    public function saveUser(User $user): bool;
}