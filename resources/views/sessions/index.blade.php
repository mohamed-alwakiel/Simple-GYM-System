@extends('layouts.master')

@section('title')
    Sessions
@endsection

@section('content')
    <div class='container dark:bg-gray-900 w-70' id='session_data'>
        @include('sessions.index_child')
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];

                paginateFast(page);

            });

            function paginateFast(page) {


                $.ajax({
                    url: "{{ route('sessions.paginate') }}" + "?page=" + page,
                    method: "GET",

                    success: function(data) {


                        $('#session_data').html(data);
                    }
                });
            }


        });
    </script>
@endpush
