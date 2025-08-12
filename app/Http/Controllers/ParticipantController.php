<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ParticipantController extends Controller
{
    public function searchCallsign(Request $request)
    {
        $callsign = strtoupper($request->callsign);

        if (!$callsign) {
            return response()->json(['status' => 'error', 'message' => 'Callsign wajib diisi.'], 422);
        }

        try {
            $url = "https://iar-ikrap.postel.go.id/registrant/searchDataIar/?callsign={$callsign}";
            $response = Http::timeout(10)->get($url);

            if ($response->failed()) {
                return response()->json(['status' => 'error', 'message' => 'Gagal menghubungi server IAR.'], 500);
            }

            $html = $response->body();

            // Jika tidak ada data
            if (str_contains($html, 'not-found.png')) {
                return response()->json(['status' => 'not_found']);
            }

            // Parse HTML data
            preg_match_all('/<div class="title-meta">(.*?)<\/div>\s*<div class="meta-details">(.*?)<\/div>/', $html, $matches, PREG_SET_ORDER);

            $result = [];
            foreach ($matches as $match) {
                $title = strip_tags($match[1]);
                $value = strip_tags($match[2]);
                $result[$title] = $value;
            }

            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
