<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use DOMXPath;

class ParticipantController extends Controller
{
    public function searchCallsign(Request $request)
    {
        $callsign = strtoupper(trim($request->callsign));

        if (!$callsign) {
            return response()->json(['status' => 'error', 'message' => 'Callsign wajib diisi.'], 422);
        }

        try {
            $url = "https://iar-ikrap.postel.go.id/registrant/searchDataIar/?callsign={$callsign}";
            $response = Http::timeout(10)->get($url);

            if ($response->failed()) {
                return response()->json(['status' => 'error', 'message' => 'Gagal menghubungi server IAR.'], 500);
            }

            $html = stripslashes($response->body());

            // Check if data not found
            if (str_contains($html, 'not-found.png') || str_contains($html, 'Data tidak ditemukan')) {
                return response()->json(['status' => 'not_found']);
            }

            // Parse using DOMDocument for more reliable parsing
            $dom = new DOMDocument();
            @$dom->loadHTML($html);
            $xpath = new DOMXPath($dom);

            // Get all title-meta and meta-details divs
            $titles = $xpath->query("//div[@class='title-meta']");
            $details = $xpath->query("//div[@class='meta-details']");

            if ($titles->length === 0 || $details->length === 0) {
                return response()->json(['status' => 'not_found']);
            }

            $result = [];
            for ($i = 0; $i < $titles->length; $i++) {
                $title = trim(preg_replace('/\s+/', ' ', $titles->item($i)->nodeValue));
                $value = trim(preg_replace('/\s+/', ' ', $details->item($i)->nodeValue));

                $cleanTitle = $this->mapTitle($title);
                if ($cleanTitle) {
                    $result[$cleanTitle] = $value;
                }
            }

            if (empty($result)) {
                return response()->json(['status' => 'not_found']);
            }
            return response()->json([
                'status' => 'success',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in searchCallsign', ['error' => $e->getMessage(), 'callsign' => $callsign]);
            return response()->json(['status' => 'error', 'message' => 'Terjadi kesalahan saat mencari data.'], 500);
        }
    }

    private function mapTitle($title)
    {
        $title = strtolower($title);

        // Remove content in parentheses if exists
        $title = preg_replace('/\(.*?\)/', '', $title);
        $title = trim($title);

        if (str_contains($title, 'nama pemilik')) {
            return 'nama_pemilik';
        } elseif (str_contains($title, 'provinsi')) {
            return 'provinsi';
        } elseif (str_contains($title, 'tanda panggilan')) {
            return 'callsign';
        } elseif (str_contains($title, 'masa laku')) {
            return 'masa_laku';
        } elseif (str_contains($title, 'status')) {
            return 'status';
        }

        return null;
    }
}
