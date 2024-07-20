@extends('layouts.master')
@section('content')
    <div class="search-container">
        <input type="text" id="search" placeholder="Search Users, departments, designations...">
    </div>
    <div class="product-container div_data" id="product-container">
    @if($users->isEmpty())
            <p>No users found</p>
        @else
        @foreach($users as $user)
            <div class="product-card">
                <h2>{{ $user->name }}</h2>
                <p>Phone Number: {{ $user->phone_number}}</p>
                <p>Department: {{ $user->department->name ?? 'No Department' }}</p>
                <p>Designation: {{ $user->designation->name ?? 'No Designation' }}</p>
            </div>
           
        @endforeach
        @endif
    </div>

    <script>
       $(document).ready(function() {
    $('#search').on('keyup', function() {
        var query = $(this).val();
        $.ajax({
            url: "{{ route('users.index') }}", // Ensure this route is correct
            method: 'GET',
            data: { search: query },
            success: function(response) {
                // Clear the existing content
                $('.div_data').empty();
                
                // Check if there are users
                if (response.users.length) {
                    response.users.forEach(function(user) {
                        $('.div_data').append(`
                            <div class="product-card">
                                <h2>${user.name}</h2>
                                <p>Phone Number: ${user.phone_number}</p>
                                <p>Department: ${user.department ? user.department.name : 'No Department'}</p>
                                <p>Designation: ${user.designation ? user.designation.name : 'No Designation'}</p>
                            </div>
                        `);
                    });
                } else {
                    $('.div_data').append('<p>No results found</p>');
                }
            },
            error: function(xhr) {
                console.error('Error occurred:', xhr.responseText);
            }
        });
    });
});

    </script>
    @endsection

