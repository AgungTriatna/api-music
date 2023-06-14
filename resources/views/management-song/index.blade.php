@extends('layouts.template')

@section('content')


<div class="page-heading">
    <h3>Management Song</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-12">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List Song</h4>
                            <a href="{{ url('create/song') }}" class="btn btn-primary" style="float: right">+ Create</a>
                        </div>
                        @if(session()->has('success'))
                            <div class="alert alert-success" style="background-color:#00ef05!important">
                                {{ session()->get('success') }}
                            </div>
                        @elseif (session()->has('failed'))
                            <div class="alert alert-success" style="background-color:red!important">
                                {{ session()->get('failed') }}
                            </div>
                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Cover</th>
                                            <th>Song</th>
                                            <th>Release Date</th>
                                            <th>Status</th>
                                            <th>Album</th>
                                            <th>Moode</th>
                                            <th>Genre</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($song as $item)
                                            <tr>
                                                <td>{{ $item->songs_title }}</td>
                                                <td> <img src="{{ $item->songs_cover }}" alt="" style="max-width: 100px"></td>
                                                <td>{{ $item->songs_song }}</td>
                                                <td>{{ $item->songs_release_date }}</td>
                                                <td>{{ $item->songs_status }}</td>
                                                @php
                                                    $album = App\Models\Album::where('id',$item->albums_id)->first();
                                                @endphp
                                                <td>{{ $album->albums_title }}</td>
                                                <td>{{ $item->songs_mood }}</td>
                                                <td>{{ $item->songs_genre }}</td>
                                                <td>{{ $item->created_at }}</td>
                                                <td> <a href="{{ route('edit/song',$item->id) }}">Edit</a> | <a href="{{ route('delete/song',$item->id) }}">Delete</a>  </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       
    </section>
</div>

@endsection