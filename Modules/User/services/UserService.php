<?php
namespace Modules\User\services;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\User\DTOs\UserDTO;
use Modules\User\interfaces\UserInterfaces;
use Spatie\Permission\Models\Role;


class UserService
{
    public function __construct(
        private UserInterfaces $repo
    ) {}

    public function list(?string $keyword = null, ?string $sort = null)
    {
        $currentUser =  Auth::user();
        return $this->repo->paginate(currentUid: $currentUser->uid, excludeRoot: ! $currentUser->hasRole('root'), keyword: $keyword, sort: $sort);
    }

    public function create(UserDTO $dto): User
    {
        return DB::transaction(function () use ($dto) {
            $user = $this->repo->create($dto->toArray());
            $this->syncRoles($user, $dto->roles);

            // if ((int) $dto->email_enabled === 1) {
            //     DB::afterCommit(function () use ($user) {
            //         $token = Password::createToken($user);
            //         event(new UserCreatedEvent($user, $token));
            //     });
            // }
            return $user;
        });
    }

    public function edit(int $uid): User
    {
        return $this->repo->find($uid);
    }

    public function update(int $uid, UserDTO $dto): User
    {
        return DB::transaction(function () use ($uid, $dto) {
            $user = $this->repo->find($uid);
            $user = $this->repo->update($user, $dto->toArray());
            $this->syncRoles($user, $dto->roles);
            return $user;
        });
    }

    public function delete(int $uid): bool
    {
        return DB::transaction(function () use ($uid) {
            $user = $this->repo->find($uid);
            $user->syncRoles([]);
            return $this->repo->delete($user);
        });
    }

    public function find(int $uid): User
    {
        return $this->repo->find($uid);
    }

    private function syncRoles(User $user, array $roles): void
    {
        $roleModels = Role::whereIn('id', $roles)->get();
        $user->syncRoles($roleModels);
    }
}
