<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Afficher la liste des réservations.
     */
    public function index()
    {
        $reservations = Reservation::with('vol')->get();
        return response()->json($reservations);
    }

    /**
     * Enregistrer une nouvelle réservation.
     */
    public function store(Request $request)
    {
        $reservation = new Reservation([
            'nom_passager' => $request->input('nom_passager'),
            'classe_vol' => $request->input('classe_vol'),
            'nombre_sieges' => $request->input('nombre_sieges'),
            'prix_total' => $request->input('prix_total'),
            'vol_id' => $request->input('vol_id'),
            // Ajoutez d'autres attributs en fonction de vos besoins
        ]);

        $reservation->save();

        return response()->json($reservation, 201);
    }

    /**
     * Afficher les détails d'une réservation spécifique.
     */
    public function show(Reservation $reservation)
    {
        return response()->json($reservation);
    }

    /**
     * Mettre à jour les informations d'une réservation.
     */
    public function update(Request $request, Reservation $reservation)
    {
        $reservation->update([
            'nom_passager' => $request->input('nom_passager'),
            'classe_vol' => $request->input('classe_vol'),
            'nombre_sieges' => $request->input('nombre_sieges'),
            'prix_total' => $request->input('prix_total'),
            // Ajoutez d'autres attributs en fonction de vos besoins
        ]);

        // Mettez à jour également l'association avec le vol si nécessaire
        if ($request->has('vol_id')) {
            $reservation->vol()->associate($request->input('vol_id'));
        }

        return response()->json($reservation, 200);
    }

    /**
     * Supprimer une réservation.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();
        return response()->json('Réservation supprimée !');
    }
}
