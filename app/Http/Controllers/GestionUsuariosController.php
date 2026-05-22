<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Rol;

class GestionUsuariosController extends Controller
{
    public function index()
    {
        $users     = User::with('rol')->orderBy('created_at', 'desc')->paginate(10);
        $roles     = Rol::where('estado', 1)->orderBy('nombre')->get();
        $total     = User::count();
        $admins    = User::where('roles', 1)->count(); // ajusta el id según tu tabla roles
    
        return view('gestionUsuarios.index', compact('users', 'roles', 'total', 'admins'));
    }

    public function edit(User $user)
    {
        return response()->json($user);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'              => 'required|string|max:255',
                'email'             => 'required|email|max:255|unique:users,email',
                'password'          => 'required|string|min:8',
                'roles'             => 'required|integer|exists:roles,id',
            ]);

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            return response()->json($user, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => ['required','email','max:255', Rule::unique('users','email')->ignore($user->id)],
            'password'          => 'nullable|string|min:8',
            'roles' => 'required|integer|exists:roles,id',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);
        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado.']);
    }
}