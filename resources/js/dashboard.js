// Shared helpers for all dashboard Blade views.
function refreshIcons() {
    if (window.lucide) {
        window.lucide.createIcons();
    }
}

function hideModal(modal) {
    if (!modal) {
        return;
    }

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function showModal(modal) {
    if (!modal) {
        return;
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

// Global dashboard bootstrapping.
document.addEventListener('DOMContentLoaded', () => {
    refreshIcons();
    initCharts();

    const notificationModal = document.getElementById('notification-modal');

    if (notificationModal) {
        notificationModal.addEventListener('click', function (event) {
            if (event.target === this) {
                closeNotificationModal();
            }
        });
    }
});

// Shared keyboard behavior for modal components in dashboard layouts/views.
document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeNotificationModal();
        closeDateModal();
        closeExportModal();
        closeLogoutModal();
        closePageNotFoundModal();
    }
});

// Used by layouts/dashboard.blade.php and x-sidebar for mobile sidebar open/close.
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    if (!sidebar || !overlay) {
        return;
    }

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
    document.body.classList.toggle('overflow-hidden');
}

// Used by page-not-found modal in admin/index.blade.php and admin/restaurant/index.blade.php.
function closePageNotFoundModal() {
    hideModal(document.getElementById('page-not-found-modal'));
}

// Used by notification bell in admin/index.blade.php and admin/restaurant/index.blade.php.
function openNotificationModal() {
    showModal(document.getElementById('notification-modal'));
}

function closeNotificationModal() {
    hideModal(document.getElementById('notification-modal'));
}

// Used by date range modal in admin/index.blade.php.
function openDateModal() {
    showModal(document.getElementById('date-modal'));
}

function closeDateModal() {
    hideModal(document.getElementById('date-modal'));
}

// Used by date preset buttons in admin/index.blade.php.
function selectDatePreset(button, text) {
    document.querySelectorAll('.date-preset').forEach((preset) => {
        preset.className = 'date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer';
    });

    button.className = 'date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer';
    button.dataset.selected = 'true';
}

// Used by apply date range button in admin/index.blade.php.
function applyDateRange() {
    const activePreset = document.querySelector('.date-preset[class*="bg-primary/10"]');
    const dateRangeLabel = document.getElementById('dateRangeLabel');

    if (dateRangeLabel) {
        dateRangeLabel.textContent = activePreset ? activePreset.textContent : 'Custom Range';
    }

    closeDateModal();
    showToast('Date range updated', 'success');
}

// Used by export format modal in admin/index.blade.php.
function openExportModal() {
    showModal(document.getElementById('export-modal'));
}

function closeExportModal() {
    hideModal(document.getElementById('export-modal'));
}

// Used by export format buttons in admin/index.blade.php.
function confirmExport(type) {
    closeExportModal();
    showToast(`Exporting ${type} report...`, 'success');

    setTimeout(() => {
        showToast('Download started', 'success');
    }, 1500);
}

// Used by report buttons in admin/index.blade.php and export action in admin/restaurant/index.blade.php.
function showToast(message, type = 'success') {
    const container = document.getElementById('toast-container');

    if (container) {
        const toast = document.createElement('div');
        const bgClass = type === 'success' ? 'bg-success text-white' : 'bg-error text-white';
        const icon = type === 'success' ? 'check-circle' : 'alert-circle';

        toast.className = `flex items-center gap-3 px-4 py-3 rounded-2xl shadow-lg transform transition-all duration-300 translate-y-10 opacity-0 ${bgClass}`;
        toast.innerHTML = `
            <i data-lucide="${icon}" class="size-5 shrink-0"></i>
            <p class="font-medium text-sm">${message}</p>
        `;

        container.appendChild(toast);
        refreshIcons();

        requestAnimationFrame(() => {
            toast.classList.remove('translate-y-10', 'opacity-0');
        });

        setTimeout(() => {
            toast.classList.add('opacity-0', 'translate-y-2');
            setTimeout(() => toast.remove(), 300);
        }, 3000);

        return;
    }

    const toast = document.getElementById('toast');
    const messageElement = document.getElementById('toast-message');
    const iconContainer = document.getElementById('toast-icon');

    if (!toast || !messageElement || !iconContainer) {
        return;
    }

    messageElement.textContent = message;

    if (type === 'success') {
        iconContainer.className = 'w-6 h-6 rounded-full bg-success flex items-center justify-center shrink-0';
        iconContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><polyline points="20 6 9 17 4 12"></polyline></svg>';
    } else {
        iconContainer.className = 'w-6 h-6 rounded-full bg-error flex items-center justify-center shrink-0';
        iconContainer.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="text-white"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>';
    }

    toast.classList.remove('translate-y-24');

    setTimeout(() => {
        toast.classList.add('translate-y-24');
    }, 3000);
}

