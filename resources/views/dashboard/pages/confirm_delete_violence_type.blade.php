@extends('dashboard.layouts.default')

@section('content')

    <div class="card shadow-sm p-3 text-center confirmation-dialog" >
       <h4>Confirm Delete?</h4>
       <p>Are you sure you want to delete this Violence Type?</p>
       <br>
       <div class="d-flex text-center">
           <form action="{{ route('violence.type.delete') }}" method="POST">
               @csrf 
               @method('DELETE')
               <input type="hidden" name="id" value={{ $id }}>
               <a href="{{ route('violence.types.view') }}" class="btn btn-outline-primary text-sm btn-sm">Cancel</a>
               <input type="submit" class="btn btn-outline-danger text-sm btn-sm" value="Delete">
           </form>
       </div>
    </div>



@endsection
