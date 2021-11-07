@extends('dashboard.layouts.default')

@section('content')

    <div class="card shadow-sm p-3 text-center confirmation-dialog" >
        @if($errors->any())

        <div class="alert alert-danger">
           
             <ul>
                 @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                 @endforeach
             </ul>
        </div>

     @endif
    
       <h4>Confirm Delete?</h4>
       <p>Are you sure you want to delete this complaint?</p>
       <br>
       <div class="d-flex text-center">
           <form action="{{ route('delete.user.complaint') }}" method="POST">
               @csrf 
               @method('DELETE')
               <input type="hidden" name="id" value={{ $id }}>
               <a href="{{ route('my.complaints') }}" class="btn btn-outline-primary text-sm btn-sm">Cancel</a>
               <input type="submit" class="btn btn-outline-danger text-sm btn-sm" value="Delete">
           </form>
       </div>
    </div>



@endsection
