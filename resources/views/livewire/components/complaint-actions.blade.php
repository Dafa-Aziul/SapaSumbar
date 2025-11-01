<div class="report-footer-actions" style="
    display: flex;
    align-items: center;
    gap: 24px;
    padding-top: 12px;
    border-top: 1px solid #E0E0E0;
    margin-top: 12px;
">
    {{-- Vote Button --}}
    <button wire:click="vote" style="
        display: flex; align-items: center; gap: 6px;
        background: none; border: none; cursor: pointer;
        font-size: 13px; font-weight: 500;
        color: {{ $hasVoted ? '#E53935' : '#616161' }};
        transition: all 0.25s ease-in-out;
        opacity: {{ $hasVoted ? '0.9' : '1' }};
    " onmouseover="if(!{{ $hasVoted ? 'true' : 'false' }}) this.style.color='#E53935'"
       onmouseout="if(!{{ $hasVoted ? 'true' : 'false' }}) this.style.color='#616161'">

        {{-- Ikon Upvote --}}
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2.5"
            stroke-linecap="round" stroke-linejoin="round"
            style="transition: transform 0.2s ease;
                   {{ $hasVoted ? 'transform: translateY(-2px) scale(1.2); color: #E53935;' : '' }}">
            <path d="M12 4l6 8H6l6-8z"></path>
        </svg>

        {{-- Label --}}
        @if($hasVoted)
            <span>Unvote ({{ $complaint->votes->count() ?? 0 }}) ✅</span>
        @else
            <span>Upvote ({{ $complaint->votes->count() ?? 0 }})</span>
        @endif
    </button>

    {{-- Comment Button --}}
    <button style="
        display: flex; align-items: center; gap: 6px;
        background: none; border: none; cursor: pointer;
        font-size: 13px; font-weight: 500; color: #616161;
        transition: color 0.2s;
    " onmouseover="this.style.color='#E53935'" onmouseout="this.style.color='#616161'">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
        </svg>
        <span>Comment ({{ $complaint->responses->count() ?? 0 }})</span>
    </button>
</div>
