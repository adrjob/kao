@extends('layouts.app', [
    'parentSection' => 'tables',
    'elementName' => 'datatables'
])

@section('content')
    @component('layouts.headers.auth')
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">{{ __('Client') }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">

                </nav>
            </div>

                <div class="col-lg-6 col-5 text-right">
                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-sm btn-neutral" style="background-color: #4cb04f !important; border: #4cb04f !important; color: white !important;">{{ __('New') }}</a>
                </div>



        </div>
    @endcomponent

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('client.store') }}" >
                <div class="modal-body">
                        @csrf

                    @php
                        use Illuminate\Support\Facades\Auth;

            $user = \auth()->user();;
                    @endphp

                    <input type="hidden" name="sub_id" value="{{ $user->id }}">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Main" name="main">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Spouse" name="spouse">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 1" name="child1">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 2" name="child2">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 3" name="child3">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 4" name="child4">
                            </div>
                        </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 5" name="child5">
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" placeholder="Child 6" name="child6">
                            </div>
                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid mt--6" >
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->

                    <div class="table-responsive py-4">
                        <table class="table table-flush" id="datatable-buttons">
                            <thead class="thead-light">
                            <tr>
                                <th>Name</th>
{{--                                <th>Status</th>--}}
                                <th>Created Date</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tfoot>

                            </tfoot>
                            <tbody>
                            @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->name }}</td>
{{--                                <td>--}}
{{--                                    @if($client->status == 0)--}}
{{--                                        {{ __('In Process') }}--}}
{{--                                    @else--}}
{{--                                        {{ __('Completed') }}--}}
{{--                                    @endif--}}
{{--                                </td>--}}
                                <td>{{ $client->created_at }}</td>
                                <td>
                                    <a href="{{ route('client.show', $client->id) }}">
                                    <i class="fa fa-eye" aria-hidden="true" style="color: green"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        @include('layouts.footers.auth')
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('argon') }}/vendor/datatables.net-select-bs4/css/select.bootstrap4.min.css">
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
@endpush
