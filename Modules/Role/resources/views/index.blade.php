<x-layouts.admin>
@section('title', 'Manage Roles')
@section('subTitle', 'Role')
<div class="content pb-0">
    <div class="mb-4">
        <h4 class="mb-1">@yield('title')</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
    </div>

    <!-- start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
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
                    @if(auth()->user()->can('create_roles'))
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
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-06.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Elizabeth Morgan
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-40.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Katherine Brooks
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-05.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Sophia Lopez
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-10.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>John Michael
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-15.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Natalie Brooks
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-01.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>William Turner
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-13.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Ava Martinez
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-12.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Nathan Reed
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-03.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Lily Anderson
                                                                </label>
                                                            </li>
                                                            <li class="mb-1">
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1" type="checkbox">
                                                                    <span class="avatar avatar-xs rounded-circle me-2"><img src="assets/img/users/user-18.jpg" class="flex-shrink-0 rounded-circle" alt="img"></span>Ryan Coleman
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
                            {{-- @dd(auth()->id()) --}}
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
                        <p class="card-title-desc">
                            Create responsive tables by wrapping any <code>.table</code> in
                            <code>.table-responsive</code> to make them scroll horizontally on small devices
                            (under 768px).
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        {{-- <th>Invoice No</th> --}}
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
                                        <td>{{ $row->name }}</td>
                                        <td>{{ trim($row->createdBy?->first_name.' '.$row->createdBy?->last_name) ?: ($row->createdBy?->username ?? 'N/A') }}</td>
                                        <td>{{ $row->created_at->format('d M y') }}</td>
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
                                                    @if(auth()->user()->can('edit_roles'))
                                                        <a class="dropdown-item edit-item-btn" data-id="{{ $row->id }}" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="ti ti-edit text-blue"></i> Edit
                                                        </a>
                                                    @endif

                                                    @if(auth()->user()->can('delete_roles'))
                                                        <a class="dropdown-item remove-item-btn" href="#" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
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

