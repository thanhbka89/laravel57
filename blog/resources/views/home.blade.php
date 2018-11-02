@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Manage Permission</div>

                <div class="panel-body">

                    @if(checkPermission(['user','admin','superadmin']))
                    <a href="{{ url('permissions-all-users') }}"><button>Access All Users</button></a>
                    @endif

                    @if(checkPermission(['admin','superadmin']))
                    <a href="{{ url('permissions-admin-superadmin') }}"><button>Access Admin and Superadmin</button></a>
                    @endif

                    @if(checkPermission(['superadmin']))
                    <a href="{{ url('permissions-superadmin') }}"><button>Access Only Superadmin</button></a>
                    @endif

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
