<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Models\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class ManagementSongController extends Controller
{
    public function index(){
        $data['song'] = Song::get();
        // dd($data['song']);
        return view('management-song.index',$data);
    }
    public function create(){
        $data['song'] = Song::get();
        $data['album'] = Album::get();
        // dd($data['song']);
        return view('management-song.create',$data);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'cover' => 'required|mimes:png,jpg,jpeg|max:2048',
            'song' => 'required|file|mimes:mp3',
            'release_date' => 'nullable|date',
            'status' => 'nullable|in:Pending,Published,Unpublished',
            'id_album' => 'nullable|exists:albums,id',
            'mood' => 'nullable|in:Bahagia,Sedih,Romantis,Santai,Enerjik,Motivasi,Eksperimental,Sentimental,Menghibur,Gelisah,Inspiratif,Tenang,Semangat,Melankolis,Penuh energi,Memikat,Riang,Reflektif,Optimis,Bersemangat',
            'genre' => 'nullable|in:Pop,Rock,Hip-Hop,R&B,Country,Jazz,Electronic,Dance,Reggae,Folk,Classical,Alternative,Indie,Metal,Punk,Blues,Soul,Funk,Latin,World',
        ]);

        if ($validator->fails()) {
            return redirect()->route('management/song')->with(['failed' => $validator->errors()]);
        }

        $file = $request->file('song');
        $laguExtension = $file->getClientOriginalExtension();
        $laguName = uniqid() . '_' . time() . '.' . $laguExtension;
        $laguPath = 'songs/' . $laguName;
        $file->move(public_path('songs'), $laguPath);
        $laguUrl = asset($laguPath);

        $cover = $request->file('cover');
        $coverExtension = $cover->getClientOriginalExtension();
        $coverName = uniqid() . '_' . time() . '.' . $coverExtension;
        $coverPath = 'covers/' . $coverName;
        $cover->move(public_path('covers'), $coverPath);
        $coverUrl = asset($coverPath);

        $song = new Song();
        $song->songs_title = $request->title;
        $song->songs_cover = $coverUrl;
        $song->songs_song = $laguUrl;
        $song->songs_release_date = $request->release_date ?? now();
        $song->songs_status = $request->status ?? 'pending'; // Menggunakan nilai default 'pending' jika status tidak disertakan dalam request
        $song->users_id = Auth::user()->id;
        $song->albums_id = $request->id_album;
        $song->songs_mood = $request->mood;
        $song->songs_genre = $request->genre;
        $song->save();


        return redirect()->route('management/song')->with(['success' => 'Lagu berhasil diunggah!']);

    }

    public function edit($id){
        $data['song'] = Song::find($id);
        $data['album'] = Album::get();
        // dd($data['song']);
        return view('management-song.edit',$data);
    }


     //Edit lagu
     public function update(Request $request, $id)
     {
 
         $validator = Validator::make($request->all(), [
             'title' => 'required|string',
             'cover' => 'nullable|mimes:png,jpg,jpeg|max:2048',
             'song' => 'nullable|file|mimes:mp3',
             'release_date' => 'required|date',
             'status' => 'nullable|in:Pending,Published,Unpublished',
             'id_album' => 'nullable|exists:albums,id',
             'mood' => 'nullable|in:Bahagia,Sedih,Romantis,Santai,Enerjik,Motivasi,Eksperimental,Sentimental,Menghibur,Gelisah,Inspiratif,Tenang,Semangat,Melankolis,Penuh energi,Memikat,Riang,Reflektif,Optimis,Bersemangat',
             'genre' => 'nullable|in:Pop,Rock,Hip-Hop,R&B,Country,Jazz,Electronic,Dance,Reggae,Folk,Classical,Alternative,Indie,Metal,Punk,Blues,Soul,Funk,Latin,World',
         ]);
 
         if ($validator->fails()) {
            return redirect()->route('management/song')->with(['failed' => $validator->errors()]);

         }
 
         $song = Song::find($id);
 
         if (!$song) {
            return redirect()->route('management/song')->with(['failed' => 'Song not found']);
         }
 
 
         // Update data lagu
         $song->songs_title = $request->title;
         $song->songs_release_date = $request->release_date;
         $song->songs_status = $request->status ?? 'pending'; // Menggunakan nilai default 'pending' jika status tidak disertakan dalam request
         $song->users_id = Auth::user()->id;
         $song->albums_id = $request->id_album;
         $song->songs_mood = $request->mood;
         $song->songs_genre = $request->genre;
 
         // Cek apakah ada file cover yang diunggah
         if ($request->hasFile('cover')) {
             $cover = $request->file('cover');
             $coverExtension = $cover->getClientOriginalExtension();
             $coverName = uniqid() . '_' . time() . '.' . $coverExtension;
             $coverPath = 'covers/' . $coverName;
             $cover->move(public_path('covers'), $coverPath);
             $coverUrl = asset($coverPath);
 
             // Menghapus file cover lama jika ada
             if ($song->songs_cover) {
                 $oldCoverPath = public_path('covers/' . basename($song->songs_cover));
                 if (file_exists($oldCoverPath)) {
                     unlink($oldCoverPath);
                 }
             }
 
             $song->songs_cover = $coverUrl;
         }
 
         if ($request->hasFile('lagu')) {
             $file = $request->file('lagu');
             $laguExtension = $file->getClientOriginalExtension();
             $laguName = uniqid() . '_' . time() . '.' . $laguExtension;
             $laguPath = 'songs/' . $laguName;
             $file->move(public_path('songs'), $laguPath);
             $laguUrl = asset($laguPath);
 
             // Menghapus file lagu lama jika ada
             if ($song->songs_song) {
                 $oldCoverPath = public_path('songs/' . basename($song->songs_song));
                 if (file_exists($oldCoverPath)) {
                     unlink($oldCoverPath);
                 }
             }
 
             $song->songs_song = $laguUrl;
         }
 
         $song->save();

        return redirect()->route('management/song')->with(['success' => 'Lagu berhasil diubah!']);
     }

     public function delete($id){
        $song = Song::find($id);

        if (!$song) {
            return redirect()->route('management/song')->with(['failed' => 'Song not found']);
        }

        // Menghapus entri yang terkait dalam tabel view_song
        DB::table('view_song')->where('songs_id', $id)->delete();

        $song->delete();

        $oldCoverPath = public_path('songs/' . basename($song->songs_song));
        if (file_exists($oldCoverPath)) {
            unlink($oldCoverPath);
        }

        $oldCoverPath = public_path('covers/' . basename($song->songs_cover));
        if (file_exists($oldCoverPath)) {
            unlink($oldCoverPath);
        }

        return redirect()->route('management/song')->with(['success' => 'Lagu berhasil dihapus!']);
     }
 
}
