<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class WorkerManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'worker')->with('worker');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('status') && in_array($request->status, ['Aktif', 'Nonaktif'])) {
            $isActive = ($request->status == 'Aktif');
            $query->whereHas('worker', fn($q) => $q->where('is_active', $isActive));
        }

        if ($request->filled('jenis') && in_array($request->jenis, ['Mangkal', 'Keliling'])) {
            $query->whereHas('worker', fn($q) => $q->where('worker_type', $request->jenis));
        }

        $users = $query->latest()->paginate(10);
        return view('admin.worker.index', compact('users'));
    }

    public function create()
    {
        return view('admin.worker.tambah');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'type' => 'required|in:Mangkal,Keliling',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make('password'), // Password default, worker bisa ganti nanti
                'role' => 'worker',
                'email_verified_at' => now(),
            ]);

            $user->worker()->create([
                'worker_type' => $request->type,
                'is_active' => ($request->status === 'aktif'),
                'location_name' => 'Belum diatur', // Nilai default
            ]);
        });

        return redirect()->route('admin.worker.index')->with('success', 'Worker baru berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        abort_if($user->role !== 'worker', 404);
        $user->load('worker');
        return view('admin.worker.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
            'type' => 'required|in:Mangkal,Keliling',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        DB::transaction(function () use ($request, $user) {
            $user->update(['name' => $request->name, 'email' => $request->email]);
            $user->worker()->update([
                'worker_type' => $request->type,
                'is_active' => ($request->status === 'aktif'),
            ]);
        });

        return redirect()->route('admin.worker.index')->with('success', 'Data worker berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        // Migrasi Anda sudah memiliki onDelete('cascade'), jadi data worker akan ikut terhapus
        $user->delete();
        return redirect()->route('admin.worker.index')->with('success', 'Worker berhasil dihapus.');
    }

    public function showLocations()
    {
        // Mengambil lokasi worker (kode ini sudah benar)
        $activeWorkers = User::where('role', 'worker')
            ->whereHas('worker', function ($query) {
                $query->where('is_active', true)->whereNotNull(['current_latitude', 'current_longitude']);
            })
            ->with('worker')->get();

        $active_locations = $activeWorkers->map(function ($user) {
            return [
                'worker' => $user->name,
                'location' => [
                    'lat' => (float) $user->worker->current_latitude,
                    'lng' => (float) $user->worker->current_longitude
                ]
            ];
        });

        $activeArea = ServiceArea::where('is_active', true)->first();
        $serviceAreaPolygon = [];

        if ($activeArea) {
            $decodedCoords = json_decode($activeArea->polygon_coordinates, true);

            if (json_last_error() === JSON_ERROR_NONE && isset($decodedCoords[0]) && is_array($decodedCoords[0])) {

                // 2. Lakukan perulangan dan tukar urutan [lng, lat] menjadi [lat, lng] untuk Leaflet
                foreach ($decodedCoords[0] as $coord) {
                    // Pastikan $coord adalah array dengan 2 elemen sebelum menukar
                    if (is_array($coord) && count($coord) === 2) {
                        $serviceAreaPolygon[] = [$coord[1], $coord[0]]; // Tukar posisi
                    }
                }
            }
        }

        return view('admin.worker.location-chart', [
            'active_locations' => $active_locations->all(),
            'serviceAreaPolygon' => $serviceAreaPolygon         
        ]);
    }
}
