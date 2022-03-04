 @extends('layouts.master')

 @section('title')
     Gym Managers
 @endsection

 @section('content')
     <div class="pt-4">

         <form class="mt-5 w-50 mx-auto" action="{{ route('gymManagers.update', $gymManager->id) }}" method="post">
             @csrf
             @method('put')

             <input type="hidden" name="id" value="{{ $gymManager->id }}">


             <div class="mb-3">
                 <label class="form-label"> Manager Name </label>
                 <input type="text" value="{{ $gymManager->name }}" name="name" class="form-control">
             </div>
             @error('name')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror

             <div class="mb-3">
                 <label class="form-label"> Email </label>
                 <input type="email" value="{{ $gymManager->email }}" name="email" class="form-control">
             </div>
             @error('email')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror

             <div class="mb-3">
                 <label class="form-label"> National ID </label>
                 <input type="text" name="national_id" class="form-control" value="{{ $gymManager->national_id }}"
                     onkeypress="return event.charCode > 47 && event.charCode < 58;" />
             </div>
             @error('national_id')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror

             <div class="mb-3">
                 <label class="form-label">Gym</label>

                 <select name="gym_id" class="form-control">

                     @foreach ($gyms as $gym)
                         <option value="{{ $gym->id }}" {{ $gymManager->gym_id == $gym->id ? 'SELECTED' : '' }}>
                             {{ $gym->name }}</option>
                     @endforeach

                 </select>

             </div>

             <div class="d-flex justify-content-end">
                 <button type="submit" class="btn btn-success py-2 px-4">Update</button>
             </div>

         </form>
     </div>
 @endsection
