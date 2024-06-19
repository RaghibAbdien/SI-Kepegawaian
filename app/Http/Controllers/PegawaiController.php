<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class PegawaiController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show()
    {
        $pegawais = Pegawai::all();
        return view('pages.pegawai', compact('pegawais'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nip' => 'required|string|unique:pegawai|regex:/^\d+$/',
                'nama' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
                'jenis_kelamin' => 'required',
                'alamat' => 'required|string',
                'nohp' => 'required|string|min:12|max:13|unique:pegawai|regex:/^\d+$/',
                'foto' => 'required|mimes:jpeg,jpg,png|max:2048',
                'agama' => 'required',
                'pendidikan' => 'required',
            ]);

            // Ubah nama foto dan simpan ke folder foto
            $nama = $request->input('nama');
            $fotoFile = $request->file('foto');
            $fotoFileName = $nama . '_foto.' . $fotoFile->getClientOriginalExtension();
            $fotoPath = $fotoFile->storeAs('public/uploads/foto', $fotoFileName);


            Pegawai::create([
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'jenis_kelamin' => $request->input('jenis_kelamin'),
                'alamat' => $request->input('alamat'),
                'nohp' => $request->input('nohp'),
                'foto_pegawai' => $fotoPath,
                'agama' => $request->input('agama'),
                'pendidikan' => $request->input('pendidikan'),
            ]);

            return redirect()->route('pegawai')->with('success', 'Data berhasil ditambahkan');
        } catch(ValidationException $e){
            return response()->json(['errors' => $e->validator->errors()->all()], 422);
        }
         catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function hapusPegawai($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();
        
    }
}
