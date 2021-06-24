@extends('layouts.app')
@section('content')


    <div class="row">
        <div class="col-12">
            <div class="card py-3 mt-3">


                <div class="card-body">

                    <div class="card-title d-flex justify-content-between">
                        <h5>Players List</h5>
                        <h5>{{auth()->user()->name}}</h5>

                    </div>


                    <table class="table table-bordered mt-5">
                        <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Action</th>
                        </tr>
                        </thead>


                        <tbody>

                        @foreach($users as $user)

                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->mobile_no}}</td>
                                <td>
                                    <a href="{{route('chat',$user)}}">Let's GO</a>
                                </td>

                            </tr>

                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection


@section('scripts')


@endsection




