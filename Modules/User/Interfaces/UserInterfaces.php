<?php
namespace Modules\User\Interfaces;
use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserInterfaces
{
    public function paginate(
        int $currentUid,
        bool $excludeRoot,
        int $perPage = 50,
        ?string $keyword = null,
        ?string $sort = null,
    ): LengthAwarePaginator;

    public function create(array $data): User;
    public function find(int $uid): User;
    public function update(User $user, array $data): User;
}
