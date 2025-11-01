<div class="max-w-2xl mx-auto p-4">
    @forelse($complaints as $complaint)
        <livewire:components.complaint-card :complaint="$complaint" :key="$complaint->id" />
    @empty
        <div class="text-center text-gray-500 py-4">
            Belum ada laporan pengaduan.
        </div>
    @endforelse
</div>
