<div>
    @if($isOpen)
        {{-- Overlay --}}
        <div class="fixed inset-0 bg-black bg-opacity-40 z-40" wire:click="closeModal"></div>

        {{-- Modal Box --}}
        <div class="fixed inset-0 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-xl shadow-xl w-full max-w-3xl h-[80vh] flex flex-col relative overflow-hidden">
                <button wire:click="closeModal" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">✕</button>

                <div class="p-4 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Komentar</h2>
                    <p class="text-sm text-gray-500 truncate">{{ $complaint->content ?? '' }}</p>
                </div>

                <div class="flex-1 overflow-y-auto p-4 space-y-3">
                    @forelse($complaint->responses as $response)
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-semibold text-xs">
                                {{ strtoupper(substr($response->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 text-sm">
                                    <span class="font-medium">{{ $response->user->name }}</span>
                                    <span class="text-gray-400 text-xs">{{ $response->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-gray-700 text-sm mt-1">{{ $response->content }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center text-gray-400 text-sm py-10">Belum ada komentar.</div>
                    @endforelse
                </div>

                <div class="p-4 border-t flex items-center gap-3">
                    <input type="text" wire:model.defer="comment" wire:keydown.enter="submitComment"
                        placeholder="Tulis komentar..." class="flex-1 bg-gray-100 rounded-full px-4 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button wire:click="submitComment" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full text-sm">
                        Kirim
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
