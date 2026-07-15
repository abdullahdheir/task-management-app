@forelse($comments as $comment)
    <div class="flex gap-4" data-comment>
        <div class="w-10 h-10 rounded-full bg-primary dark:bg-primary-dark-fixed dark:bg-primary dark:bg-primary-dark-fixed-dark flex items-center justify-center text-primary dark:text-primary-dark font-bold">
            {{ substr($comment->user->name ?? 'U', 0, 2) }}
        </div>
        <div class="flex-1">
            <div class="flex items-center justify-between mb-1">
                <div class="flex items-center gap-2">
                    <span class="font-label-md text-label-md font-bold">{{ $comment->user->name ?? 'User' }}</span>
                    <span
                        class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">{{ $comment->created_at?->diffForHumans() }}</span>
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
                        class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:text-error dark:text-error-dark transition-colors p-1 rounded">
                        <span class="material-symbols-outlined text-[16px]">delete</span>
                    </button>
                @endif
            </div>
            <p class="font-body-md text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">{{ $comment->body }}</p>
        </div>
    </div>
@empty
    <p class="text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark text-label-sm text-center py-4">No comments yet</p>
@endforelse
