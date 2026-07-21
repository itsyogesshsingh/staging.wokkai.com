@extends('admin.layout.app')
@section('title', 'Manage Leads')
@section('subTitle', 'Lead')
@section('content')
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
                    @if(auth()->user()->can('create_leads'))
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
                            <div id="reportrange" class="reportrange-picker d-flex align-items-center shadow">
                                <i class="ti ti-calendar-due text-dark fs-14 me-1"></i><span class="reportrange-picker-field">3 May 26 - 1 Jun 26</span>
                            </div>
                        </div>
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
                                                                <input type="text" class="form-control form-control-md filter-input" data-key="assigned_to" placeholder="Search">
                                                            </div>
                                                        </div>
                                                        <ul class="mb-0 filter-scroll" id="lead-name-filter">
                                                            @foreach($data->unique('lead_name') as $index => $lead)
                                                                <li class="mb-1 lead-item {{ $index >= 3 ? 'd-none' : '' }}">
                                                                    <label class="dropdown-item px-2 d-flex align-items-center">
                                                                        <input class="form-check-input m-0 me-1 filter-input"
                                                                            data-key="lead_name"
                                                                            value="{{ $lead->lead_name }}"
                                                                            type="checkbox">

                                                                        {{ $lead->lead_name }}
                                                                    </label>
                                                                </li>
                                                            @endforeach

                                                            @if($data->unique('lead_name')->count() > 3)
                                                                <li>
                                                                    <a href="javascript:void(0);" id="load-more-names"
                                                                    class="link-primary text-decoration-underline p-2 d-flex">
                                                                        Load More
                                                                    </a>
                                                                </li>
                                                            @endif
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
                                                        <ul class="mb-0 filter-scroll" id="phone-filter">
                                                            @foreach($data->unique('phone') as $index => $lead)
                                                                <li class="phone-item {{ $index >= 3 ? 'd-none extra-phone' : '' }}">
                                                                    <label class="dropdown-item px-2 d-flex align-items-center">
                                                                        <input class="form-check-input m-0 me-1 filter-input" data-key="phone" value="{{ $lead->phone }}" type="checkbox">
                                                                        {{ $lead->phone }}
                                                                    </label>
                                                                </li>
                                                            @endforeach

                                                            @if($data->unique('phone')->count() > 3)
                                                                <li>
                                                                    <a href="javascript:void(0);"
                                                                    id="load-more-phone"
                                                                    class="link-primary text-decoration-underline p-2 d-flex">
                                                                        Load More
                                                                    </a>
                                                                </li>
                                                            @endif
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
                                                        <ul class="mb-0 filter-scroll" id="email-filter">
                                                            @foreach($data->unique('email') as $index => $lead)
                                                                <li class="email-item {{ $index >= 3 ? 'd-none extra-phone' : '' }}">
                                                                    <label class="dropdown-item px-2 d-flex align-items-center">
                                                                        <input class="form-check-input m-0 me-1 filter-input"
                                                                            data-key="email"
                                                                            value="{{ $lead->email }}"
                                                                            type="checkbox">

                                                                        {{ $lead->email }}
                                                                    </label>
                                                                </li>
                                                            @endforeach

                                                            @if($data->unique('email')->count() > 3)
                                                                <li>
                                                                    <a href="javascript:void(0);"
                                                                    id="load-more-email"
                                                                    class="link-primary text-decoration-underline p-2 d-flex">
                                                                        Load More
                                                                    </a>
                                                                </li>
                                                            @endif
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
                                                                    <input class="form-check-input m-0 me-1 filter-input" data-key="status" value="active" type="checkbox">
                                                                    Active
                                                                </label>
                                                            </li>
                                                            <li>
                                                                <label class="dropdown-item px-2 d-flex align-items-center">
                                                                    <input class="form-check-input m-0 me-1 filter-input" data-key="status" value="inactive" type="checkbox">
                                                                    Inactive
                                                                </label>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="javascript:void(0);" onclick="resetFilters()" class="btn btn-outline-light w-100">
                                                Reset
                                            </a>
                                            <a href="javascript:void(0);" onclick="applyFilters()" class="btn btn-primary w-100">
                                                Filter
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button id="bulk-delete-btn" class="btn btn-danger d-none">
                                <i class="ti ti-trash"></i>&nbsp; Delete Selected
                            </button>

                           <div class="dropdown">
                                <a href="javascript:void(0);" class="btn bg-soft-indigo border-0" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                    <i class="ti ti-columns-3 me-2"></i>Manage Columns
                                </a>
                                <div class="dropdown-menu dropdown-menu-md p-3">
                                    <ul id="columnManagerList"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    <div id="data-table-container">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="form-check form-check-md m-0 p-0">
                                                    <input class="form-check-input row-checkbox m-0" type="checkbox" id="select-all">
                                                </div>#
                                            </div>
                                        </th>
                                        <th data-column="lead_name">Lead Name</th>
                                        <th data-column="company">Company</th>
                                        <th data-column="phone">Phone</th>
                                        <th data-column="owner">Owner</th>
                                        <th data-column="stage">Stage</th>
                                        <th data-column="source">Source</th>
                                        <th data-column="status">Status</th>
                                        <th data-column="created_date">Created Date</th>
                                        <th data-column="action">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $row)
                                    <tr>
                                        <td class="align-middle">
                                            <div class="d-flex align-items-center gap-2">
                                                <div class="form-check form-check-md m-0 p-0">
                                                    <input class="form-check-input row-checkbox m-0" type="checkbox" value="{{ $row->id }}">
                                                </div>
                                                <span class="mb-0">
                                                    {{ $data->firstItem() + $loop->index }}
                                                </span>
                                            </div>
                                        </td>
                                        <td data-column="lead_name">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-md me-2 avatar-rounded">
                                                    <img src="{{ asset('admin_assets/assets/img/profiles/avatar-06.jpg') }}" alt="img">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6 class="mb-0 fs-14 fw-semibold">
                                                        {{ $row->lead_name ?? 'N/A' }}
                                                    </h6>
                                                    <span class="text-muted fs-12" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title=" {{ $row->email }}">
                                                        {{ $row->email }}
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td data-column="company">{{ $row->company->company_name ?? 'N/A' }}</td>
                                        <td data-column="phone"> {{ $row->phone ?? 'N/A' }} </td>
                                        <td data-column="owner"> {{ trim(($row->creator?->first_name ?? '') . ' ' . ($row->creator?->last_name ?? '')) ?: 'System' }} </td>
                                        <td data-column="stage">
                                            <span class="badge {{ $row->stage->badgeClass() }}">
                                                {{ $row->stage->label() }}
                                            </span>
                                        </td>
                                        <td data-column="source">
                                            <span class="fw-semibold">
                                                {{ ucfirst($row->source->value ?? 'N/A') }}
                                            </span>
                                        </td>
                                        <td data-column="status">
                                            <span class="badge badge-soft-{{ $row->deleted_at ? 'dark' : ($row->is_active ? 'success' : 'danger')}}">
                                                {{  $row->deleted_at ? 'Deleted' : ($row->is_active ? 'Active' : 'Inactive')}}
                                            </span>
                                        </td>
                                        <td data-column="created_date">{{ $row->created_at->format('d M Y h:i A') }}</td>
                                        <td data-column="action">
                                            <div class="dropdown table-action">
                                                <a href="#" class="action-icon btn btn-xs shadow btn-icon btn-outline-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right" style="">
                                                    @if(auth()->user()->can('edit_leads'))
                                                        <a class="dropdown-item edit-item-btn" data-id="{{ $row->id }}" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                                            <i class="ti ti-edit text-blue"></i> Edit
                                                        </a>
                                                    @endif

                                                    @if(auth()->user()->can('delete_leads'))
                                                    <a class="dropdown-item remove-item-btn text-danger" href="#" data-id="{{ $row->id }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
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
        <form action="{{ route('leads.store') }}" id="addData" method="POST">
            @csrf
            <input type="hidden" name="_method" value="POST">

            <div class="row">

                <!-- 🟢 BASIC INFO -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Lead Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lead_name" id="lead_name">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Phone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="phone" id="phone">
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Contact Type</label>
                        <select class="form-control" name="contact_type" id="contact_type">
                            <option value="">Select</option>
                            <option value="work">Work</option>
                            <option value="home">Home</option>
                        </select>
                    </div>
                </div>

                <!-- 🏢 COMPANY -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Company Name</label>
                        <select class="select2 form-control" name="company_id" id="company_id">
                            <option value="">Select Company</option>
                        </select>
                    </div>
                </div>

                <!-- 📡 SOURCE + STATUS (CRM CORE) -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Lead Source <span class="text-danger">*</span></label>
                        <select class="select2 form-control" name="source" id="source">
                            <option value="">Select</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Lead Status</label>
                        <select class="form-control" name="stage" id="stage">
                        </select>
                    </div>
                </div>

                <!-- 👤 OWNER (ASSIGNMENT) -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Owner</label>
                        <select class="multiple-img" multiple="multiple" data-toggle=" multiple">
                            <option data-image="{{ asset('admin_assets/assets/img/users/user-01.jpg') }}" selected>Sharon Roy</option>
                            <option data-image="{{ asset('admin_assets/assets/img/profiles/avatar-21.jpg') }}">Vaughan Lewis</option>
                            <option data-image="{{ asset('admin_assets/assets/img/profiles/avatar-23.jpg') }}">Jessica Louise</option>
                            <option data-image="{{ asset('admin_assets/assets/img/profiles/avatar-16.jpg') }}">Carol Thomas</option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                <!-- 💰 QUALIFICATION -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Budget / Value</label>
                        <input type="number" class="form-control" name="budget" id="budget">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Timeline</label>
                        <select class="form-control" name="timeline">
                            <option value="">Select</option>
                            <option value="immediate">Immediate</option>
                            <option value="15_days">15 Days</option>
                            <option value="1_month">1 Month</option>
                            <option value="3_months">3+ Months</option>
                        </select>
                    </div>
                </div>

                <!-- 📅 FOLLOW-UP (MOST IMPORTANT CRM PART) -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Next Follow-up Date</label>
                        <input type="date" class="form-control" name="follow_up_date" id="follow_up_date">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Next Action</label>
                        <select class="form-control" name="next_action">
                            <option value="">Select</option>
                            <option value="call">Call</option>
                            <option value="whatsapp">WhatsApp</option>
                            <option value="meeting">Meeting</option>
                            <option value="email">Email</option>
                        </select>
                    </div>
                </div>

                <!-- 📝 NOTES -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">Notes</label>
                        <textarea class="form-control" rows="3" name="notes"></textarea>
                    </div>
                </div>

            </div>

            <!-- BUTTONS -->
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
@endsection
@push('scripts')
<script>
    /**
    * Ajax filter
    */
    let filters = {
        status: [],
        source: [],
        assigned_to: [],
        lead_name: [],
        phone: [],
        email: [],
        keyword: ''
    };

    let dateFilter = {
        start: null,
        end: null,
        type: ''
    };

    function setDateRange(type){
        let start,end;
        let today = moment();

        switch (type) {
            case 'today':
                start = end = today;
                break;
            case 'yesterday':
                start = end = moment().subtract(1, 'days');
                break;
            case 'last7':
                start = moment().subtract(6, 'days');
                end = today;
                break;
            case 'last30':
                start = moment().subtract(29, 'days');
                end = today;
                break;
            case 'thisMonth':
                start = moment().startOf('month');
                end = moment().endOf('month');
                break;
            case 'lastMonth':
                start = moment().subtract(1, 'month').startOf('month');
                end = moment().subtract(1, 'month').endOf('month');
                break;
            default:
                return;
        }

        dataFilter.start = start.format('YYYY-MM-DD');
        dataFilter.end   = end.format('YYYY-MM-DD');
        $('#reportrange .reportrange-picker-field').text(start.format('DD MMM YYYY') + ' - ' + end.format('DD MMM YYYY'));
        applyFilters();
    }

    function collectFilters() {

        console.log("CHECKBOX COLLECT START");
        filters.status = [];
        filters.source = [];
        filters.assigned_to = [];

        $('.filter-input:checked').each(function () {
            let key = $(this).data('key');
            let value = $(this).val();

            if (filters[key] !== undefined) {
                filters[key].push(value);
            }
        });

        let keyword = $('#keyword').val().trim();
        filters.keyword = keyword !== '' ? keyword : '';
        console.log("FINAL FILTERS:", filters);
        return filters;
    }

    function buildFilterURL(baseUrl) {

        let url = new URL(baseUrl);
        let f = collectFilters();

        Object.keys(f).forEach(key => {
            if (Array.isArray(f[key])) {

                if (f[key].length > 0) {
                    url.searchParams.set(key, f[key].join('|'));
                } else {
                    url.searchParams.delete(key);
                }

            } else {

                if (f[key]) {
                    url.searchParams.set(key, f[key]);
                } else {
                    url.searchParams.delete(key);
                }
            }
        });

        if (dateFilter.start && dateFilter.end) {
            url.searchParams.set('start_date', dateFilter.start);
            url.searchParams.set('end_date', dateFilter.end);
        } else {
            url.searchParams.delete('start_date');
            url.searchParams.delete('end_date');
        }
        return url;
    }

    function reloadTable(url) {
        // showTableSkeleton(8);
        loadTableData(url.href);
    }

    function searchTable() {

        let keyword = $('#keyword').val().trim();
        let url = new URL(window.location.origin + window.location.pathname);
        if (keyword !== '') {
            url.searchParams.set('keyword', keyword);
        }
        reloadTable(url);
    }

    function applyFilters() {

        let url = buildFilterURL(window.location.href);
        reloadTable(url);
    }

    function resetFilters() {

        $('.filter-input').prop('checked', false);
        $('#keyword').val('');
        filters = {
            status: [],
            source: [],
            assigned_to: [],
            lead_name: [],
            phone: [],
            email: [],
            keyword: ''
        };

        dateFilter = {
            start: '',
            end: '',
            type: ''
        };

        $('#reportrange .reportrange-picker-field').text('Select Date');
        let url = new URL(window.location.origin + window.location.pathname);
        reloadTable(url);
    }

    function resetSearch() {
        $('#keyword').val('');
        let url = buildFilterURL(window.location.href);
        reloadTable(url);
    }

    function applySort(type) {
        let url = buildFilterURL(window.location.href);
        url.searchParams.set('sort', type);

        console.log(url.toString()); // check
        let label = type === 'oldest' ? 'Oldest' : 'Newest';
        $('#sort-label').text(label);
        reloadTable(url);
    }

    /**
     * date range
     * **/
    $(function () {

        $('#reportrange').daterangepicker({
            autoUpdateInput: false,
            opens: 'left',
            locale: {
                cancelLabel: 'Clear'
            },
            ranges: {
                'Today': [
                    moment(),
                    moment()
                ],
                'Yesterday': [
                    moment().subtract(1, 'days'),
                    moment().subtract(1, 'days')
                ],
                'Last 7 Days': [
                    moment().subtract(6, 'days'),
                    moment()
                ],
                'Last 30 Days': [
                    moment().subtract(29, 'days'),
                    moment()
                ],
                'This Month': [
                    moment().startOf('month'),
                    moment().endOf('month')
                ],
                'Last Month': [
                    moment().subtract(1, 'month').startOf('month'),
                    moment().subtract(1, 'month').endOf('month')
                ]
            }
        });

        $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
            dateFilter.start = picker.startDate.format('YYYY-MM-DD');
            dateFilter.end   = picker.endDate.format('YYYY-MM-DD');
            dateFilter.type  = 'custom';
            $('.reportrange-picker-field').text(
                picker.startDate.format('D MMM YY') +
                ' - ' +
                picker.endDate.format('D MMM YY')
            );
            applyFilters();
        });

        $('#reportrange').on('cancel.daterangepicker', function() {

            dateFilter.start = '';
            dateFilter.end   = '';
            dateFilter.type  = '';
            $('.reportrange-picker-field').text('Select Date');
            applyFilters();
        });

    });

    /**
     * search end
     *
    */
    function initCheckboxes() {
        const selectAll = document.getElementById('select-all');
        const rowCheckboxes = document.querySelectorAll('.row-checkbox');

        if (!selectAll) return;
        selectAll.addEventListener('change', function () {
            rowCheckboxes.forEach(cb => cb.checked = this.checked);
            updateDeleteButton();
        });
        rowCheckboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                let total = rowCheckboxes.length;
                let checked = document.querySelectorAll('.row-checkbox:checked').length;
                selectAll.checked = (total === checked);
                updateDeleteButton();
            });
        });
    }

    function updateDeleteButton() {
        const deleteBtn = document.getElementById('bulk-delete-btn');
        let checked = document.querySelectorAll('.row-checkbox:checked').length;

        if (checked > 0) {
            deleteBtn.classList.remove('d-none');
        } else {
            deleteBtn.classList.add('d-none');
        }
    }

    window.currentUserSelections = window.currentUserSelections || [];

    /**
     * Dynamic Table Data Hydrator via AJAX
     * Bina page refresh kiye table container ko smoothly reload aur update karta hai
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
                initCheckboxes();      // re-bind checkboxes
                updateDeleteButton();  // button state reset
                window.history.pushState({}, '', url);
            },
            error: function (xhr) {
                console.error("Table dataset hydration system breakdown:", xhr.responseText);
            },
            complete: function () {
                $('#table-loader').removeClass('active');
                $('#data-table-container').css('opacity', '1').css('pointer-events', 'auto');
            }
        });
    }

    /**
     *
     * checkbox with selected all
     * **/


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

    $(document).ready(function () {
        const offcanvasId = 'offcanvasRight';
        let deleteId = null;
        const deleteUrl = "{{ route('leads.bulk-delete') }}";

        $('#addData').on('submit', function (e) {
            e.preventDefault();
            saveData();
        });

        $(document).on('click', '.edit-item-btn', function () {
            let id = $(this).data('id');
            const editUrl = "{{ route('leads.edit', ':id') }}".replace(':id', id);
            const updateUrl = "{{ route('leads.update', ':id') }}".replace(':id', id);

            $('#addData').attr('action', updateUrl);
            $('input[name="_method"]').val('PUT');
            $('#offcanvasRightLabel').text('Edit Lead');
            $('#btnUpdate').text('Update');
            $('#table-loader').addClass('active');

            $.get(editUrl, function (res) {
                let data = res.data?.data || res.data || res;

                $('#lead_name').val(data.lead_name);
                $('#phone').val(data.phone);
                $('#email').val(data.email);
                $('#notes').val(data.notes);
                $('#company_id').val(data.company_id);
                $('#stage').val(data.stage).trigger('change');
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

            $('#addData').attr('action', "{{ route('leads.store') }}");
            $('input[name="_method"]').val('POST');
            $('#offcanvasRightLabel').text('Add New Lead');
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

        // filter hook
        $(document).on('change', '.filter-input', function () {
            $('#apply-filter-btn').addClass('btn-warning').text('Apply Filter *');
        });

        // bulk Delete
        $(document).on('click', '#bulk-delete-btn', function () {

            selectedIds = [];
            $('.row-checkbox:checked').each(function () {
                selectedIds.push($(this).val());
            });

            if (selectedIds.length === 0) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Select records',
                    text: 'Please select at least one record.'
                });
                return;
            }

            $('#deleteRecordModal p').text(
                `Are you sure you want to delete ${selectedIds.length} record(s)?`
            );
            $('#deleteRecordModal').modal('show');
        });

        $(document).on('click', '#delete-record', function (e) {
            e.preventDefault();

            if (selectedIds.length === 0) return;
            $.ajax({
                url: deleteUrl,
                type: 'POST',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    ids: selectedIds
                },
                beforeSend: function () {
                    $('#table-loader').addClass('active');
                },
                success: function (res) {

                    if (res.success || res.status) {
                        $('#select-all').prop('checked', false);
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: res.message,
                            timer: 1500,
                            showConfirmButton: false
                        });
                        loadTableData(window.location.href);
                        selectedIds = [];
                    }
                },
                complete: function () {
                    $('#table-loader').removeClass('active');
                }
            });
        });

        // load more button : filter
        $(document).on('click', '#load-more-names', function () {
            let hiddenItems = $('.lead-item.d-none');
            hiddenItems.slice(0, 3).removeClass('d-none');

            if ($('.lead-item.d-none').length === 0) {
                $(this).parent().remove();
            }
        });

        $(document).on('click', '#load-more-phone', function () {
            let hiddenItems = $('.phone-item.d-none');
            hiddenItems.slice(0, 3).removeClass('d-none');
            if ($('.phone-item.d-none').length === 0) {
                $(this).parent().remove();
            }
        });

        $(document).on('click', '#load-more-email', function () {
            let hiddenItems = $('.email-item.d-none');
            hiddenItems.slice(0, 3).removeClass('d-none');
            if ($('.email-item.d-none').length === 0) {
                $(this).parent().remove();
            }
        });

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

        // soruce
        $('#source').select2({
            placeholder: 'Choose Source',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '{{ route("searchSource") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term || ''
                    };
                },
                processResults: function (response) {
                    console.log(response);
                    return {
                        results: response
                    };
                }
            }
        });

        //company
        $('#company_id').select2({
            placeholder: 'Choose Company',
            allowClear: true,
            width: '100%',
            dropdownParent: $('#' + offcanvasId),
            ajax: {
                url: "{{ route('searchCompany') }}",
                type: "GET",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term || ''
                    };
                },
                processResults: function (response) {
                    return {
                        results: response
                    };
                },
                cache: true
            }
        });

        // stage
        $('#stage').select2({
            placeholder: 'Choose Stage',
            allowClear: true,
            width: '100%',
            ajax: {
                url: '{{ route("searchStage") }}',
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        search: params.term || ''
                    };
                },
                processResults: function (response) {
                    console.log(response);
                    return {
                        results: response
                    };
                }
            }
        });

        // checkox
        initCheckboxes();
    });
