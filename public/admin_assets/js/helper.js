function showToast(type = 'success', title = 'Admin', message = '', duration = 4000) {

    const toastId = 'toast-' + Date.now();
    const icons = {
        success: '✔',
        danger: '✖',
        warning: '⚠',
        info: 'ℹ'
    };
    const toastHtml = `
        <div id="${toastId}"
             class="toast align-items-center text-bg-${type} border-0 mb-2"
             role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">

                <div class="toast-body">
                    <strong>${icons[type] ?? ''} ${title}</strong><br>
                    ${message}
                </div>

                <button type="button"
                        class="btn-close btn-close-white me-2 m-auto"
                        data-bs-dismiss="toast"></button>

            </div>
        </div>
    `;

    $('#toastContainer').append(toastHtml);

    const toastEl = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastEl, {
        autohide: true,
        delay: duration
    });
    toast.show();
    toastEl.addEventListener('hidden.bs.toast', function () {
        $(this).remove();
    });
    return toastEl;
}

/**
 *
 * skeleton loader for table, can be used while fetching data via ajax to show loading state
*/
function showTableSkeleton(rowCount = 8) {
    let skeleton = '';

    for (let i = 0; i < rowCount; i++) {
        skeleton += `
        <tr class="table-skeleton">
            <td colspan="9">
                <div class="skeleton-line"></div>
            </td>
        </tr>`;
    }

    $('#data-table-body').html(skeleton);
}
