<div class="p-4 bg-white rounded-xl shadow">
    <h3 class="text-lg font-semibold mb-2">Pengaduan Berdasarkan Status</h3>
    <canvas id="statusChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxStatus = document.getElementById('statusChart');
        new Chart(ctxStatus, {
            type: 'doughnut',
            data: {
                labels: @json(collect($chartData)->pluck('label')),
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: @json(collect($chartData)->pluck('value')),
                    backgroundColor: ['#03A9F4', '#FFC107', '#8BC34A', '#E91E63'],
                }]
            },
        });
    </script>
</div>
