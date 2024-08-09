<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{
   public function index(){
        $roles = Role::all();
        $users = User::all();
        return view('auth.index' ,compact('roles','users'));
    }
    
    public function handleRegister(Request $request)
    {

        // Définir les règles de validation
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role_id' => 'required|exists:roles,id',
        ];

        // Valider les données
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {

            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }


        DB::beginTransaction();

        try {
            
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('azerty'), 
            ]);

            // Assigner le rôle à l'utilisateur
            $role = Role::findById($request->input('role_id'));
            $user->assignRole($role);

            // Commit la transaction
            DB::commit();

            return redirect()->back()->with('success', 'Votre compte a été créé avec succès!');
        } catch (Exception $e) {
            // Annuler la transaction en cas d'erreur
            DB::rollback();

            // Log l'erreur pour le débogage
            Log::error('Erreur lors de l\'enregistrement de l\'utilisateur: ' . $e->getMessage());

            // Redirection avec message d'erreur
            return redirect()->back()
                ->withErrors(['error' => 'Une erreur est survenue lors de la création du compte. Veuillez réessayer plus tard.'])
                ->withInput();
        }
    }

public function handleLogin(Request $request)
{
    // Définir les règles de validation
    $rules = [
        'email' => 'required|email|exists:users,email',
        'password' => 'required|string',
    ];

    // Valider les données
    $validator = Validator::make($request->all(), $rules);

    // Si la validation échoue
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Authentifier l'utilisateur
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        // Redirection vers la page d'accueil
        return redirect()->route('dashboard')->with('success','Vous êtes connecté !');
    }

    // Authentification échouée
    return redirect()->back()
        ->withErrors(['error' => 'Email ou mot de passe incorrect'])
        ->withInput();
}

}
