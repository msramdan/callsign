<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function getPeserta(Request $request)
    {
        $search = $request->input('search', '');

        $query = DB::table('pesertas')
            ->join('events', 'pesertas.event_id', '=', 'events.id')
            ->select(
                'pesertas.id',
                'pesertas.callsign',
                'pesertas.nama_peserta',
                'pesertas.nomor_sertifikat',
                'events.nama_event',
                'events.kode_sertifikat'
            );

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('pesertas.callsign', 'like', "%{$search}%")
                    ->orWhere('pesertas.nama_peserta', 'like', "%{$search}%")
                    ->orWhere('pesertas.nomor_sertifikat', 'like', "%{$search}%")
                    ->orWhere('events.nama_event', 'like', "%{$search}%");
            });
        }

        $pesertas = $query->orderBy('pesertas.created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'data' => $pesertas->items(),
            'pagination' => [
                'total' => $pesertas->total(),
                'per_page' => $pesertas->perPage(),
                'current_page' => $pesertas->currentPage(),
                'last_page' => $pesertas->lastPage(),
                'next_page_url' => $pesertas->nextPageUrl(),
                'prev_page_url' => $pesertas->previousPageUrl(),
            ]
        ]);
    }
}
