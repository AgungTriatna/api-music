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
                            <h4>Create User</h4>
                        </div>
                      
                        <form action="{{ route('store/user') }}" method="post">
                            @csrf
                            <div class="card-body">
                                <label for="">User Name</label>
                                <input type="text" class="form-control" name="users_name">
                                <br>
                                <label for="">User Email</label>
                                <input type="text" class="form-control" name="users_email">
                                <br>
                                <label for="">User Role</label>
                                <select name="users_role" id="" class="form-control">
                                    <option value="admin">admin</option>
                                    <option value="user">user</option>
                                    <option value="creator">creator</option>
                                </select>
                                <br>
                                <label for="">Password</label>
                                <input type="password" class="form-control" name="users_password">
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