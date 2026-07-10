@forelse($comments as $comment)
    <div class="flex gap-4" data-comment>
        <div class="w-10 h-10 rounded-full bg-primary-fixed flex items-center justify-center text-primary font-bold">
            {{ substr($comment->user->name ?? 'U', 0, 2) }}
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between mb-1">
                <div class="flex items-center gap-2">
                    <span class="font-label-md text-label-md font-bold">{{ $comment->user->name ?? 'User' }}</span>
                    <span
                        class="text-label-sm text-on-surface-variant">{{ $comment->created_at?->diffForHumans() }}</span>
                </div>
                @if (auth()->id() === $comment->user_id)
                    <button x-data
                        @click="
                                ajax.delete('{{ route('comments.destroy', $comment) }}')
                                    .then(res => {
                                        if(res.status === 'success') {
                                            $el.closest('[data-comment]').remove();
                                            toast('Comment deleted');
                                        }
                                    })"
                        class="text-on-surface-variant hover:text-error transition-colors p-1 rounded">
                        <span class="material-symbols-outlined text-[16px]">delete</span>
                    </button>
                @endif
            </div>
            <p class="font-body-md text-body-md text-on-surface-variant">{{ $comment->body }}</p>
        </div>
    </div>
@empty
    <p class="text-on-surface-variant text-label-sm text-center py-4">No comments yet</p>
@endforelse