</script>
<script>
    // manage column
    document.addEventListener("DOMContentLoaded", function () {

        const storageKey = "table_columns_state";
        const table = document.querySelector("#data-table-container table");

        // -----------------------------
        // LOAD saved state
        // -----------------------------
        let savedState = JSON.parse(localStorage.getItem(storageKey) || "{}");

        // -----------------------------
        // Build dropdown dynamically
        // -----------------------------
        const list = document.getElementById("columnManagerList");

        table.querySelectorAll("thead th").forEach((th) => {

            const col = th.dataset.column;
            const label = th.innerText.trim();

            if (!col || col === "select") return;
            // default: true (visible)
            if (savedState[col] === undefined) {
                savedState[col] = true;
            }

            const li = document.createElement("li");

            li.className = "d-flex align-items-center mb-2 gap-2";

            li.innerHTML = `
                <div class="form-check form-switch w-100 ps-0">
                    <label class="form-check-label d-flex align-items-center gap-2 w-100">
                        <span>${label}</span>
                        <input type="checkbox"
                            class="form-check-input column-toggle ms-auto"
                            data-column="${col}"
                            ${savedState[col] ? "checked" : ""}>
                    </label>
                </div>
            `;

            list.appendChild(li);
            toggleColumn(col, savedState[col]);
        });

        // -----------------------------
        // ON CHANGE EVENT
        // -----------------------------
        document.querySelectorAll(".column-toggle").forEach(toggle => {
            toggle.addEventListener("change", function () {
                const col = this.dataset.column;
                const isVisible = this.checked;
                toggleColumn(col, isVisible);
                savedState[col] = isVisible;
                localStorage.setItem(storageKey, JSON.stringify(savedState));
            });
        });
    });

    // -----------------------------
    // SHOW / HIDE COLUMN
    // -----------------------------
    function toggleColumn(column, show) {
        document.querySelectorAll(`th[data-column="${column}"]`).forEach(el => el.style.display = show ? "" : "none");
        document.querySelectorAll(`td[data-column="${column}"]`).forEach(el => el.style.display = show ? "" : "none");
    }
</script>
@endpush
