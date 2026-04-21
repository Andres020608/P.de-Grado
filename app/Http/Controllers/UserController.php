<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(): View
    {
        $users = User::orderBy('name')->paginate(15);

        return view('users.index', compact('users'));
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        try {
            User::create($request->validated());
            return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocurrió un error al crear el usuario. Por favor, intente de nuevo.');
        }
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        try {
            $data = $request->validated();

            if (empty($data['password'])) {
                unset($data['password']);
            }

            $user->update($data);

            return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado correctamente.');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Ocurrió un error al actualizar el usuario.');
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
