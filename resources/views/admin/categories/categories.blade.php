@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Categories</h4>
                        <a style="max-width: 150px; float: right; display: inline-block;"
                            href="{{ url('admin/add-edit-categories') }}" class="btn btn-block btn-primary">Add
                            Section</a>
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
                            <table id="categories" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Category
                                        </th>
                                        <th>
                                            Parent Category
                                        </th>
                                        <th>
                                            Section Name
                                        </th>
                                        <th>
                                            URL
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
                                    @foreach ($categories as $category )
                                    @if(isset($category['parentcategory']['category_name'])
                                    &&!empty($category['parentcategory']['category_name']))
                                    @php $parent_category = $category['parentcategory']['category_name']; @endphp
                                    @else
                                    @php $parent_category = "Root"; @endphp
                                    @endif
                                    <tr>
                                        <td class="py-1">
                                            {{ $category['id'] }}
                                        </td>
                                        <td class="py-1">
                                            {{ $category['category_name'] }}
                                        </td>
                                        <td>
                                            {{ $parent_category }}
                                        </td>
                                        <td>
                                            {{ $category['section']['name'] }}
                                        </td>
                                        <td>
                                            {{ $category['url'] }}
                                        </td>
                                        <td>
                                            @if ($category['status'] ==1)
                                            <a href="javascript:void(0)" class="updateCategoryStatus"
                                                id="category-{{ $category['id'] }}"
                                                category_id="{{ $category['id'] }}"><i style="font-size:30px;"
                                                    class="mdi mdi-bookmark-check" status="Active"></i></a>
                                            @else
                                            <a href="javascript:void(0)" class="updateCategoryStatus"
                                                id="category-{{ $category['id'] }}"
                                                category_id="{{ $category['id'] }}"><i style="font-size:30px;"
                                                    class="mdi mdi-bookmark-outline" status="Inactive"></i></a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('admin/add-edit-category/'.$category['id']) }}" class=""><i
                                                    style="font-size:30px;" class="mdi mdi-pencil-box"></i></a>
                                            <a class="confirmDelete" href="javascript:void(0)" module="category"
                                                moduleid="{{  $category['id'] }}"><i style="font-size:30px;"
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
