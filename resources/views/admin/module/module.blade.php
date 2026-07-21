@extends('admin.layout.app')
@section('title', 'Manage Modules')
@section('subTitle', 'Module')
@section('content')
{{-- content --}}
<div class="content pb-0">
    <!-- Page Header -->
    <div class="mb-4">
        <h4 class="mb-1">@yield('title')</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('subTitle')</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Header -->

    <!-- start row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div></div>
                    <a href="javascript:void(0);" class="btn btn-primary add-item-btn" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"><i class="ti ti-square-rounded-plus-filled me-1"></i>Add
                        @yield('subTitle')
                    </a>
                </div>
                <div class="card-body">
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
                                        <th>Name</th>
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
                                        <td> <span style="font-weight: 600;">{{ trim(($row->module_name ?? 'N/A')) }}</span></td>
                                        <td>Admin</td>
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
                                                    <a class="dropdown-item edit-item-btn" data-id="{{ $row->module_id }}" href="javascript:void(0);" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" title="Edit" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="ti ti-edit text-blue"></i> Edit
                                                    </a>
                                                    <a class="dropdown-item remove-item-btn" href="#" data-id="{{ $row->module_id }}" data-bs-toggle="modal" data-bs-target="#deleteRecordModal" title="Delete" data-bs-toggle="tooltip" data-bs-placement="top">
                                                        <i class="ti ti-trash"></i> Delete
                                                    </a>
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
<div class="offcanvas offcanvas-end offcanvas-large" tabindex="-1" id="offcanvasRight"  data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="offcanvas-header border-bottom">
        <h5 class="fw-semibold" id="offcanvasRightLabel">Add New @yield('subTitle')</h5>
        <button type="button" class="btn-close custom-btn-close border p-1 me-0 d-flex align-items-center justify-content-center rounded-circle" data-bs-dismiss="offcanvas" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>
    <div class="offcanvas-body">
        <form action="{{ route('module.store') }}" id="addData" method="post">
            @csrf
            <input type="hidden" name="_method" value="POST">
            <div>
                <!-- Basic Info -->
                <div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">@yield('subTitle') Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="module_name" id="module_name">
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
                <p class="mb-3">Are you sure you want to remove this @yield('subTitle').</p>
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
// ==========================================================================
// 1. GLOBAL SCOPE ENGINE CORE UTILITIES
// ==========================================================================

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

// ==========================================================================
// 2. LIFECYCLE ROUTINE REGISTRATIONS (DOCUMENT READY)
// ==========================================================================
$(document).ready(function () {
    let deleteId = null;
    const deleteRoute = "{{ route('module.delete', ':id') }}";

    $('#addData').on('submit', function (e) {
        e.preventDefault();
        saveData();
    });

    $(document).on('click', '.edit-item-btn', function () {
        let id = $(this).data('id');
        const editUrl = "{{ route('module.edit', ':id') }}".replace(':id', id);
        const updateUrl = "{{ route('module.update', ':id') }}".replace(':id', id);

        $('#addData').attr('action', updateUrl);
        $('input[name="_method"]').val('PUT');
        $('#offcanvasRightLabel').text('Edit Module');
        $('#btnUpdate').text('Update');
        $('#table-loader').addClass('active');

        $.get(editUrl, function (res) {
            let moduleData = res.data?.data || res.data || res;

            $('#module_name').val(moduleData.module_name || moduleData.name);
            $('#status').val(moduleData.status).trigger('change');
            $('#table-loader').removeClass('active');
        }).fail(function() {
            $('#table-loader').removeClass('active');
        });
    });

    $('#offcanvasRight').on('hidden.bs.offcanvas', function () {
        $('#addData')[0].reset();
        $('#addData').find('.is-invalid').removeClass('is-invalid');
        $('#addData').find('.invalid-feedback').text('');

        $('#module_id').val(null).trigger('change');
        $('#status').val('').trigger('change');

        $('#addData').attr('action', "{{ route('module.store') }}");
        $('input[name="_method"]').val('POST');
        $('#offcanvasRightLabel').text('Add New Module');
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
});
</script>
@endpush
