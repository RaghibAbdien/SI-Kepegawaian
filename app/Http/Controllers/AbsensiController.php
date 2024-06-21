<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;

class AbsensiController extends Controller
{
    public function show()
    {
        $pegawai = auth()->user();
        $allAbsensi = Absensi::with('pegawai')->get();
        $absensis = Absensi::with('pegawai')->where('id_pegawai', $pegawai->id)->get();
        return view('pages.absensi', compact('pegawai', 'absensis', 'allAbsensi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_pegawai' => 'required|exists:pegawai,id',
                'waktu_kehadiran' => 'required|date',
            ]);

            Absensi::create([
                'id_pegawai' => $request->input('id_pegawai'),
                'waktu_kehadiran' => $request->input('waktu_kehadiran'),
            ]);

            return redirect()->route('absensi')->with('success', 'Absensi berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        $absensi = Absensi::findOrFail($id);
        $absensi->delete();

        return response()->json(['message' => 'Absensi berhasil dihapus']);
    }
}