<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvasRight" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="offcanvas-header border-bottom">
        <h5 class="fw-semibold" id="offcanvasRightLabel">Add New @yield('subTitle')</h5>
        <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('roles.store') }}" id="addData" method="post">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div>
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Role Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name" id="name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                <select class="form-select" id="status" name="status">
                                    <option value="" disabled selected>Select status</option>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Module <span class="text-danger">*</span></label>
                                <select class="select" name="module_id[]" id="module_id" multiple>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-12" id="permission_container" style="display:none;">
                            <label class="form-label fw-bold mt-3">Permissions <span class="text-danger">*</span></label>
                            <div id="permissions_list" class="row border rounded p-2 mt-2 mx-0 py-2 mb-4 overflow-auto" style="max-height: 60vh;">
                                {{--  --}}
                            </div>
                        </div>
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
@push('scripts')
<script>
    window.currentUserSelections = window.currentUserSelections || [];

    /**
     * Dynamic Table Data Hydrator via AJAX
     * Page refresh kiye bina table container ko smooth reload karta hai
     */
    function loadTableData(url) {
        if (!url) url = window.location.href;

        $('#table-loader').addClass('active');
        $('#data-table-container').css('opacity', '0.5').css('pointer-events', 'none');

        $.ajax({
            url: url,
            type: 'GET',
            success: function (res) {
                let parsedHtml = $(res).find('#data-table-container').html();
                $('#data-table-container').html(parsedHtml);
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
     * Dynamic HTML Renderer for Module Wise Split Layout
     * Checkbox structures ko module wise inline layout me parse karta hai
     */
    function renderPermissionsHTML(response) {
        let html = '';
        let hasData = false;

        let backendSelections = window.currentUserSelections || [];
        let runtimeCheckedSelections = [];

        $('.perm-check:checked').each(function() {
            runtimeCheckedSelections.push(Number($(this).val()));
        });

        let allActiveSelections = [...new Set([...backendSelections.map(Number), ...runtimeCheckedSelections])];
        $.each(response, function (moduleName, permissions) {
            if (permissions && permissions.length > 0) {
                hasData = true;

                html += `
                    <div class="col-12 mt-4 mb-2 border-bottom border-secondary-subtle pb-1">
                        <p class="fw-bold text-danger mb-0" style="font-size: 14px; letter-spacing: 0.5px;">
                            ${moduleName}
                        </p>
                    </div>
                `;

                html += `<div class="col-12 d-flex flex-wrap mb-3">`;

                $.each(permissions, function (i, perm) {
                    const targetId = perm.id ? Number(perm.id) : null;
                    const isChecked = allActiveSelections.includes(targetId) ? 'checked' : '';
                    const displayName = perm.permission_name || perm.name || 'Unnamed Option';

                    html += `
                        <div class="form-check me-4 mb-2" style="min-width: 180px;">
                            <input class="form-check-input perm-check cursor-pointer"
                                type="checkbox"
                                name="permissions[]"
                                value="${perm.id}"
                                id="perm_${perm.id}_${i}"
                                ${isChecked}>
                            <label class="form-check-label cursor-pointer text-wrap text-body fw-medium"
                                for="perm_${perm.id}_${i}">
                                ${displayName}
                            </label>
                        </div>
                    `;
                });

                html += `</div>`;
            }
        });

        if (hasData) {
            $('#permissions_list').html(html);
            $('#permission_container').show();
        } else {
            $('#permissions_list').html('<div class="col-12 py-2 text-muted">No permissions found for selection.</div>');
            $('#permission_container').show();
        }
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
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            success: function (data) {
                submitBtn.prop('disabled', false).html(originalBtnText);
                if (data.status) {
                    showToast('success', 'Success', data.message);
                    form[0].reset();

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

    // ==========================================================================
    // 2. LIFECYCLE ROUTINE REGISTRATIONS (DOCUMENT READY)
    // ==========================================================================
    $(document).ready(function () {
        const offcanvasId = 'offcanvasRight';
        let deleteId = null;
        const deleteRoute = "{{ route('roles.delete', ':id') }}";

        const routes = {
            edit: "{{ route('roles.edit', ':id') }}",
            update: "{{ route('roles.update', ':id') }}",
            delete: "{{ route('roles.delete', ':id') }}",
            index: "{{ route('roles.index') }}"
        };

        // FORM SUBMIT OVERRIDE
        $('#addData').on('submit', function (e) {
            e.preventDefault();
            saveData();
        });

        // SELECT2 INJECTOR RUNTIME ENGINE
        $('#module_id').select2({
            placeholder: 'Choose Module',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#' + offcanvasId),
            ajax: {
                url: '{{ route("searchModule") }}',
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

        // ON MODULE SELECTOR CHANGE (TRAFFIC SEGREGATION CONTROL)
        $('#module_id').on('change', function (e) {
            // Edit button populate mechanism changes triggers safe loops logic bypass check
            if (e.triggeredByCode) return;

            let moduleIds = $(this).val();

            if (!moduleIds || moduleIds.length === 0) {
                $('#permission_container').hide();
                $('#permissions_list').html('');
                return;
            }

            $.ajax({
                url: "{{ route('getPermissions') }}",
                type: "GET",
                data: { module_ids: moduleIds },
                success: function (response) {
                    renderPermissionsHTML(response);
                },
                error: function (xhr) {
                    console.error("Change runtime render engine processing fault:", xhr.responseText);
                }
            });
        });

        // EDIT ITEM CLICK (POPULATE FORM FIELDS & RUNTIME CHECKED BOXES MAPPING)
        $(document).on('click', '.edit-item-btn', function () {
            const id = $(this).data('id');
            $('#addData').attr('action', routes.update.replace(':id', id));
            $('input[name="_method"]').val('PUT');
            $('#offcanvasRightLabel').text('Edit Role');
            $('#btnUpdate').text('Update');
            $('#table-loader').addClass('active');

            $.get(routes.edit.replace(':id', id), function (res) {
                const data = res.data.data;
                const modules = res.data.module;

                $('#name').val(data.name);
                $('#status').val(data.status).trigger('change');
                window.currentUserSelections = data.permissions.map(p => Number(p.id));

                const $select = $('#module_id');
                $select.empty();

                let moduleIds = [];
                modules.forEach(m => {
                    const mid = String(m.module_id);
                    const name = m.module_name;
                    moduleIds.push(mid);

                    const option = new Option(name, mid, true, true);
                    $select.append(option);
                });

                $select.val(moduleIds).trigger({
                    type: 'change.select2',
                    triggeredByCode: true
                });

                if (moduleIds.length > 0) {
                    $.ajax({
                        url: "{{ route('getPermissions') }}",
                        type: "GET",
                        data: { module_ids: moduleIds },
                        success: function (response) {
                            renderPermissionsHTML(response);
                        },
                        error: function(xhr) {
                            console.error("Edit structural execution array flow crash:", xhr.responseText);
                        },
                        complete: function() {
                            $('#table-loader').removeClass('active');
                        }
                    });
                } else {
                    $('#permission_container').hide();
                    $('#permissions_list').html('');
                    $('#table-loader').removeClass('active');
                }
            });
        });

        $('#offcanvasRight').on('hidden.bs.offcanvas', function () {
            window.currentUserSelections = [];
            $('#addData')[0].reset();
            $('#addData').find('.is-invalid').removeClass('is-invalid');
            $('#addData').find('.invalid-feedback').text('');

            $('#module_id').val(null).trigger('change');
            $('#permissions').val(null).trigger('change');
            $('#permissions_list').html('');
            $('#permission_container').hide();
            $(this).find('input[type="checkbox"]').prop('checked', false);

            $('#addData').attr('action', "{{ route('roles.store') }}");
            $('input[name="_method"]').val('POST');
            $('#offcanvasRightLabel').text('Add New Role');

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
    });
    </script>
@endpush
</x-layouts.admin>
