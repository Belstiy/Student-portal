document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector('.search-form');
    const table = document.querySelector('.result-table');
    const header = document.querySelector('.header');
    const summary = document.querySelector('.summary');
    const printBtn = document.querySelector('button[onclick*="print"]');

    // Responsive adjustments
    function applyResponsiveStyles() {
        const screenWidth = window.innerWidth;

        if (screenWidth < 768) {
            // Mobile
            form.style.flexDirection = 'column';
            form.style.padding = '1rem';
            header.style.flexDirection = 'column';
            header.style.textAlign = 'center';
            if (printBtn) printBtn.style.width = '100%';

            if (table) {
                table.style.fontSize = '14px';
                table.style.overflowX = 'auto';
            }

            if (summary) {
                summary.style.display = 'block';
                summary.style.textAlign = 'left';
            }
        } else if (screenWidth >= 768 && screenWidth < 1024) {
            // Tablet
            form.style.flexDirection = 'row';
            form.style.flexWrap = 'wrap';
            form.style.justifyContent = 'space-between';
            if (printBtn) printBtn.style.width = '50%';

            if (table) {
                table.style.fontSize = '16px';
            }
        } else {
            // PC
            form.style.flexDirection = 'row';
            form.style.justifyContent = 'space-around';
            if (printBtn) printBtn.style.width = 'auto';

            if (table) {
                table.style.fontSize = '16px';
            }
        }
    }

    applyResponsiveStyles();
    window.addEventListener('resize', applyResponsiveStyles);
});
