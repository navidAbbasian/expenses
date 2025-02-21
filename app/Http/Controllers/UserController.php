<?php

namespace App\Http\Controllers;

use App\Actions\User\UpdateUserAction;
use App\DTOs\UserDTO;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class UserController extends Controller
{
    public function __construct(protected UpdateUserAction $updateUserAction,
                                protected UserRepository $userRepository)
    {
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function index(Request $request)
    {
        $users = User::query()->with('banks');
        $paginatedUsers = $this->userRepository->paginate($request->limit, $users);

        return $this->ok(UserCollection::make($paginatedUsers));
    }

    public function show()
    {
        $user = auth()->user();
        return $this->ok(UserResource::make($user));
    }

    public function update(User $user, UpdateUserRequest $request)
    {
        $user = $this->updateUserAction->run(UserDTO::fromRequest($request), $user);
        return $this->ok(UserResource::make($user));
    }
}
