<div>
    {{-- Overlay --}}
    @if($isOpen)
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
        class="fixed inset-0 z-[999] bg-black bg-opacity-45"
        style="background-color: rgba(0, 0, 0, 0.45);"
    ></div>
    @endif

    {{-- Modal Container --}}
    @if($isOpen)
    <div 
        x-data
        x-show="true"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-[999] flex items-center justify-center p-4 pointer-events-none"
    >
        {{-- Modal Content --}}
        <div 
            @click.stop
            class="bg-white rounded-xl shadow-lg w-full max-w-[520px] max-h-[90vh] overflow-y-auto pointer-events-auto modal-content"
            style="
                padding: 24px 28px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            "
        >
            {{-- Header Section --}}
            <div class="relative mb-4">
                <h2 class="text-xl font-bold text-center text-[#212121] mb-4" style="font-family: 'Inter', sans-serif; font-size: 20px; font-weight: 700;">
                    Buat Pengaduan Baru
                </h2>
                
                {{-- Close Button --}}
                <button
                    type="button"
                    wire:click="closeModal"
                    aria-label="Tutup modal"
                    title="Tutup"
                    class="absolute top-0 right-0 rounded-full flex items-center justify-center border transition-all duration-200 hover:bg-[#FFEBEE] hover:border-[#C62828] z-10 cursor-pointer group focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:ring-offset-2"
                    style="
                        width: 32px;
                        height: 32px;
                        border: 1px solid #D32F2F;
                        background: transparent;
                    "
                >
                    <svg class="w-4 h-4 text-[#D32F2F] group-hover:text-[#C62828] transition-colors" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Info Box (Panduan Pengaduan) --}}
            <div class="mb-5 rounded-lg border" style="background-color: #E3F2FD; border: 1px solid #BBDEFB; border-radius: 8px; padding: 12px 16px;">
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-[#1976D2] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="text-sm font-semibold mb-1" style="font-size: 14px; font-weight: 600;">
                            Panduan Pengaduan
                        </h3>
                        <p class="text-sm" style="font-size: 13px; color: #424242;">
                            Pastikan pengaduan Anda disertai dengan bukti foto yang jelas.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form wire:submit.prevent="submit" class="flex flex-col" style="gap: 20px;">
                {{-- Kategori Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#212121] mb-2">
                        Kategori
                    </label>
                    <select 
                        wire:model="kategori"
                        class="w-full h-10 px-3 border border-[#E0E0E0] rounded-md focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent text-sm"
                    >
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoriOptions as $key => $label)
                            <option value="{{ $key }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <span class="text-xs text-[#D32F2F] mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Lokasi Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#212121] mb-2">
                        Lokasi Kejadian
                    </label>
                    <textarea 
                        wire:model="deskripsi"
                        rows="4"
                        placeholder="Jelaskan detail pengaduan anda …"
                        class="w-full px-3 py-2 border border-[#E0E0E0] rounded-md focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent text-sm resize-none"
                        style="height: 50px; border-radius: 6px;"
                    ></textarea>
                    @error('deskripsi')
                        <span class="text-xs text-[#D32F2F] mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Deskripsi Pengaduan Field --}}
                <div>
                    <label class="block text-sm font-medium text-[#212121] mb-2">
                        Deskripsi Pengaduan
                    </label>
                    <textarea 
                        wire:model="deskripsi"
                        rows="4"
                        placeholder="Jelaskan detail pengaduan anda …"
                        class="w-full px-3 py-2 border border-[#E0E0E0] rounded-md focus:outline-none focus:ring-2 focus:ring-[#D32F2F] focus:border-transparent text-sm resize-none"
                        style="height: 100px; border-radius: 6px;"
                    ></textarea>
                    @error('deskripsi')
                        <span class="text-xs text-[#D32F2F] mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Foto Bukti Upload Area --}}
                <div>
                    <label class="block text-sm font-medium text-[#212121] mb-2">
                        Foto Bukti
                    </label>
                    <div 
                        wire:click="$refs.fileInput.click()"
                        x-data="{ isDragging: false }"
                        @dragover.prevent="isDragging = true"
                        @dragleave.prevent="isDragging = false"
                        @drop.prevent="isDragging = false; $refs.fileInput.files = $event.dataTransfer.files; $refs.fileInput.dispatchEvent(new Event('change', { bubbles: true }))"
                        :class="{ 'border-[#1E88E5] bg-[#E3F2FD]': isDragging }"
                        wire:loading.class="opacity-50 cursor-not-allowed"
                        class="w-full border-2 border-dashed rounded-lg flex flex-col items-center justify-center cursor-pointer transition-colors hover:border-[#64B5F6] active:border-[#1E88E5] active:bg-[#E3F2FD]"
                        style="
                            height: 160px;
                            background-color: #FAFAFA;
                            border-color: #BDBDBD;
                            border-radius: 10px;
                            padding: 16px;
                            gap: 8px;
                        "
                    >
                        <input type="file" wire:model="foto_bukti" x-ref="fileInput" class="hidden" accept="image/*">
                        
                        @if($foto_bukti)
                            <div class="w-full h-full flex flex-col items-center justify-center">
                                <img src="{{ $foto_bukti->temporaryUrl() }}" alt="Preview" class="max-w-full max-h-32 object-contain rounded">
                                <span class="text-xs text-[#757575] mt-2">{{ $foto_bukti->getClientOriginalName() }}</span>
                            </div>
                        @else
                            <svg class="w-12 h-12 text-[#90CAF9]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                            <span class="text-sm text-[#757575]" style="font-size: 14px;">
                                Upload atau tarik foto ke sini
                            </span>
                        @endif
                        
                        <wire:loading wire:target="foto_bukti">
                            <span class="text-xs text-[#757575]">Uploading...</span>
                        </wire:loading>
                    </div>
                    @error('foto_bukti')
                        <span class="text-xs text-[#D32F2F] mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit Area (Bottom Action) --}}
                <div class="flex justify-end gap-3 mt-2">
                    <button
                        type="button"
                        wire:click="closeModal"
                        class="h-10 px-4 rounded-md font-semibold text-sm transition-colors"
                        style="
                            background-color: #E0E0E0;
                            color: #424242;
                            border-radius: 6px;
                            font-size: 14px;
                            font-weight: 600;
                        "
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="h-10 px-4 rounded-md font-semibold text-sm text-white transition-colors disabled:opacity-50"
                        style="
                            background-color: #D32F2F;
                            color: #FFFFFF;
                            border-radius: 6px;
                            font-size: 14px;
                            font-weight: 600;
                        "
                        onmouseover="this.style.backgroundColor='#B71C1C'"
                        onmouseout="this.style.backgroundColor='#D32F2F'"
                    >
                        <span wire:loading.remove wire:target="submit">Kirim Pengaduan</span>
                        <span wire:loading wire:target="submit">Mengirim...</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif

    {{-- Alpine.js x-cloak style --}}
    <style>
        [x-cloak] { display: none !important; }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .modal-content {
                width: 90vw !important;
                max-width: 90vw !important;
                padding: 16px !important;
            }
        }
        
        @media (max-width: 480px) {
            .modal-content {
                width: 100vw !important;
                max-width: 100vw !important;
                height: 100vh !important;
                max-height: 100vh !important;
                border-radius: 0 !important;
                padding: 20px 16px !important;
            }
            
            .modal-content h2 {
                font-size: 18px !important;
            }
            
            .modal-content button[type="button"] {
                width: 32px !important;
                height: 32px !important;
            }
        }
    </style>
</div>
