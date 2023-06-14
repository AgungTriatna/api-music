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
                            <h4>Create Song</h4>
                        </div>
                      
                        <form action="{{ route('store/song') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <label for="">Title</label>
                                <input type="text" class="form-control" name="title">
                                <br>
                                <label for="">Cover</label>
                                <input type="file" class="form-control" name="cover">
                                <br>
                                <label for="">Release</label>
                                <input type="date" class="form-control" name="release_date">
                                <br>
                                <label for="">Song</label>
                                <input type="file" class="form-control" name="song">
                                <br>
                                <label for="">Status</label>
                                <select name="status" id="" class="form-control">
                                    <option value="Pending">Pending</option>
                                    <option value="Published">Published</option>
                                    <option value="Unpublished">Unpublished</option>
                                </select>
                                <br>
                                <label for="">Album</label>
                                <select name="id_album" id="" class="form-control">
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->albums_title }}</option>
                                    @endforeach
                                </select>
                                <br>
                                <label for="">Mood</label>
                                <select name="mood" id="" class="form-control">
                                    <option value="Bahagia">Bahagia</option>
                                    <option value="Sedih">Sedih</option>
                                    <option value="Romantis">Romantis</option>
                                    <option value="Semangat">Semangat</option>
                                    <option value="Santai">Santai</option>
                                    <option value="Enerjik">Enerjik</option>
                                    <option value="Motivasi">Motivasi</option>
                                    <option value="Eksperimental">Eksperimental</option>
                                    <option value="Sentimental">Sentimental</option>
                                    <option value="Menghibur">Menghibur</option>
                                </select>
                                <br>
                                <label for="">Genre</label>
                                <select name="genre" id="" class="form-control">
                                    <option value="Pop">Pop</option>
                                    <option value="Rock">Rock</option>
                                    <option value="Hip">Hip-Hop</option>
                                    <option value="R">R&B</option>
                                    <option value="Country">Country</option>
                                    <option value="Jazz">Jazz</option>
                                    <option value="Electronic">Electronic</option>
                                    <option value="Dance">Dance</option>
                                    <option value="Reggae">Reggae</option>
                                    <option value="Folk">Folk</option>
                                    <option value="Classical">Classical</option>
                                    <option value="Alternative">Alternative</option>
                                    <option value="Indie">Indie</option>
                                    <option value="Metal">Metal</option>
                                    <option value="Punk">Punk</option>
                                    <option value="Blues">Blues</option>
                                    <option value="Soul">Soul</option>
                                    <option value="Funk">Funk</option>
                                    <option value="LatinWorld">LatinWorld</option>
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