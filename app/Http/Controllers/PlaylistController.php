<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\User;
use Firebase\JWT\Key;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// panggil library jwt 


class PlaylistController extends Controller
{
    public function create_playlist(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nama' => 'required|string|max:255',
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|string|max:255',
        ]);

        if($validator->fails()) {
            return messageError($validator->messages()->toArray());
        }

        $user = User::find(Auth::id());
        if (!$user) {
            return response()->json([
                'message' => 'User Tidak Ditemukan',
                'status' => 404,
            ],404);
        }

        $thumbnail = $request->file('gambar');
        $filename = now()->timestamp."_".$request->gambar->getClientOriginalName();
        $thumbnail->move('uploads',$filename); 

        $playlistData = $validator->validated();
        
        $playlist = Playlist::create([
            'nama' => $playlistData['nama'],
            'gambar' => 'uploads/'.$filename,
            'status' => 'private',
            'id_user' => $user->id,
        ]);

        // Lakukan tindakan lain, seperti mengirimkan respons atau melakukan redirect

        return response()->json([
            'message' => 'Playlist berhasil dibuat',
            'playlist' => $playlist,
        ]);
    }

    public function show_playlist(){
        // panggil resep yang berstatus publish dan relasinya dengan table user
        $playlist = Playlist::with('user')->get();

        $data = [];
        foreach($playlist as $playlist ) {
            array_push($data,[
                'nama' => $playlist->nama,
                'gambar' => url($playlist ->gambar),
                'status' => $playlist->status
            ]);
        }
        return response()->json($data,200);
    }
    
}
