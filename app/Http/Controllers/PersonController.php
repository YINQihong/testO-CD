<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\User;

class PersonController extends Controller
{
    /**
     * Assurer que seules les utilisateurs authentifiées peuvent créer des personnes.
     */
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    /**
     * Afficher la liste des personnes avec le nom du créateur.
     */
    public function index()
    {
        $people = Person::with('creator')->get(); // Charge les personnes avec leur créateur
        return view('people.index', compact('people'));
    }

    /**
     * Afficher une personne avec ses enfants et parents.
     */
    public function show($id)
    {
        $person = Person::with(['children', 'parents'])->findOrFail($id);
        return view('people.show', compact('person'));
    }

    /**
     * Afficher le formulaire de création.
     */
    public function create()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        return view('people.create', compact('users'));
    }

    /**
     * Enregistrer une nouvelle personne dans la base de données.
     */
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'created_by' => 'required|exists:users,id',
        ]);

        $formattedFirstName = ucfirst(strtolower($request->first_name));  // première lettre en majuscule, toutes les autres lettres en minuscules.
        $formattedLastName = strtoupper($request->last_name);  // toutes lettres en majuscules.
        $formattedMiddleNames = $request->middle_names 
        ? implode(', ', array_map(fn($name) => ucfirst(strtolower($name)), explode(',', $request->middle_names)))
        : null;  // pour chaque prénom séparé par une virgule, alors première lettre en majuscule et toutes les autres lettres en minuscules - si non renseigné alors NULL
        $formattedBirthName = strtoupper($request->birth_name) ?? $formattedLastName; 

        // Création de la personne
        Person::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'created_by' => $request->created_by,
            'birth_name' => $request->birth_name,
            'middle_names' => $request->middle_names,
            'date_of_birth' => $request->date_of_birth,
        ]);

        // Rediriger vers index avec message de succès
        return redirect()->route('people.index')->with('success', 'Personne ajoutée avec succès.');
    }
}
