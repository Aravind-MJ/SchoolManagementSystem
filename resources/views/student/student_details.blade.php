@extends('layouts.layout')

@section('title', 'Student Profile')

@section('content')

@section('body')

<div class="col-md-6 col-md-offset-2">
    <div class="box box-primary">
        <div class="box-body">
            <div class="box-header">
                <h2 class="box-title"><strong> Student Profile</strong></h2>
            </div>

            <table id="example2" class="table table-bordered table-hover">
                <tbody>                   
                    <tr><th>First name</th><td>{{ $student->first_name }}</td></tr>
                    <tr><th>Last name</th><td>{{ $student->last_name}}</td></tr>
                    <tr><th>Class</th><td>{{$student->class}}</td></tr>
                    <tr><th>Gender</th><td>{{ $student->gender }}</td></tr>
                    <tr><th>Religion</th><td>{{$student->religion}}</td></tr>
                    <tr><th>category</th><td>{{$student->category}}</td></tr>
                    <tr><th>hostel</th><td>{{ strtoupper($student->hostel)}}</td></tr>
                    @if($student->hostel=='yes')
                    <tr><th>hostelfee</th> <td>{{ strtoupper($student->hostelfee)}}</td></tr>
                    @endif
                    <tr><th>DOB</th><td>{{ date('d/m/Y',strtotime($student->dob))}}</td></tr>
                    <tr><th>Email</th><td>{{ $student->email }}</td></tr>
                    <tr><th>Guardian</th><td>{{ $student->guardian }}</td></tr>
                    <tr><th>Address</th><td>{{ $student->housename }}</td></tr>
                    <tr><th>Place</th><td>{{ $student->place}}</td></tr>
                    <tr><th>District</th><td>{{ $student->district}}</td></tr>
                    <tr><th>State</th> <td>{{ $student->state}}</td></tr>
                    <tr><th>Phone</th><td>{{ $student->phone }}</td></tr>
                    <tr><th>Adhaar Number</th><td>{{ $student->adhar }}</td></tr>
                    <tr><th>Sampoorna ID</th><td>{{ $student->sampoorna}}</td></tr>
                    <tr><th>School</th><td>{{ $student->school }}</td></tr>
                    
                    <tr><th>Photo</th><td><img src="{{ asset('images/students/'. $student->photo) }}"  alt="photo" width="50" height="50"/></td></tr>                   
                    <tr>                      
                        <td><a href='{{ $student->enc_id }}/edit' class='btn btn-primary btn-block'>Edit Student</a>
                        </td>                   


                </tr>
                </tbody>

            </table>
        </div>
    </div>
</div>
@stop
@section('confirmDelete')
<script>
    $(".delete").on("submit", function(){
        return confirm("Do you want to delete this item?");
    });
</script>
@stop
@endsection