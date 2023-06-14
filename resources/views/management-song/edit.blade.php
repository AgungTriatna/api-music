@extends('layouts.template')

@section('content')


<div class="page-heading">
    <h3>Management Song</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Update Song</h4>
                        </div>
                      
                        <form action="{{ route('update/song',$song->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title" value="{{ $song->songs_title }}">
                                <br>
                                <label for="">Cover</label>
                                <br>
                                <img src="{{ $song->songs_cover }}" alt="" style="max-width: 100px">
                                <br>
                                <br>
                                <input type="file" class="form-control" name="cover" value="{{ $song->songs_cover }}">
                                <br>
                                <label for="">Release</label>
                                <input type="date" class="form-control" name="release_date" value="{{ $song->songs_release_date }}">
                                <br>
                                <label for="">Song</label>
                                <br>
                                <a href="{{ $song->songs_song }}">{{ $song->songs_song }}</a>
                                <input type="file" class="form-control" name="song" value="{{ $song->songs_song }}">
                                <br>
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="Pending" {{ $song->songs_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="Published" {{ $song->songs_status == 'Published' ? 'selected' : '' }}>Published</option>
                                    <option value="Unpublished" {{ $song->songs_status == 'Unpublished' ? 'selected' : '' }}>Unpublished</option>
                                </select>
                                <br>
                                <label for="">Album</label>
                                <select name="id_album" id="" class="form-control">
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}" {{ $song->albums_id == $item->id ? 'selected' : '' }}>{{ $item->albums_title }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label for="">Mood</label>
                                <select name="mood" id="" class="form-control">
                                    <option value="Bahagia" {{ $song->songs_mood == 'Bahagia' ? 'selected' : '' }}>Bahagia</option>
                                    <option value="Sedih" {{ $song->songs_mood == 'Sedih' ? 'selected' : '' }}>Sedih</option>
                                    <option value="Romantis" {{ $song->songs_mood == 'Romantis' ? 'selected' : '' }}>Romantis</option>
                                    <option value="Semangat" {{ $song->songs_mood == 'Semangat' ? 'selected' : '' }}>Semangat</option>
                                    <option value="Santai" {{ $song->songs_mood == 'Santai' ? 'selected' : '' }}>Santai</option>
                                    <option value="Enerjik" {{ $song->songs_mood == 'Enerjik' ? 'selected' : '' }}>Enerjik</option>
                                    <option value="Motivasi" {{ $song->songs_mood == 'Motivasi' ? 'selected' : '' }}>Motivasi</option>
                                    <option value="Eksperimental" {{ $song->songs_mood == 'Eksperimental' ? 'selected' : '' }}>Eksperimental</option>
                                    <option value="Sentimental" {{ $song->songs_mood == 'Sentimental' ? 'selected' : '' }}>Sentimental</option>
                                    <option value="Menghibur" {{ $song->songs_mood == 'Menghibur' ? 'selected' : '' }}>Menghibur</option>
                                </select>
                                <br>
                                <label for="">Genre</label>
                                <select name="genre" id="" class="form-control">
                                    <option value="Pop" {{ $song->songs_genre == 'Pop' ? 'selected' : '' }}>Pop</option>
                                    <option value="Rock" {{ $song->songs_genre == 'Rock' ? 'selected' : '' }}>Rock</option>
                                    <option value="Hip" {{ $song->songs_genre == 'Hip' ? 'selected' : '' }}>Hip-Hop</option>
                                    <option value="R" {{ $song->songs_genre == 'R' ? 'selected' : '' }}>R&B</option>
                                    <option value="Country" {{ $song->songs_genre == 'Country' ? 'selected' : '' }}>Country</option>
                                    <option value="Jazz" {{ $song->songs_genre == 'Jazz' ? 'selected' : '' }}>Jazz</option>
                                    <option value="Electronic" {{ $song->songs_genre == 'Electronic' ? 'selected' : '' }}>Electronic</option>
                                    <option value="Dance" {{ $song->songs_genre == 'Dance' ? 'selected' : '' }}>Dance</option>
                                    <option value="Reggae" {{ $song->songs_genre == 'Reggae' ? 'selected' : '' }}>Reggae</option>
                                    <option value="Folk" {{ $song->songs_genre == 'Folk' ? 'selected' : '' }}>Folk</option>
                                    <option value="Classical" {{ $song->songs_genre == 'Classical' ? 'selected' : '' }}>Classical</option>
                                    <option value="Alternative" {{ $song->songs_genre == 'Alternative' ? 'selected' : '' }}>Alternative</option>
                                    <option value="Indie" {{ $song->songs_genre == 'Indie' ? 'selected' : '' }}>Indie</option>
                                    <option value="Metal" {{ $song->songs_genre == 'Metal' ? 'selected' : '' }}>Metal</option>
                                    <option value="Punk" {{ $song->songs_genre == 'Punk' ? 'selected' : '' }}>Punk</option>
                                    <option value="Blues" {{ $song->songs_genre == 'Blues' ? 'selected' : '' }}>Blues</option>
                                    <option value="Soul" {{ $song->songs_genre == 'Soul' ? 'selected' : '' }}>Soul</option>
                                    <option value="Funk" {{ $song->songs_genre == 'Funk' ? 'selected' : '' }}>Funk</option>
                                    <option value="LatinWorld" {{ $song->songs_genre == 'LatinWorld' ? 'selected' : '' }}>LatinWorld</option>
                                </select>

                            </div>
                            <div class="card-header">
                                <button type="submit" class="btn btn-primary" style="float: right">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
</div>

@endsection