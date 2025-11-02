<div class="p-4 bg-white rounded-xl shadow">
    <h3 class="text-lg font-semibold mb-2">Pengaduan Berdasarkan Kategori</h3>
    <canvas id="categoryChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctxCategory = document.getElementById('categoryChart');
        new Chart(ctxCategory, {
            type: 'doughnut',
            data: {
                labels: @json(collect($chartData)->pluck('label')),
                datasets: [{
                    label: 'Jumlah Pengaduan',
                    data: @json(collect($chartData)->pluck('value')),
                    backgroundColor: ['#2196F3', '#4CAF50', '#FFC107', '#FF5722', '#9C27B0'],
                }]
            },
        });
    </script>
</div>
