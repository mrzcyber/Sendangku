document.addEventListener('DOMContentLoaded', () => {
    if (window.lucide) {
        window.lucide.createIcons();
    }

    initCharts();

    // document.querySelectorAll('a').forEach((link) => {
    //     link.addEventListener('click', (event) => {
    //         event.preventDefault();
    //         document.getElementById('page-not-found-modal').classList.remove('hidden');
    //     });
    // });

    document.getElementById('search-modal').addEventListener('click', function (event) {
        if (event.target === this) {
            this.classList.add('hidden');
            this.classList.remove('flex');
        }
    });
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        document.getElementById('search-modal').classList.add('hidden');
        document.getElementById('search-modal').classList.remove('flex');
        closeDateModal();
        closeExportModal();
        closePageNotFoundModal();
    }
});

function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebar-overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
    document.body.classList.toggle('overflow-hidden');
}

function closePageNotFoundModal() {
    document.getElementById('page-not-found-modal').classList.add('hidden');
}

function openSearchModal() {
    const modal = document.getElementById('search-modal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.getElementById('search-input').focus();
}

function openDateModal() {
    const modal = document.getElementById('date-modal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeDateModal() {
    const modal = document.getElementById('date-modal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function selectDatePreset(button, text) {
    document.querySelectorAll('.date-preset').forEach((preset) => {
        preset.className = 'date-preset px-4 py-2 rounded-xl bg-white text-secondary font-medium text-sm border border-border hover:border-primary hover:text-primary transition-all cursor-pointer';
    });

    button.className = 'date-preset px-4 py-2 rounded-xl bg-primary/10 text-primary font-semibold text-sm border border-primary/20 cursor-pointer';
    button.dataset.selected = 'true';
}

function applyDateRange() {
    const activePreset = document.querySelector('.date-preset[class*="bg-primary/10"]');

    if (activePreset) {
        document.getElementById('dateRangeLabel').textContent = activePreset.textContent;
    } else {
        document.getElementById('dateRangeLabel').textContent = 'Custom Range';
    }

    closeDateModal();
    showToast('Date range updated', 'success');
}

function openExportModal() {
    const modal = document.getElementById('export-modal');

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}

function closeExportModal() {
    const modal = document.getElementById('export-modal');

    modal.classList.add('hidden');
    modal.classList.remove('flex');
}

function confirmExport(type) {
    closeExportModal();
    showToast(`Exporting ${type} report...`, 'success');

    setTimeout(() => {
        showToast('Download started', 'success');
    }, 1500);
}

function showToast(message, type = 'success') {
    const toast = document.getElementById('toast');
    const messageElement = document.getElementById('toast-message');
    const iconContainer = document.getElementById('toast-icon');

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

    if (!trafficCanvas || !deviceCanvas || !acquisitionCanvas) {
        return;
    }

    const trafficContext = trafficCanvas.getContext('2d');
    const gradient = trafficContext.createLinearGradient(0, 0, 0, 300);

    gradient.addColorStop(0, 'rgba(22, 93, 255, 0.2)');
    gradient.addColorStop(1, 'rgba(22, 93, 255, 0)');

    new window.Chart(trafficContext, {
        type: 'line',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            datasets: [{
                label: 'Visitors',
                data: [1250, 1900, 1500, 2200, 1800, 2800, 2400],
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

    new window.Chart(deviceCanvas.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: ['Mobile', 'Desktop', 'Tablet'],
            datasets: [{
                data: [55, 30, 15],
                backgroundColor: ['#165DFF', '#C9E6FC', '#E5E7EB'],
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

window.toggleSidebar = toggleSidebar;
window.closePageNotFoundModal = closePageNotFoundModal;
window.openSearchModal = openSearchModal;
window.openDateModal = openDateModal;
window.closeDateModal = closeDateModal;
window.selectDatePreset = selectDatePreset;
window.applyDateRange = applyDateRange;
window.openExportModal = openExportModal;
window.closeExportModal = closeExportModal;
window.confirmExport = confirmExport;
window.showToast = showToast;
