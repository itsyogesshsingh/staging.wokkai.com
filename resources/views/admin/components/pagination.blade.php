<div class="row align-items-center mt-3">
    {{-- LEFT INFO --}}
    <div class="col-md-6">
        <p class="mb-0 text-muted">
            Showing {{ $data->firstItem() }} to {{ $data->lastItem() }}
            of {{ $data->total() }} results
        </p>
    </div>

    {{-- RIGHT PAGINATION --}}
    <div class="col-md-6 d-flex justify-content-end">

        @if ($data->hasPages())
            <nav>
                <ul class="pagination pagination-soft-primary pagination-boxed mb-0 flex-wrap gap-1">

                    {{-- Previous --}}
                    <li class="page-item {{ $data->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->previousPageUrl() ?? '#' }}">
                            <i class="ti ti-chevron-left"></i>
                        </a>
                    </li>

                    {{-- First --}}
                    <li class="page-item {{ $data->currentPage() == 1 ? 'active' : '' }}">
                        <a class="page-link" href="{{ $data->url(1) }}">1</a>
                    </li>

                    {{-- Dots left --}}
                    @if ($data->currentPage() > 3)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                    {{-- Middle --}}
                    @for ($i = max(2, $data->currentPage() - 1); $i <= min($data->lastPage() - 1, $data->currentPage() + 1); $i++)
                        <li class="page-item {{ $data->currentPage() == $i ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor

                    {{-- Dots right --}}
                    @if ($data->currentPage() < $data->lastPage() - 2)
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    @endif

                    {{-- Last --}}
                    @if ($data->lastPage() > 1)
                        <li class="page-item {{ $data->currentPage() == $data->lastPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $data->url($data->lastPage()) }}">
                                {{ $data->lastPage() }}
                            </a>
                        </li>
                    @endif

                    {{-- Next --}}
                    <li class="page-item {{ !$data->hasMorePages() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $data->nextPageUrl() ?? '#' }}">
                            <i class="ti ti-chevron-right"></i>
                        </a>
                    </li>

                </ul>
            </nav>
        @endif
    </div>
</div>
