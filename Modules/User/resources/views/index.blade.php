<x-layouts.admin>
{{-- content --}}
<div class="content pb-0">
    <!-- Page Header -->
    <div class="mb-4">
        <h4 class="mb-1">@yield('title')</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Header -->

    <!-- start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center w-100">
                    <!-- Left Side -->
                    <div class="d-flex align-items-center gap-2 flex-grow-1">
                        <div class="input-icon input-icon-start position-relative">
                            <span class="input-icon-addon text-dark">
                                <i class="ti ti-search"></i>
                            </span>
                            <input type="text" name="keyword" id="keyword" class="form-control" placeholder="Search">
                        </div>

                        <button class="btn btn-light" onclick="searchTable()"> <i class="fa fa-search"></i> &nbsp;Filter</button>
                        <button class="btn btn-light" onclick="resetSearch()"> <i class="fa fa-undo"></i> &nbsp;Reset</button>
                    </div>

                    <!-- Right Side -->
                    @if(auth()->user()->can('create_users'))
                        <a href="javascript:void(0);" class="btn btn-primary add-item-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"><i class="ti ti-square-rounded-plus-filled me-1"></i>Add
                            @yield('subTitle')
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    {{--  --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="btn btn-outline-light shadow px-2" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="ti ti-filter me-2"></i>Filter<i class="ti ti-chevron-down ms-2"></i></a>
                                <div class="filter-dropdown-menu dropdown-menu dropdown-menu-lg p-0" style="">
                                    <div class="filter-header d-flex align-items-center justify-content-between border-bottom">
                                        <h4 class="mb-0 fs-16"><i class="ti ti-filter me-1"></i>Filter</h4>
                                        <button type="button" class="btn-close close-filter-btn" data-bs-dismiss="dropdown-menu" aria-label="Close"></button>
                                    </div>
                                    <div class="filter-set-view p-3">
                                        <div class="accordion" id="accordionExample">
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">Name</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse show" id="collapseTwo" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list bg-light rounded border p-2 shadow mt-2">
                                                        <div class="mb-2">
                                                            <div class="input-icon-start input-icon position-relative">
                                                                <span class="input-icon-addon fs-12">
                                                                    <i class="ti ti-search"></i>
                                                                </span>
                                                                <input type="text" class="form-control form-control-md" placeholder="Search">
                                                            </div>
                                                        </div>
                                                        <ul class="mb-0">
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="{{ asset('admin_assets/assets/img/users/user-06.jpg') }}" class="flex-shrink-0 rounded-circle" alt="img"></span>Elizabeth Morgan
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="link-primary text-decoration-underline p-2 d-flex">Load
                                                                    More</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Phone</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="collapseThree" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list bg-light rounded border p-2 shadow mt-2">
                                                        <ul>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    +1 87545 54503
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    +1 98975 17485
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    +1 54655 25455
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#owner" aria-expanded="false" aria-controls="owner">Email</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="owner" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list bg-light rounded border p-2 shadow mt-2">
                                                        <ul class="mb-0">
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    elizabeth@example.com
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    katherine@example.com
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    samantha@example.com
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="link-primary text-decoration-underline p-2 pt-0 d-flex">Load
                                                                    More</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="filter-set-content">
                                                <div class="filter-set-content-head">
                                                    <a href="#" class="collapsed" data-bs-toggle="collapse" data-bs-target="#Status" aria-expanded="false" aria-controls="Status">Status</a>
                                                </div>
                                                <div class="filter-set-contents accordion-collapse collapse" id="Status" data-bs-parent="#accordionExample">
                                                    <div class="filter-content-list bg-light rounded border p-2 shadow mt-2">
                                                        <ul>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    Active
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    Inactive
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" class="btn btn-outline-light w-100">Reset</a>
                                            <a href="manage-users.html" class="btn btn-primary w-100">Filter</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="reportrange" class="reportrange-picker d-flex align-items-center shadow">
                                <i class="ti ti-calendar-due text-dark fs-14 me-1"></i><span class="reportrange-picker-field">3 May 26 - 1 Jun 26</span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2 flex-wrap">
                            <div class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle btn btn-outline-light shadow" data-bs-toggle="dropdown">
                                    <i class="ti ti-sort-ascending-2 me-2"></i>Sort By
                                </a>

                                <div class="dropdown-menu">
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="applySort('newest')">
                                                Newest
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="applySort('oldest')">
                                                Oldest
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            {{-- <div class="dropdown">
                                <a href="javascript:void(0);" class="btn bg-soft-indigo border-0" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="ti ti-columns-3 me-2"></i>Manage Columns</a>
                                <div class="dropdown-menu dropdown-menu-md dropdown-md p-3" style="">
                                    <ul>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Name</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Phone</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Email</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Created </span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Last Activity</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center mb-2">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Status</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                        <li class="gap-1 d-flex align-items-center">
                                            <i class="ti ti-columns me-1"></i>
                                            <div class="form-check form-switch w-100 ps-0">

                                                <label class="form-check-label d-flex align-items-center gap-2 w-100">
                                                    <span>Action</span>
                                                    <input class="form-check-input switchCheckDefault ms-auto" type="checkbox" role="switch" checked="">
                                                </label>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    {{--  --}}
                    <div id="data-table-container">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Invoice No</th> --}}
                                        <th>Full Name</th>
                                        <th>Role</th>
                                        <th>Created By</th>
                                        <th>Created On</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                    <tr>
                                        <th scope="row">{{ $data->firstItem() + $loop->index }}</th>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md me-2 avatar-rounded">
                                                    <img src="{{ asset('admin_assets/assets/img/profiles/avatar-06.jpg') }}" alt="img">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                        {{ trim(($row->first_name ?? 'N/A') . ' ' . ($row->last_name ?? '')) }}
                                                    </h6>
                                                    <span class="text-muted fs-12" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title=" {{ $row->email }}">
                                                        {{ $row->email }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="bad">{{ $row->roles->first()?->name }}</span></td>
                                        <td> {{ trim(($row->creator?->first_name ?? '') . ' ' . ($row->creator?->last_name ?? '')) ?: 'System' }} </td>
                                        <td>15 May</td>
                                        <td>
                                            <span class="badge {{ $row->status == 'active' ? 'badge-outline-success' : 'badge-outline-danger' }}">
                                                {{ $row->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <div class="dropdown table-action">
                                                <a href="#" class="action-icon btn btn-xs shadow btn-icon btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @if(auth()->user()->can('edit_users'))
                                                        <a class="dropdown-item edit-item-btn" data-id="{{ $row->uid }}" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="ti ti-edit text-blue"></i> Edit
                                                        </a>
                                                    @endif

                                                    @if(auth()->user()->can('delete_users'))
                                                    <a class="dropdown-item remove-item-btn" href="#" data-id="{{ $row->uid }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="10">
                                            <div class="text-center py-3">
                                                <p class="mb-0"> No Records Found</p>
                                                <p class="mb-0"> There is currently no data available to display.</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{--  --}}
                        @include('admin.components.pagination', ['data' => $data])
                        {{--  --}}
                    </div>
                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div>
    <!-- end row -->
</div>
{{-- content --}}

{{-- model & offcanvas --}}
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvasRight" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="offcanvas-header border-bottom">
        <h5 class="fw-semibold" id="offcanvasRightLabel">Add New @yield('subTitle')</h5>
        <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('users.store') }}" id="addData" method="POST">
            @csrf

            <input type="hidden" name="_method" value="POST">
            <div>
                <!-- Basic Info -->
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="first_name" id="first_name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="last_name" id="last_name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="username" id="username">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="form-label">Email <span class="text-danger">*</span></label>
                                    <div class="form-check form-switch form-check-reverse">
                                        <input type="hidden" name="email_enabled" value="0">
                                        <input class="form-check-input" type="checkbox" id="email_enabled" name="email_enabled" value="1" checked>
                                        <label class="form-check-label" for="email_enabled">Email OptOut</label>
                                    </div>
                                </div>
                                <input type="text" class="form-control" name="email" id="email">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Roles <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="roles" name="roles[]" multiple>
                                    {{--  --}}
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select select2" id="status" name="status">
                                    <option value="" disabled selected>Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone 1 <span class="text-danger">*</span></label>
                                <input type="text" class="form-control phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Phone 2</label>
                                <input type="text" class="form-control phone" name="phone">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group input-group-flat pass-group">
                                    <input type="password" class="form-control pass-input">
                                    <span class="input-group-text toggle-password ">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Repeat Password <span class="text-danger">*</span></label>
                                <div class="input-group input-group-flat pass-group">
                                    <input type="password" class="form-control pass-input">
                                    <span class="input-group-text toggle-password ">
                                        <i class="ti ti-eye-off"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Location <span class="text-danger">*</span></label>
                                <select class="select">
                                    <option>Choose</option>
                                    <option>Germany</option>
                                    <option>USA</option>
                                    <option>Canada</option>
                                    <option>India</option>
                                    <option>China</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <!-- /Basic Info -->
            </div>
            <div class="d-flex align-items-center justify-content-end">
                <a href="#" class="btn btn-light me-2" data-bs-dismiss="offcanvas">Cancel</a>
                <button type="submit" class="btn btn-primary" id="btnUpdate">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- delete modal -->
<div class="modal fade" id="deleteRecordModal">
    <div class="modal-dialog modal-dialog-centered modal-sm rounded-0">
        <div class="modal-content rounded-0">
            <div class="modal-body p-4 text-center position-relative">
                <div class="mb-3 position-relative z-1">
                    <span class="avatar avatar-xl badge-soft-danger border-0 text-danger rounded-circle"><i class="ti ti-trash fs-24"></i></span>
                </div>
                <h5 class="mb-1">Delete Confirmation</h5>
                <p class="mb-3">Are you sure you want to remove user you selected.</p>
                <div class="d-flex justify-content-center">
                    <a href="#" class="btn btn-light position-relative z-1 me-2 w-100" data-bs-dismiss="modal">Cancel</a>
                    <a href="#" class="btn btn-primary position-relative z-1 w-100" data-bs-dismiss="modal" id="delete-record">
                        Yes, Delete
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- delete modal -->
{{-- model & offcanvas --}}

@push('scripts')
<script>
    window.currentUserSelections = window.currentUserSelections || [];

    /**
     * Dynamic Table Data Hydrator via AJAX
     * Bina page refresh kiye table container ko smoothly reload aur update karta hai
     */
    function loadTableData(url) {
        if (!url) url = window.location.href;

        // Force HTTPS for AJAX requests
        if (url.startsWith('http://')) {
            url = url.replace('http://', 'https://');
        }

        $('#table-loader').addClass('active');
        $('#data-table-container').css('opacity', '0.5').css('pointer-events', 'none');

        $.ajax({
            url: url,
            type: 'GET',
            headers:{
                'X-Requested-With':'XMLHttpRequest'
            },
            success: function (res) {
                // let parsedHtml = $(res).find('#data-table-container').html();
                // $('#data-table-container').html(parsedHtml);
                // window.history.pushState({}, '', url);

                let table = $(res).find('#data-table-container');
                if(table.length){
                    $('#data-table-container').html(table.html());
                }
                window.history.pushState({}, '', url);
            },
            error: function (xhr) {
                console.error("Table dataset hydration system breakdown:", xhr.responseText);
            },
            complete: function () {
                $('#table-loader').removeClass('active');
                $('#data-table-container').css('opacity', '1').css('pointer-events', 'auto');
                if (typeof resetSelectionUI === "function") {
                    resetSelectionUI();
                }
            }
        });
    }

    /**
     * Ajax Post Request Save / Update Function Controller Gateway
     */
    function saveData() {
        var form = $('#addData');
        var submitBtn = form.find('button[type="submit"]');
        var url = form.attr('action');
        var method = form.find('input[name="_method"]').val() || 'POST';
        var formData = new FormData(form[0]);
        var originalBtnText = submitBtn.html();

        formData.append('_method', method);
        submitBtn.prop('disabled', true).html('Saving...');
        form.find('.is-invalid').removeClass('is-invalid');
        form.find('.invalid-feedback').text('');

        $.ajax({
            url: $(form).attr("action"),
            method: $(form).attr("method"),
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                submitBtn.prop('disabled', false).html(originalBtnText);
                if (data.status || data.success) {
                    showToast('success', 'Success', data.message);
                    form[0].reset();

                    const img = document.getElementById('preview_img');
                    const icon = document.getElementById('placeholder_icon');
                    if (img && icon) {
                        img.src = '';
                        img.style.display = 'none';
                        icon.style.display = 'block';
                    }

                    loadTableData(window.location.href);

                    setTimeout(function () {
                        let offcanvasEl = document.getElementById('offcanvasRight');
                        let offcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasEl);
                        offcanvas.hide();
                    }, 1500);

                } else if (data.type === 'exists') {
                    showToast('warning', 'Already Exists', data.message);
                } else {
                    showToast('danger', 'Error', data.message);
                }
            },
            error: function (xhr) {
                submitBtn.prop('disabled', false).html(originalBtnText);
                $('.is-invalid').removeClass('is-invalid');
                $('.invalid-feedback').text('');
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, value) {
                        let input = form.find(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        input.siblings('.invalid-feedback').text(value[0]);
                    });
                } else {
                    console.log(xhr.responseText);
                }
            }
        });
    }

    /**
    * Ajax filter
    */
    function searchTable(){
        let keyword = $('#keyword').val();
        let url = new URL(window.location.href);
        url.searchParams.set('keyword', keyword);

        $('#data-table-container').css('opacity', '0.6');
        $('#data-table-container').load(url.href + " #data-table-container > *", function () {
            $('#data-table-container').css('opacity', '1');
            // resetSelectionUI();
            // bindSelectAll();
        });
        window.history.pushState(null, null, url.href);
    }

    function resetSearch() {
        $('#keyword').val('');

        const url = new URL(window.location.href);
        url.searchParams.delete('keyword');
        window.history.replaceState({}, '', url.pathname);
        loadTableData(url.pathname);
    }

    function applySort(type) {

        let url = new URL(window.location.href);
        url.searchParams.set('sort', type);

        let label = type === 'oldest' ? 'Oldest' : 'Newest';
        $('#sort-label').text(label);
        $('#table-loader').addClass('active');
        $('#data-table-container').css('opacity', '0.4');

        $('#data-table-container').load(
            url.pathname + "?" + url.searchParams.toString() + " #data-table-container > *",
            function () {
                $('#table-loader').removeClass('active');
                $('#data-table-container').css('opacity', '1');
            }
        );
        window.history.pushState(null, null, url.pathname + "?" + url.searchParams.toString());
    }

    $(document).ready(function () {
        const offcanvasId = 'offcanvasRight';
        let deleteId = null;
        const deleteRoute = "{{ route('users.delete', ':id') }}";

        $('#addData').on('submit', function (e) {
            e.preventDefault();
            saveData();
        });

        $(document).on('click', '.edit-item-btn', function () {
            let id = $(this).data('id');
            const editUrl = "{{ route('users.edit', ':id') }}".replace(':id', id);
            const updateUrl = "{{ route('users.update', ':id') }}".replace(':id', id);

            $('#addData').attr('action', updateUrl);
            $('input[name="_method"]').val('PUT');
            $('#offcanvasRightLabel').text('Edit User');
            $('#btnUpdate').text('Update');
            $('#table-loader').addClass('active');

            $.get(editUrl, function (res) {
                let userData = res.data?.data || res.data || res;

                $('#first_name').val(userData.first_name);
                $('#last_name').val(userData.last_name);
                $('#email').val(userData.email);
                $('#username').val(userData.username);
                $('#status').val(userData.status).trigger('change');

                const img = document.getElementById('preview_img');
                const icon = document.getElementById('placeholder_icon');
                if (img && icon && userData.profile_img_url) {
                    img.src = userData.profile_img_url;
                    img.style.display = 'block';
                    icon.style.display = 'none';
                }

                $('#table-loader').removeClass('active');
            }).fail(function() {
                $('#table-loader').removeClass('active');
            });
        });

        $('#offcanvasRight').on('hidden.bs.offcanvas', function () {
            window.currentUserSelections = [];

            $('#addData')[0].reset();
            $('#addData').find('.is-invalid').removeClass('is-invalid');
            $('#addData').find('.invalid-feedback').text('');

            $('#module_id').val(null).trigger('change');
            $('#status').val('').trigger('change');

            const img = document.getElementById('preview_img');
            const icon = document.getElementById('placeholder_icon');
            if (img && icon) {
                img.src = '';
                img.style.display = 'none';
                icon.style.display = 'block';
            }

            $('#addData').attr('action', "{{ route('users.store') }}");
            $('input[name="_method"]').val('POST');
            $('#offcanvasRightLabel').text('Add New User');
            $('#btnUpdate').text('Create');

            if ($(this).data('reload-table')) {
                loadTableData(window.location.href);
                $(this).data('reload-table', false);
            }
        });

        $(document).on('click', '#data-table-container .pagination a', function (e) {
            e.preventDefault();
            let url = $(this).attr('href');
            if (url) loadTableData(url);
        });

        $(document).on('click', '.remove-item-btn', function () {
            deleteId = $(this).data('id');
        });

        $(document).on('click', '#delete-record', function () {
            if (!deleteId) return;

            let deleteUrl = deleteRoute.replace(':id', deleteId);

            $.ajax({
                url: deleteUrl,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                beforeSend: function () {
                    $('#table-loader').addClass('active');
                },
                success: function (res) {
                    if (res.status || res.success) {
                        $('#deleteRecordModal').modal('hide');

                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });

                        loadTableData(window.location.href);
                    }
                },
                complete: function () {
                    $('#table-loader').removeClass('active');
                }
            });
        });

        $(document).on('change', '#checkAll', function () {
            $('input[name="chk_child"]').prop('checked', $(this).prop('checked'));
        });

        function resetSelectionUI() {
            $('#checkAll').prop('checked', false);
            $('input[name="chk_child"]').prop('checked', false);
        }

        var offcanvasElement = document.getElementById('offcanvasRight');
        offcanvasElement.addEventListener('show.bs.offcanvas', function () {
            $('#table-loader').addClass('active');
        });

        offcanvasElement.addEventListener('shown.bs.offcanvas', function () {
            setTimeout(() => {
                $('#table-loader').removeClass('active');
            }, 200);
        });

        $(document).on('input change', '#addData input, #addData select, #addData textarea', function () {
            $(this).removeClass('is-invalid');
            $(this).closest('.mb-3').find('.invalid-feedback').text('');
        });

        const profileImgInput = document.getElementById('profile_img');
        if (profileImgInput) {
            profileImgInput.addEventListener('change', function (event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = document.getElementById('preview_img');
                        const icon = document.getElementById('placeholder_icon');
                        if (img && icon) {
                            img.src = e.target.result;
                            img.style.display = 'block';
                            icon.style.display = 'none';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // SELECT2 INJECTOR RUNTIME ENGINE
        $('#roles').select2({
            placeholder: 'Choose Roles',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#' + offcanvasId),
            ajax: {
                url: '{{ route("searchRole") }}',
                type: 'GET',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return { search: params.term || '' };
                },
                processResults: function (response) {
                    return { results: response };
                },
                cache: true
            }
        });
    });
</script>
@endpush
</x-layouts.admin>
