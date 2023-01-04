@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Brands</h4>
                        <a style="max-width: 150px; float: right; display: inline-block;"
                            href="{{ url('admin/add-edit-brand') }}" class="btn btn-block btn-primary">Add Brand</a>
                        @if (Session::has('success_message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success:</strong> {{ Session::get('success_message') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif

                        {{-- <p class="card-description">
                            Add class <code>.table-striped</code>
                        </p> --}}
                        <div class="table-responsive pt-3">
                            <table id="brands" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Brand name
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
                                    @foreach ($brands as $brand )
                                    <tr>
                                        <td class="py-1">
                                            {{ $brand['id'] }}
                                        </td>
                                        <td>
                                            {{ $brand['name'] }}
                                        </td>
                                        <td>
                                            @if ($brand['status'] ==1)
                                            <a href="javascript:void(0)" class="updateBrandStatus"
                                                id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}"><i
                                                    style="font-size:30px;" class="mdi mdi-bookmark-check"
                                                    status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateBrandStatus"
                                                id="brand-{{ $brand['id'] }}" brand_id="{{ $brand['id'] }}"><i
                                                    style="font-size:30px;" class="mdi mdi-bookmark-outline"
                                                    status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/add-edit-brand/'.$brand['id']) }}" class=""><i
                                                    style="font-size:30px;" class="mdi mdi-pencil-box"></i></a>
                                            <a class="confirmDelete" href="javascript:void(0)" module="brand"
                                                moduleid="{{  $brand['id'] }}"><i style="font-size:30px;"
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
