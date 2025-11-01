<div>
    @if($isOpen)
        {{-- Modal Backdrop --}}
        <div
            x-data
            x-show="true"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="$wire.closeModal()"
            @keydown.escape.window="$wire.closeModal()"
            class="fixed inset-0 z-60 bg-black bg-opacity-45"
            style="background-color: rgba(0, 0, 0, 0.45);"
        ></div>

        {{-- Modal Content --}}
        <div
            class="fixed inset-0 flex items-center justify-center z-[999] p-4"
        >
            <div class="bg-white rounded-xl shadow-xl w-full max-w-5xl h-[90vh] flex overflow-hidden">
                {{-- Left Column - Image --}}
                <div class="w-1/2 h-full bg-gray-100 overflow-hidden">
                    @if($complaint && $complaint->media && $complaint->media->first())
                        <img
                            src="{{ asset($complaint->media->first()->file_url) }}"
                            alt="Gambar Pengaduan"
                            class="w-full h-full object-cover"
                        />
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-200">
                            <svg class="w-16 h-16 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    @endif
                </div>

                {{-- Right Column - Content --}}
                <div class="w-1/2 h-full flex flex-col relative">
                    {{-- Close Button --}}
                    <button
                        wire:click="closeModal"
                        class="absolute top-4 right-4 p-2 text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>

                    {{-- Post Header --}}
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                {{ strtoupper(substr($complaint->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div>
                                <div class="font-medium">{{ $complaint->user->name ?? 'Pengguna' }}</div>
                                <div class="text-xs text-gray-500">{{ $complaint->created_at->diffForHumans() }}</div>
                            </div>
                        </div>

                        <div class="text-sm text-gray-700 mb-4">
                            {{ $complaint->content ?? '' }}
                        </div>

                        @if($complaint->location)
                        <div class="flex items-center gap-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            <span>{{ $complaint->location }}</span>
                        </div>
                        @endif
                    </div>

                    {{-- Comments Section (Scrollable) --}}
                    <div class="flex-1 overflow-y-auto p-6 space-y-5">
                        @forelse($complaint->responses as $response)
                            <div class="flex gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-200">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white text-sm font-bold shadow-md">
                                    {{ strtoupper(substr($response->user->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span class="font-semibold text-gray-900 text-sm">{{ $response->user->name }}</span>
                                        <span class="text-gray-400 text-xs">•</span>
                                        <span class="text-gray-500 text-xs">{{ $response->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="text-gray-700 text-sm leading-relaxed break-words">
                                        {{ $response->content }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12">
                                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <p class="text-gray-400 text-sm">Belum ada komentar</p>
                                <p class="text-gray-300 text-xs mt-1">Jadilah yang pertama berkomentar!</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Comment Input --}}
                    @can('user')
                        <div class="p-4 border-t border-gray-200 bg-gray-50">
                            <div class="flex items-end gap-3">
                                <div class="w-10 h-10 rounded-full bg-blue-500 flex items-center justify-center text-white shadow-md">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div class="flex-1 relative">
                                    <input
                                        type="text"
                                        wire:model.live="comment"
                                        wire:keydown.enter.prevent="submitComment"
                                        placeholder="Tambah komentar..."
                                        class="w-full bg-white border border-gray-300 rounded-2xl px-4 py-3 pr-12 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
                                    />
                                    <button
                                        wire:click="submitComment"
                                        class="absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-blue-500 hover:text-blue-600 focus:outline-none"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    @endif
</div>
