 @extends('layouts.master')

@section('title')
    Gym Managers
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">




            <form action="{{ route('gymManagers.update', $gymManager->id) }}" method="post">

                @csrf
                @method('put')


                <label for="">name</label>
                <input type="text" name="name" value="{{ $gymManager->name }}"><br>

                <label for="">email</label>
                <input type="email" name="email" value="{{ $gymManager->email }}"><br>

                <label for="">national id</label>
                <input type="number" name="national_id" value="{{ $gymManager->national_id }}"><br>

                <label for="">profile img</label>
                <input type="text" name="img" value="{{ $gymManager->profile_img }}"><br>

                <button type="submit">Update</button>

            </form>










    </div>
    <!-- /.content-wrapper -->
@endsection