// Used by chart canvases in admin/index.blade.php.
function initCharts() {
    if (!window.Chart) {
        return;
    }

    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: '#080C1A',
                titleColor: '#fff',
                bodyColor: '#fff',
                padding: 10,
                cornerRadius: 8,
                displayColors: false,
            },
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686' },
            },
            y: {
                border: { display: false },
                grid: { color: '#F3F4F3', borderDash: [5, 5] },
                ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686', maxTicksLimit: 5 },
            },
        },
    };

    const trafficCanvas = document.getElementById('trafficChart');
    const deviceCanvas = document.getElementById('deviceChart');
    const acquisitionCanvas = document.getElementById('acquisitionChart');

    if (trafficCanvas) {
        const trafficContext = trafficCanvas.getContext('2d');
        const gradient = trafficContext.createLinearGradient(0, 0, 0, 300);
        let labels = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        let values = [0, 0, 0, 0, 0, 0, 0];

        try {
            labels = JSON.parse(trafficCanvas.dataset.labels || '[]');
            values = JSON.parse(trafficCanvas.dataset.values || '[]');
        } catch (error) {
            console.warn('Dashboard traffic data could not be parsed.', error);
        }

        gradient.addColorStop(0, 'rgba(22, 93, 255, 0.2)');
        gradient.addColorStop(1, 'rgba(22, 93, 255, 0)');

        new window.Chart(trafficContext, {
            type: 'line',
            data: {
                labels,
                datasets: [{
                    label: 'Visitors',
                    data: values,
                    borderColor: '#165DFF',
                    backgroundColor: gradient,
                    borderWidth: 3,
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#165DFF',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4,
                }],
            },
            options: commonOptions,
        });
    }

    if (deviceCanvas) {
        const onlineVal = Number(deviceCanvas.dataset.online ?? 0);
        const offlineVal = Number(deviceCanvas.dataset.offline ?? 0);

        new window.Chart(deviceCanvas.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Online', 'Offline'],
                datasets: [{
                    data: [onlineVal, offlineVal],
                    backgroundColor: ['#165DFF', '#C9E6FC'],
                    borderWidth: 0,
                    hoverOffset: 4,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '75%',
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#080C1A',
                        callbacks: {
                            label(context) {
                                return ` ${context.label}: ${context.raw}%`;
                            },
                        },
                    },
                },
            },
        });
    }

    if (acquisitionCanvas) {
        new window.Chart(acquisitionCanvas.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Direct', 'Social', 'Organic', 'Referral', 'Email'],
                datasets: [{
                    label: 'Users',
                    data: [4500, 3200, 5100, 1800, 2400],
                    backgroundColor: '#165DFF',
                    borderRadius: 6,
                    barThickness: 24,
                }],
            },
            options: {
                ...commonOptions,
                scales: {
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Lexend Deca', sans-serif" }, color: '#6A7686' },
                    },
                    y: {
                        display: false,
                    },
                },
            },
        });
    }
}

// Used by logout button/modal in x-sidebar and admin/restaurant/index.blade.php.
function showLogoutModal() {
    showModal(document.getElementById('logout-modal'));
}

function closeLogoutModal() {
    hideModal(document.getElementById('logout-modal'));
}

function confirmLogout() {
    document.getElementById('logout-form').submit();
}

// Used by Export Report button in admin/restaurant/index.blade.php.
function handleExport() {
    const button = document.getElementById('exportBtn');

    if (!button) {
        return;
    }

    const originalContent = button.innerHTML;

    button.innerHTML = '<i data-lucide="loader-2" class="size-5 animate-spin"></i><span>Exporting...</span>';
    button.disabled = true;
    button.classList.add('opacity-80');
    refreshIcons();

    setTimeout(() => {
        button.innerHTML = originalContent;
        button.disabled = false;
        button.classList.remove('opacity-80');
        refreshIcons();
        showToast('Financial report exported successfully', 'success');
    }, 1500);
}

// Expose functions used by inline onclick attributes in Blade files.
window.toggleSidebar = toggleSidebar;
window.closePageNotFoundModal = closePageNotFoundModal;
window.openNotificationModal = openNotificationModal;
window.closeNotificationModal = closeNotificationModal;
window.openDateModal = openDateModal;
window.closeDateModal = closeDateModal;
window.selectDatePreset = selectDatePreset;
window.applyDateRange = applyDateRange;
window.openExportModal = openExportModal;
window.closeExportModal = closeExportModal;
window.confirmExport = confirmExport;
window.showToast = showToast;
window.showLogoutModal = showLogoutModal;
window.closeLogoutModal = closeLogoutModal;
window.confirmLogout = confirmLogout;
window.handleExport = handleExport;
