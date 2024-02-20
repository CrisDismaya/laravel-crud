
    function load(){
        select2Modal()
    }

    function showToast(status, message, title = '[Website]') {
        var toastHtml = `
            <div class="toast fade show" role="alert" aria-live="assertive" data-bs-autohide="false" aria-atomic="true">
                <div class="toast-header">
                    <img src="assets/images/logo-dark-sm.png" alt="brand-logo" class="me-2" height="18">
                    <strong class="me-auto text-${ status }"> ${ title } </strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${ message }
                </div>
            </div>
        `;

        $('#toast-container').append(toastHtml);
        setTimeout(function() {
            $('.toast').each(function(index) {
                $(this).delay(index * 500).fadeOut('slow', function() {
                    $(this).remove();
                });
            });
        }, 6000);
    }

    function addEllipsis(text, maxLength = 50) {
        if (text.length > maxLength) {
            // Find the last space within the maximum length
            let lastSpaceIndex = text.substring(0, maxLength).lastIndexOf(' ');

            if (lastSpaceIndex !== -1) {
                // Add ellipsis after the last space
                text = text.substring(0, lastSpaceIndex) + ` <span class="ellipsis-tooltip" tabindex="0" data-bs-placement="right" data-bs-toggle="tooltip" data-bs-title="${ text }">...</span>`;
            }
        }
        return text;
    }

    function select2Modal(){
        const selectElement = $(`.select2-modal`)
        const modalParent = selectElement.closest('.modal');

        selectElement.select2({
            dropdownParent: modalParent
        });
    }
