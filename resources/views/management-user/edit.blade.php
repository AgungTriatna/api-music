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
                            <h4>Edit User {{ $user->users_name }}</h4>
                        </div>
                      
                        <form action="{{ route('update/user',$user->id) }}" method="post">
                            @csrf
                            <div class="card-body">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" name="users_name" value="{{ $user->users_name }}">
                                <br>
                                <label for="">User Email</label>
                                <input type="text" class="form-control" name="users_email" value="{{ $user->users_email }}">
                                <br>
                                <label for="">User Role</label>
                                <select name="users_role" id="" class="form-control">
                                    <option value="admin" {{ $user->users_role == 'admin' ? 'selected' : '' }}>admin</option>
                                    <option value="user"  {{ $user->users_role == 'user' ? 'selected' : '' }}>user</option>
                                    <option value="creator"  {{ $user->users_role == 'creator' ? 'selected' : '' }}>creator</option>
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