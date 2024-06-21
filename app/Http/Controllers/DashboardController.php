<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $idPegawai = auth()->id();
        $jmlhPegawai = Pegawai::where('status', true)->count();
        $jmlhAbsensi = Absensi::all()->count();
        $jmlhAbsensiUser = Absensi::where('id_pegawai', $idPegawai)->count();
        $jumlahBlnPegawai = Pegawai::select(DB::raw('MONTH(created_at) as bulan'), DB::raw('count(*) as jumlah'))
            ->groupBy('bulan')
            ->get()
            ->pluck('jumlah', 'bulan');

        // Membuat array jumlah pegawai untuk setiap bulan
        $jumlahPegawaiPerBulan = [];
        for ($i = 1; $i <= 12; $i++) {
            $jumlahPegawaiPerBulan[] =  $jumlahBlnPegawai->get($i, 0); // Default 0 jika tidak ada data untuk bulan tersebut
        }
        return view('pages.dashboard', compact('jmlhPegawai', 'jmlhAbsensi', 'jmlhAbsensiUser'), ['jumlahPegawaiPerBulan' => $jumlahPegawaiPerBulan]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
