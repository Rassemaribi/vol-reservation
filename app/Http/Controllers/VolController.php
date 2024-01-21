<?php

namespace App\Http\Controllers;

use App\Models\Vol;
use Illuminate\Http\Request;

class VolController extends Controller
{
    public function index()
    {
        $vols = Vol::with('compagnieAerienne')->get();
        return $vols;
    }

    public function store(Request $request)
    {
        $vol = new Vol([
            'compagnieaerienneID' => $request->input('compagnieaerienneID'),
            'numero_vol' => $request->input('numero_vol'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),
            'date_depart' => $request->input('date_depart'),
            'date_arrivee' => $request->input('date_arrivee'),
            'capacite' => $request->input('capacite'),
            'prix' => $request->input('prix'),
            // Ajoutez d'autres attributs en fonction de vos besoins
        ]);

        $vol->save();

        return response()->json($vol, 201);
    }

    public function show($id)
    {
        $vol = Vol::find($id);
        return response()->json($vol);
    }

    public function update(Request $request, $id)
    {
        $vol = Vol::find($id);
        $vol->update($request->all());
        return response()->json($vol, 200);
    }

    public function destroy($id)
    {
        $vol = Vol::find($id);
        $vol->delete();
        return response()->json('Vol supprimé !');
    }


    public function showVolByCompagnieAerienne($compagnieaerienneID)
{
    $vols = Vol::where('compagnieaerienneID', $compagnieaerienneID)
        ->with('compagnieAerienne')
        ->get();

    return response()->json($vols);
}

}
