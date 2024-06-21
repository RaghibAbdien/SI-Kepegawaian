<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;
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
                'email' => 'required|email|unique:pegawai',
                'password' => 'required',
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
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
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

    public function editPegawai(Request $request, $id)
    {
        $pegawai = Pegawai::findOrFail($id);

        try {
            $request->validate([
                'nip' => 'required|string|regex:/^\d+$/|unique:pegawai,nip,' . $pegawai->id,
                'nama' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/',
                'email' => 'required|email|unique:pegawai,email,' . $pegawai->id,
                'password' => 'sometimes',
                'jenis_kelamin' => 'required',
                'alamat' => 'required|string',
                'nohp' => 'required|string|min:12|max:13|regex:/^\d+$/|unique:pegawai,nohp,' .$pegawai->id,
                'foto' => 'sometimes|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required',
                'agama' => 'required',
                'pendidikan' => 'required',
            ]);

            if ($request->filled('password')) {
                $pegawai->password = bcrypt($request->password);
            }

            if ($request->hasFile('foto')) {
                if ($pegawai->foto) {
                    Storage::delete($pegawai->foto);
                }
                $nama = $request->input('nama');
                $fotoFile = $request->file('foto');
                $fotoFileName = $nama . '_foto.' . $fotoFile->getClientOriginalExtension();
                $fotoPath = $fotoFile->storeAs('public/uploads/foto', $fotoFileName);
                $pegawai->foto_pegawai = $fotoPath;
            }

            $pegawai->nip = $request->nip;
            $pegawai->nama = $request->nama;
            $pegawai->email = $request->email;
            $pegawai->jenis_kelamin = $request->jenis_kelamin;
            $pegawai->alamat = $request->alamat;
            $pegawai->nohp = $request->nohp;
            $pegawai->status = $request->status;
            $pegawai->agama = $request->agama;
            $pegawai->pendidikan = $request->pendidikan;
            $pegawai->save();

            return redirect()->back()->with('success', 'Data berhasil diubah');
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
