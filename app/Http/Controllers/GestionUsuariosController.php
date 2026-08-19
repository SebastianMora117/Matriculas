<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\Rol;
use Illuminate\Support\Facades\Auth;

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
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|max:255|unique:users,email',
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/',
                ],
                'roles'    => 'required|integer|exists:roles,id',
            ]);

            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);

            return response()->json($user, 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, User $user)
    {
        try {
            $data = $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($user->id)],
                'password' => [
                    'nullable',
                    'string',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).+$/',
                ],
                'roles'    => 'required|integer|exists:roles,id',
            ]);

            if (!empty($data['password'])) {
                $data['password'] = Hash::make($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);
            return response()->json($user);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'Usuario eliminado.']);
    }

    public function toggleEstado(User $user)
    {
        if (Auth::id() === $user->id) {
            return response()->json([
                'error' => 'No puedes cambiar el estado de tu propia cuenta.'
            ], 403);
        }
    
        $user->estado = $user->estado ? 0 : 1;
        $user->save();
    
        return response()->json([
            'estado'  => $user->estado,
            'mensaje' => $user->estado ? 'Usuario activado.' : 'Usuario inactivado.',
        ]);
    }
}