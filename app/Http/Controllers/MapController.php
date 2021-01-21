<?php

namespace App\Http\Controllers;

use App\Models\Pocet;
use App\Models\Skola;
use App\Models\Obor;
use Illuminate\Http\Request;

class MapController extends Controller
{
    public function index()
    {
        return view('filter', [
            'pocet' => Pocet::orderBy('id', 'asc')->paginate(10),
            'skola' => Skola::orderBy('nazev', 'asc')->get(),
            'obor' => Obor::orderBy('nazev', 'asc')->get(),
            'roky' => Pocet::distinct()->get(['rok'])
        ]);
    }

    public function filter(Request $request)
    {
        $pocet = Pocet::orderBy('id', 'asc');
        if ($request->skola !== '*') {
            $pocet = $pocet->where('skola', $request->skola);
        }

        if ($request->obor !== '*') {
            $pocet = $pocet->where('obor', $request->obor);
        }

        if ($request->rok !== '*') {
            $pocet = $pocet->where('rok', $request->rok);
        }

        $skoly_id = $pocet->where('skola' , '>' , 0)->pluck('skola')->toArray();
        $search = Skola::orderBy('nazev', 'asc')->whereIn('id', $skoly_id)->get();

        $pocet = $pocet->paginate(10);

        $skola = Skola::orderBy('nazev', 'asc')->get();
        $obor = Obor::orderBy('nazev', 'asc')->get();
        $roky = Pocet::distinct()->get(['rok']);

        return view('filter', [
            'pocet' => $pocet,
            'skola' => $skola,
            'obor' => $obor,
            'request' => $request,
            'roky' => $roky,
            'search' => $search,
        ]);
    }
}
