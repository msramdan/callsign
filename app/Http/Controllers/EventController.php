<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Requests\Events\{StoreEventRequest, UpdateEventRequest};
use Illuminate\Contracts\View\View;
use Yajra\DataTables\Facades\DataTables;
use App\Generators\Services\ImageServiceV2;
use Illuminate\Http\{JsonResponse, RedirectResponse};
use Illuminate\Routing\Controllers\{HasMiddleware, Middleware};
use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class EventController extends Controller implements HasMiddleware
{
    public function __construct(public ImageServiceV2 $imageServiceV2, public string $templateSertifikatPath = 'template-sertifikats', public string $posterPath = 'posters', public string $disk = 'public')
    {
        //
    }

    /**
     * Get the middleware that should be assigned to the controller.
     */
    public static function middleware(): array
    {
        return [
            'auth',
            new Middleware(middleware: 'permission:event view', only: ['index', 'show']),
            new Middleware(middleware: 'permission:event create', only: ['create', 'store']),
            new Middleware(middleware: 'permission:event edit', only: ['edit', 'update']),
            new Middleware(middleware: 'permission:event delete', only: ['destroy']),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View|JsonResponse
    {
        if (request()->ajax()) {
            $events = Event::query();

            return Datatables::of(source: $events)

                ->addColumn(name: 'action', content: 'events.include.action')
                ->toJson();
        }

        return view(view: 'events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view(view: 'events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEventRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $validated['template_sertifikat'] = $this->imageServiceV2->upload(name: 'template_sertifikat', path: $this->templateSertifikatPath, disk: $this->disk);
        $validated['poster'] = $this->imageServiceV2->upload(name: 'poster', path: $this->posterPath, disk: $this->disk);

        Event::create(attributes: $validated);

        return to_route(route: 'events.index')->with(key: 'success', value: __(key: 'The event was created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event): View
    {
        return view(view: 'events.show', data: compact(var_name: 'event'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event): View
    {
        return view(view: 'events.edit', data: compact(var_name: 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event): RedirectResponse
    {
        $validated = $request->validated();

        $validated['template_sertifikat'] = $this->imageServiceV2->upload(name: 'template_sertifikat', path: $this->templateSertifikatPath, defaultImage: $event?->template_sertifikat, disk: $this->disk);
        $validated['poster'] = $this->imageServiceV2->upload(name: 'poster', path: $this->posterPath, defaultImage: $event?->poster, disk: $this->disk);

        $event->update(attributes: $validated);

        return to_route(route: 'events.index')->with(key: 'success', value: __(key: 'The event was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event): RedirectResponse
    {
        try {
            $templateSertifikat = $event->template_sertifikat;
            $poster = $event->poster;

            $event->delete();

            $this->imageServiceV2->delete(path: $this->templateSertifikatPath, image: $templateSertifikat, disk: $this->disk);

            $this->imageServiceV2->delete(path: $this->posterPath, image: $poster, disk: $this->disk);


            return to_route(route: 'events.index')->with(key: 'success', value: __(key: 'The event was deleted successfully.'));
        } catch (\Exception $e) {
            return to_route(route: 'events.index')->with(key: 'error', value: __(key: "The event can't be deleted because it's related to another table."));
        }
    }


    /**
     * Search callsign dari database IAR
     */
    public function searchCallsign(Request $request)
    {
        $request->validate([
            'callsign' => 'required|string|max:20'
        ]);

        $callsign = strtoupper(trim($request->callsign));

        try {
            // Hit API external
            $response = Http::timeout(10)->get('https://iar-ikrap.postel.go.id/registrant/searchDataIar/', [
                'callsign' => $callsign
            ]);

            if (!$response->successful()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal mengakses database IAR'
                ], 500);
            }

            $htmlResponse = $response->body();

            // Cek apakah data tidak ditemukan
            if (
                strpos($htmlResponse, 'not-found.png') !== false ||
                strpos($htmlResponse, 'text-center') !== false
            ) {
                return response()->json([
                    'success' => false,
                    'message' => "Callsign {$callsign} tidak ditemukan di database IAR"
                ]);
            }

            // Parse HTML response untuk mendapatkan data
            $data = $this->parseIarResponse($htmlResponse);

            if (empty($data)) {
                return response()->json([
                    'success' => false,
                    'message' => "Callsign {$callsign} tidak ditemukan di database IAR"
                ]);
            }

            return response()->json([
                'success' => true,
                'data' => $data,
                'message' => 'Data callsign berhasil ditemukan'
            ]);
        } catch (RequestException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Timeout atau gagal koneksi ke server IAR'
            ], 408);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan sistem'
            ], 500);
        }
    }

    /**
     * Parse HTML response dari API IAR
     */
    private function parseIarResponse($htmlResponse)
    {
        if (strpos($htmlResponse, 'none-style') === false) {
            return null;
        }

        // Gunakan DOMDocument untuk parsing HTML
        $dom = new \DOMDocument();
        @$dom->loadHTML($htmlResponse, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $xpath = new \DOMXPath($dom);
        $listItems = $xpath->query('//ul[contains(@class, "none-style")]/li');

        $data = [];

        foreach ($listItems as $item) {
            $titleElement = $xpath->query('.//div[contains(@class, "title-meta")]', $item);
            $valueElement = $xpath->query('.//div[contains(@class, "meta-details")]', $item);

            if ($titleElement->length > 0 && $valueElement->length > 0) {
                $title = trim($titleElement->item(0)->textContent);
                $value = trim($valueElement->item(0)->textContent);

                // Clean up title - remove HTML tags and extra text
                $title = preg_replace('/\s*\([^)]*\)\s*:\s*$/', '', $title);
                $title = trim(str_replace(':', '', $title));

                $data[$this->mapFieldName($title)] = $value;
            }
        }

        return $data;
    }

    /**
     * Map field names dari IAR ke format yang konsisten
     */
    private function mapFieldName($title)
    {
        $mapping = [
            'Nama Pemilik' => 'nama_pemilik',
            'Provinsi' => 'provinsi',
            'Tanda Panggilan' => 'callsign',
            'Masa Laku' => 'masa_laku',
            'Status' => 'status'
        ];

        return $mapping[$title] ?? strtolower(str_replace(' ', '_', $title));
    }

    /**
     * Tambah peserta ke event
     */
    public function addParticipant(Request $request, $eventId)
    {
        $request->validate([
            'callsign' => 'required|string|max:100',
            'nama_peserta' => 'required|string|max:150'
        ]);

        $event = Event::findOrFail($eventId);

        // Cek apakah peserta sudah terdaftar
        $existingParticipant = $event->pesertas()
            ->where('callsign', $request->callsign)
            ->first();

        if ($existingParticipant) {
            return response()->json([
                'success' => false,
                'message' => 'Callsign sudah terdaftar sebagai peserta'
            ]);
        }

        // Generate nomor sertifikat (customize sesuai kebutuhan)
        $nomorSertifikat = $this->generateCertificateNumber($event, $request->callsign);

        // Tambah peserta
        $peserta = $event->pesertas()->create([
            'callsign' => strtoupper($request->callsign),
            'nama_peserta' => $request->nama_peserta,
            'waktu_checkin' => now(),
            'nomor_sertifikat' => $nomorSertifikat
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Peserta berhasil ditambahkan',
            'data' => $peserta
        ]);
    }

    /**
     * Generate nomor sertifikat
     */
    private function generateCertificateNumber($event, $callsign)
    {
        $eventCode = strtoupper(substr($event->nama_event, 0, 3));
        $year = date('Y');
        $participantCount = $event->pesertas()->count() + 1;

        return sprintf('%s-%s-%s-%04d', $eventCode, $year, $callsign, $participantCount);
    }
}
