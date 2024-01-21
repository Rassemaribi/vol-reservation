<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\CompagnieAerienne;
use Illuminate\Http\Request;

class CompagnieAerienneController extends Controller
{
    /**
     * Afficher la liste des compagnies aériennes.
     */
    public function index()
    {
        $compagniesAeriennes = CompagnieAerienne::all();
        return response()->json($compagniesAeriennes);
    }

    /**
     * Enregistrer une nouvelle compagnie aérienne.
     */
    
public function store(Request $request)
{
    try {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'contry' => 'required|string',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Générez un nom unique pour le fichier
        $nomFichier = time() . '_' . $validatedData['logo']->getClientOriginalName();

        // Déplacez le fichier vers le dossier de destination
        $validatedData['logo']->move(public_path('uploads'), $nomFichier);

        // Enregistrez le nom du fichier dans la base de données
        $compagnieAerienne = CompagnieAerienne::create([
            'nom' => $validatedData['nom'],
            'contry' => $validatedData['contry'],
            'logo' => $nomFichier,
        ]);

        return response()->json($compagnieAerienne, 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Une erreur s\'est produite lors de l\'enregistrement.'], 500);
    }
}
    /**
     * Afficher les détails d'une compagnie aérienne spécifique.
     */
    public function show($id)
    {
        $compagnieAerienne = CompagnieAerienne::find($id);
        return response()->json($compagnieAerienne);
    }

    /**
     * Mettre à jour les informations d'une compagnie aérienne.
     */
    public function update(Request $request, $id)
    {
        $compagnieAerienne = CompagnieAerienne::find($id);
        $compagnieAerienne->update($request->all());
        return response()->json($compagnieAerienne, 200);
    }

    /**
     * Supprimer une compagnie aérienne.
     */
    public function destroy($id)
    {
        $compagnieAerienne = CompagnieAerienne::find($id);
        $compagnieAerienne->delete();
        return response()->json('Compagnie aérienne supprimée !');
    }

    public function getLogos()
    {
        try {
            $logos = Storage::files('uploads');
            return response()->json($logos);
        } catch (\Exception $e) {
            // Journalisez l'erreur ou retournez une réponse appropriée
            return response()->json(['message' => 'Une erreur s\'est produite lors de la récupération des logos.'], 500);
        }
    }
    
  
  


}
