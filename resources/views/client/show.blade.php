@extends('layouts.app', [
    'parentSection' => 'tables',
    'elementName' => 'datatables'
])

@section('content')
    @component('layouts.headers.auth')
        <div class="row align-items-center py-4">
            <div class="col-lg-6 col-7">
                <h6 class="h2 text-white d-inline-block mb-0">{{ __('Client Documents') }}</h6>
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                </nav>
            </div>
        </div>
    @endcomponent

    @php
        use Illuminate\Support\Facades\Auth;

$user = \auth()->user();;
    @endphp

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $clients->name }}</h1>
            </div>
        </div>
        <!-- Table -->
        <div class="row">
            <div class="col">
                <div class="card">
                    <!-- Card header -->
                    <div class="card-header">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#main" role="tab" aria-controls="nav-home" aria-selected="true">
                                    @if($clients->name){{ $clients->name }}@endif
                                </a>

                                @if($clients->spouse)
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#spouse" role="tab" aria-controls="nav-profile" aria-selected="false">
                                    @if($clients->spouse){{ $clients->spouse }}@endif</a>
                                @endif

                                @if($clients->child1)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child1" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child1){{ $clients->child1 }}@endif
                                </a>
                                @endif

                                @if($clients->child2)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child2" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child2){{ $clients->child2 }}@endif
                                </a>
                                @endif

                                @if($clients->child3)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child3" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child3){{ $clients->child3 }}@endif
                                </a>
                                @endif

                                @if($clients->child4)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child4" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child4){{ $clients->child4 }}@endif
                                </a>
                                @endif

                                @if($clients->child5)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child5" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child5){{ $clients->child5 }}@endif
                                </a>
                                @endif

                                @if($clients->child6)
                                <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#child6" role="tab" aria-controls="nav-contact" aria-selected="false">
                                    @if($clients->child6){{ $clients->child6 }}@endif
                                </a>
                                @endif
                            </div>
                        </nav>
                    </div>
                    <div class="table-responsive py-4">

                        <div class="tab-content" id="nav-tabContent">
                            <!-- Main -->
                            @if($clients->name)
                            <div class="tab-pane active" id="main" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <table class="table table-flush" id="datatable-buttons1">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="280">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'main')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @elseif(!$document->images)
                                                        <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                            @csrf
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Spouse -->
                            @if($clients->spouse)
                            <div class="tab-pane fade" id="spouse" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons2">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'spouse')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child1 -->
                            @if($clients->child1)
                            <div class="tab-pane fade" id="child1" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons3">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child1')
                                            <tr>
                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child2 -->
                            @if($clients->child2)
                            <div class="tab-pane fade" id="child2" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons4">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child2')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child3 -->
                            @if($clients->child3)
                            <div class="tab-pane fade" id="child3" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons5">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child3')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child4 -->
                            @if($clients->child4)
                            <div class="tab-pane fade" id="child4" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons6">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child4')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child5 -->
                            @if($clients->child5)
                            <div class="tab-pane fade" id="child5" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons7">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child5')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif

                            <!-- Child6 -->
                            @if($clients->child6)
                            <div class="tab-pane fade" id="child6" role="tabpanel" aria-labelledby="nav-contact-tab">
                                <table class="table table-flush" id="datatable-buttons8">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Stage</th>
                                        <th>Status</th>
                                        <th class="text-right" width="90">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($documents as $document)
                                        @if($document->applicant_type == 'child6')
                                            <tr>

                                                <td>{{ $document->name }}</td>
                                                <td>{{ $document->type }}</td>
                                                <td>
                                                    @if(!$document->images)
                                                        {{ __('Please Upload Image') }}
                                                    @elseif($document->images and $document->images['status'] == 0)
                                                        @if($user->role_id == 1)
                                                            <div class="row">
                                                                <form method="post" action="{{ route('image.update', $document->images['id']) }}" autocomplete="off">
                                                                    @csrf
                                                                    @method('put')
                                                                    <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                                    <button class="btn btn-sm btn-success" name="status" value="2" type="submit">Approve</button>
                                                                    <button class="btn btn-sm btn-danger" name="status" value="1" type="submit">Decline</button>
                                                                </form>
                                                            </div>
                                                        @else
                                                            {{ __('Waiting Approval') }}
                                                        @endif
                                                    @elseif($document->images and $document->images['status'] == 1)
                                                        <span style="color: red">{{ __('Declined') }}</span>
                                                    @elseif($document->images and $document->images['status'] == 2)
                                                        <span style="color: green">{{ __('Approved') }}</span>
                                                    @endif
                                                </td>
                                                <td class="text-right">
                                                    @if($document->images and $document->images['status'] == 1)
                                                        <form action="{{ route('image.update', $document->images['id']) }}" id="myforms_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myforms">
                                                            @csrf
                                                            @method('put')
                                                            <input type="hidden" name="my_id" value="{{ $document->images['id'] }}">
                                                            <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                            <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                            <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                            <div class="mb-12 text-right" style="margin-right: 20px">
                                                                <div class="row text-right">
                                                                    <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                    <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    @elseif ($document->images and $document->images['status'] == 2)
                                                        <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            @elseif(!$document->images)
                                                                <form action="{{ route('image.store') }}" id="myform_{{ $document->id }}" method="POST" enctype="multipart/form-data" class="myform">
                                                                    @csrf
                                                                    <input type="hidden" name="type" value="{{ $document->typeName }}">
                                                                    <input type="hidden" name="doc_id" value="{{ $document->id }}">
                                                                    <input type="hidden" name="client_id" value="{{ $clients->id }}">

                                                                    <div class="mb-12 text-right" style="margin-right: 20px">
                                                                        <div class="row text-right">
                                                                            <input type="file" name="file" id="inputFile" class="form-control" style="width: 80%">
                                                                            <button type="submit" class="btn btn-success btn-sm">Send</button>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            @else
                                                                <a href="{{ url('/uploads/client' . $clients->id . '/'. $document->images['name']  ) }}" target="_blank">
                                                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                                    @endif

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
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
    <script>
        $(document).ready( function() {
            $('#datatable-buttons1').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons2').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons3').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons4').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons5').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons6').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons7').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        $(document).ready( function() {
            $('#datatable-buttons8').dataTable( {
                "aaSorting": [],
                "bPaginate": false
            } );
        } );
    </script>
    <script>
        function SubmitForm(id) {
            document.getElementById('myform_'+id).submit();
        }
    </script>

@endpush
