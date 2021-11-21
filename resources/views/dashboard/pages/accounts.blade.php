@extends('dashboard.layouts.default')

@section('content')

    <div class="content-navigation-section">
        <h5>Accounts</h5>
        <a href="#" class="text text-primary">Back</a>
    </div>

    <div class="container">

         @if(Auth()->user()->type == 1)
            <a href="{{ route('user.create') }}" class="btn btn-info btn-sm">Create New Account</a> 
         @endif

        <br> <br>

        <div class="card p-4">
          

            <table class="table">

                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Avatar</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>

                <tbody>
                    @if(count($user_accounts) > 0)

                        @foreach($user_accounts as $account)

                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $account->name }}</td>
                                <td>{{ $account->email }}</td>
                                <td>
                                    @if($account->contact != null)
                                        {{ $account->contact }}
                                    @else 
                                        No Contact
                                    @endif
                                </td>
                                <td>{{ $account->password != null ? 'Hashed Password' : 'No Password'}}</td>
                                <td>
                                    @if($account->type == 1)
                                        Administrator
                                    @elseif($account->type == 2)
                                        Activist  
                                    @else 
                                        Victim
                                    @endif
                                    
                                </td>
                                <td>
                                    @if($account->avatar !== null)
                                        <img src="{{ asset($account->avatar) }}" height="170" width="150" alt="Avatar">
                                    @else 
                                        No Avatar
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning">Edit</a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger">Delete</a>
                                </td>
                            </tr>

                        @endforeach

                    @endif
                </tbody>

            </table>

            {!! $user_accounts->links() !!}
            
             
        </div>
    </div>

@endsection