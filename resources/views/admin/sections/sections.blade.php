@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sections</h4>
                        <a style="max-width: 150px; float: right; display: inline-block;"
                            href="{{ url('admin/add-edit-section') }}" class="btn btn-block btn-primary">Add Section</a>
                        @if (Session::has('error_message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error:</strong> {{ Session::get('error_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        {{-- <p class="card-description">
                            Add class <code>.table-striped</code>
                        </p> --}}
                        <div class="table-responsive">
                            <table id="sections" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Section name
                                        </th>
                                        <th>
                                            Status
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sections as $section )
                                    <tr>
                                        <td class="py-1">
                                            {{ $section['id'] }}
                                        </td>
                                        <td>
                                            {{ $section['name'] }}
                                        </td>
                                        <td>
                                            @if ($section['status'] ==1)
                                            <a href="javascript:void(0)" class="updateSectionStatus"
                                                id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"><i
                                                    style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateSectionStatus"
                                                id="section-{{ $section['id'] }}" section_id="{{ $section['id'] }}"><i
                                                    style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/add-edit-section/'.$section['id']) }}" class=""><i
                                                    style="font-size:30px;" class="mdi mdi-pencil"></i></a>
                                            <a class="confirmDelete" href="javascript:void(0)" module="section"
                                                moduleid="{{  $section['id'] }}"><i style="font-size:30px;"
                                                    class="mdi mdi-delete"></i></a>
                                        </td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
