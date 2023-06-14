@extends('layouts.template')

@section('content')


<div class="page-heading">
    <h3>Management User</h3>
</div>
<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>List User</h4>
                            <a href="{{ url('create/user') }}" class="btn btn-primary" style="float: right">+ Create</a>
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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr>
                                                <td>{{ $item->users_name }}</td>
                                                <td>{{ $item->users_email }}</td>
                                                <td>{{ $item->users_role }}</td>
                                                <td> <a href="{{ route('edit/user',$item->id) }}">Edit</a> | <a href="{{ route('delete/user',$item->id) }}">Delete</a>  </td>
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