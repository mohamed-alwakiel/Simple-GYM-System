 @extends('layouts.master')

 @section('title')
     City Managers
 @endsection

 @section('content')
     <div class="pt-4">


         <form class="mt-5 w-50 mx-auto" action="{{ route('cityManagers.update', $cityManager->id) }}" method="post">
             @csrf
             @method('put')

             <input type="hidden" name="id" value="{{ $cityManager->id }}">

             <div class="mb-3">
                 <label class="form-label"> Manager Name </label>
                 <input type="text" value="{{ $cityManager->name }}" name="name" class="form-control">
             </div>
             @error('name')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror

             <div class="mb-3">
                 <label class="form-label"> Email </label>
                 <input type="email" value="{{ $cityManager->email }}" name="email" class="form-control">
             </div>
             @error('email')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror

             <div class="mb-3">
                 <label class="form-label"> National ID </label>
                 <input type="number" value="{{ $cityManager->national_id }}" name="national_id" class="form-control">
             </div>
             @error('national_id')
                 <div class="alert alert-danger">{{ $message }}</div>
             @enderror



             {{-- <div class="mb-3">
                    <label class="form-label">Post Creator</label>

                    <select name="user_id" class="form-control">

                        <option class="text-center" value="" {{ $selectedPost->user ? "" : "SELECTED" }}> -- select creator -- </option>

                        {{-- loop on users to show them in drop down list --}}
             {{-- @foreach ($users as $user)

                            <option value="{{ $user->id }}" {{ $selectedPost['user_id'] == $user->id ? "SELECTED" : "" }}>{{ $user->name }}</option>
                        @endforeach

                    </select>

                </div> --}}

             <div class="d-flex justify-content-end">

                 <button type="submit" class="btn btn-success py-2 px-4">Update</button>
             </div>
         </form>

     </div>
 @endsection
