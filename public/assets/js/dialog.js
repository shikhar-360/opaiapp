document.addEventListener('DOMContentLoaded', () => {
    const openButtons = document.querySelectorAll('[data-dialog-target]');
    const closeButtons = document.querySelectorAll('[data-dialog-close="true"]');
    const backdrops = document.querySelectorAll('[data-dialog-backdrop]');

    function openDialog(name) {
        const backdrop = document.querySelector(
            `[data-dialog-backdrop="${name}"]`
        );
        if (!backdrop) return;

        backdrop.classList.remove('opacity-0', 'pointer-events-none');
        backdrop.classList.add('opacity-100', 'pointer-events-auto');
    }

    function closeDialog(name) {
        const backdrop = document.querySelector(
            `[data-dialog-backdrop="${name}"]`
        );
        if (!backdrop) return;

        backdrop.classList.add('opacity-0', 'pointer-events-none');
        backdrop.classList.remove('opacity-100', 'pointer-events-auto');
    }

    // Open button
    openButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const name = btn.getAttribute('data-dialog-target');
            if (name) openDialog(name);
        });
    });

    // Close button (X)
    closeButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const backdrop = btn.closest('[data-dialog-backdrop]');
            if (!backdrop) return;
            const name = backdrop.getAttribute('data-dialog-backdrop');
            if (name) closeDialog(name);
        });
    });

    // Click on backdrop to close
    backdrops.forEach((backdrop) => {
        backdrop.addEventListener('click', (e) => {
            if (e.target === backdrop) {
                const name = backdrop.getAttribute('data-dialog-backdrop');
                if (name) closeDialog(name);
            }
        });
    });
});
