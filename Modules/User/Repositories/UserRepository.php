<?php
namespace Modules\User\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Modules\User\Interfaces\UserInterfaces;

class UserRepository implements UserInterfaces
{
    public function paginate(int $currentUid, bool $excludeRoot, int $perPage = 50, ?string $keyword = null, ?string $sort = null): LengthAwarePaginator {
        $query = User::query()
            ->select(['uid','first_name','last_name','email','status','created_by','created_at'])
            ->with(['roles','creator'])
            ->where('uid', '!=', $currentUid);

        if ($excludeRoot) {
            $query->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'Root');
            });
        }

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('first_name', 'like', "%{$keyword}%")
                  ->orWhere('last_name', 'like', "%{$keyword}%")
                  ->orWhere('email', 'like', "%{$keyword}%");
            });
        }

        if ($sort === 'oldest') {
            $query->oldest('uid');
        } else {
            $query->latest('uid');
        }
        return $query->paginate($perPage);
    }

    public function create(array $data): User
    {
        return User::create($data);
    }

    public function find(int $uid): User
    {
        return User::findOrFail($uid);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);
        return $user;
    }
}
