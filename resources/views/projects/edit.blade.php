@extends('layouts.app')

@section('title', 'Edit Project')

@push('styles')
    <style>
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 24px;
        }
    </style>
@endpush

@section('content')
    <!-- Breadcrumbs / Header Section -->
    <div class="mb-10">
        <div class="flex items-center gap-2 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-2">
            <span class="font-label-md text-label-md">Projects</span>
            <span class="material-symbols-outlined text-[14px]">chevron_right</span>
            <span class="font-label-md text-label-md text-primary dark:text-primary-dark font-bold">Edit Project</span>
        </div>
        <div class="flex justify-between items-end">
            <div>
                <h2 class="font-headline-lg text-headline-lg text-on-surface dark:text-on-surface-dark">{{ $project->name }}</h2>
                <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-1">Managed by {{ $project->owner->name ?? 'Unknown' }} •
                    Project ID: {{ $project->id }}</p>
            </div>
            <div class="flex gap-3">
                <form action="{{ route('projects.destroy', $project) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button
                        class="bg-surface dark:bg-surface-dark border border-error dark:border-error-dark text-error dark:text-error-dark px-6 py-2.5 rounded-lg font-label-md text-label-md hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/10 transition-colors flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">delete</span>
                        Delete Project
                    </button>
                </form>
            </div>
        </div>
    </div>
    <!-- Content Bento Grid -->
    <div class="bento-grid">
        <!-- Main Form Column -->
        <div class="col-span-12 lg:col-span-8 space-y-6">
            <!-- Basic Information Card -->
            <section class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-sm">
                <form action="{{ route('projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center gap-2 mb-6">
                        <span class="material-symbols-outlined text-primary dark:text-primary-dark">info</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">General Details</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="flex flex-col gap-2">
                            <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Project Name</label>
                            <input
                                class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-3 text-body-md focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 outline-none transition-all"
                                type="text" name="name" value="{{ old('name', $project->name) }}" />
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Category</label>
                            <select
                                class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-3 text-body-md focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 outline-none transition-all appearance-none bg-no-repeat bg-[right_1rem_center]"
                                name="category">
                                <option value="design"
                                    {{ old('category', $project->category) === 'design' ? 'selected' : '' }}>Design</option>
                                <option value="branding"
                                    {{ old('category', $project->category) === 'branding' ? 'selected' : '' }}>Branding
                                </option>
                                <option value="marketing"
                                    {{ old('category', $project->category) === 'marketing' ? 'selected' : '' }}>Marketing
                                </option>
                                <option value="engineering"
                                    {{ old('category', $project->category) === 'engineering' ? 'selected' : '' }}>
                                    Engineering</option>
                            </select>
                        </div>
                        <div class="col-span-full flex flex-col gap-2">
                            <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Description</label>
                            <textarea
                                class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-3 text-body-md focus:border-primary dark:focus:border-primary-dark dark:border-primary-dark focus:ring-0 outline-none transition-all"
                                rows="4" name="description">{{ old('description', $project->description) }}</textarea>
                        </div>
                    </div>
            </section>
            <!-- Status and Timeline -->
            <section class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-sm">
                <div class="flex items-center gap-2 mb-6">
                    <span class="material-symbols-outlined text-primary dark:text-primary-dark">schedule</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Status & Timeline</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Current Status</label>
                        <div
                            class="flex items-center gap-2 px-3 py-2 bg-secondary dark:bg-secondary-dark-container dark:bg-secondary dark:bg-secondary-dark-container-dark text-on-secondary dark:text-on-secondary-dark-container dark:text-on-secondary dark:text-on-secondary-dark-container-dark rounded-full w-fit">
                            <span class="w-2 h-2 rounded-full bg-secondary dark:bg-secondary-dark"></span>
                            <span class="text-label-sm font-label-sm">Active & On-track</span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Start Date</label>
                        <input class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-2.5 text-body-md" type="date"
                            name="start_date" value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}" />
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Target Deadline</label>
                        <input class="border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark rounded-lg px-4 py-2.5 text-body-md" type="date"
                            name="end_date" value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}" />
                    </div>
                </div>
                <!-- Progress Indicator -->
                <div class="mt-8">
                    <div class="flex justify-between mb-2">
                        <span class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">Project Completion</span>
                        <span
                            class="font-label-md text-label-md text-secondary dark:text-secondary-dark font-bold">{{ $project->progress ?? 0 }}%</span>
                    </div>
                    <div class="w-full bg-surface dark:bg-surface-dark-container-highest h-1.5 rounded-full overflow-hidden">
                        <div class="bg-secondary dark:bg-secondary-dark h-full" style="width: {{ $project->progress ?? 0 }}%"></div>
                    </div>
                </div>
            </section>
            <div class="flex justify-end gap-3">
                <a href="{{ route('projects.show', $project) }}"
                    class="px-6 py-2.5 rounded-lg font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-low transition-colors">Cancel</a>
                <button type="submit"
                    class="bg-primary dark:bg-primary-dark text-on-primary dark:text-on-primary-dark px-8 py-2.5 rounded-lg font-label-md text-label-md shadow-md hover:shadow-lg transition-all active:scale-[0.98]">Save
                    Changes</button>
            </div>
            </form>
        </div>
        <!-- Team & Secondary Column -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <!-- Team Management Card -->
            <section class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-sm">
                <div class="flex justify-between items-center mb-6">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary dark:text-primary-dark">groups</span>
                        <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Team</h3>
                    </div>
                </div>
                <div class="space-y-4">
                    @forelse($members as $member)
                        <div x-data="{ open: false }" @click.outside="open = false"
                            class="flex items-center justify-between p-3 rounded-lg border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark hover:bg-surface dark:bg-surface-dark transition-colors group">
                            <a href="{{ route('profile.show', $member) }}" class="flex items-center gap-3 flex-1">
                                <img class="w-10 h-10 rounded-full object-cover border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark"
                                    src="{{ $member->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($member->name) . '&size=40' }}"
                                    alt="{{ $member->name }}">
                                <div>
                                    <p class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark">{{ $member->name }}</p>
                                    <p class="text-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                                        {{ $member->pivot->role ?? 'Team Member' }}
                                    </p>
                                </div>
                            </a>
                            @if (auth()->id() === $project->owner_id && auth()->id() !== $member->id)
                                <div class="relative">
                                    <button @click.stop="open = !open"
                                        class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark opacity-0 group-hover:opacity-100 transition-opacity p-1 rounded-full hover:bg-surface dark:bg-surface-dark-container">
                                        more_vert
                                    </button>
                                    <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                        x-transition:enter-start="opacity-0 scale-95"
                                        x-transition:enter-end="opacity-100 scale-100"
                                        x-transition:leave="transition ease-in duration-75"
                                        x-transition:leave-start="opacity-100 scale-100"
                                        x-transition:leave-end="opacity-0 scale-95"
                                        class="absolute right-0 top-8 w-48 bg-surface dark:bg-surface-dark border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark
                                            rounded-xl shadow-xl z-50 overflow-hidden py-1"
                                        style="display:none">
                                        <a href="{{ route('profile.show', $member) }}"
                                            class="flex items-center gap-3 px-4 py-2.5 text-on-surface dark:text-on-surface-dark hover:bg-surface dark:bg-surface-dark-container
                                              transition-colors font-label-md text-label-md">
                                            <span
                                                class="material-symbols-outlined text-[18px] text-secondary dark:text-secondary-dark">person</span>
                                            View Profile
                                        </a>
                                        <div class="border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark my-1"></div>
                                        <button
                                            @click="
                                                open = false;
                                                if(confirm('Remove this member?')) {
                                                    ajax.delete('{{ route('projects.members.remove', [$project, $member]) }}')
                                                        .then(res => {
                                                            if(res.status === 'success') {
                                                                $el.closest('.flex.items-center.justify-between').remove();
                                                                toast('Member removed');
                                                            } else {
                                                                toast(res.message ?? 'Error', 'error');
                                                            }
                                                        });
                                                }"
                                            class="w-full flex items-center gap-3 px-4 py-2.5 text-error dark:text-error-dark
                                               hover:bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark/20 transition-colors font-label-md text-label-md">
                                            <span class="material-symbols-outlined text-[18px]">person_remove</span>
                                            Remove Member
                                        </button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div class="text-center py-4 text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">
                            <p class="text-label-sm">No team members yet</p>
                        </div>
                    @endforelse
                </div>
                <div class="mt-6 pt-6 border-t border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark">
                    <p class="font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-4">Sharing Permissions</p>
                    <div class="flex items-center justify-between py-2">
                        <span class="text-body-md">External collaborators can view</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input checked="" class="sr-only peer" type="checkbox" />
                            <div
                                class="w-11 h-6 bg-outline-variant peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white dark:bg-surface-container-low-dark after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary dark:bg-primary-dark">
                            </div>
                        </label>
                    </div>
                </div>
            </section>
            <!-- Visual Preview / Moodboard -->
            <section class="bg-surface dark:bg-surface-dark-container-lowest rounded-xl border border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark p-stack-lg shadow-sm">
                <div class="flex items-center gap-2 mb-4">
                    <span class="material-symbols-outlined text-primary dark:text-primary-dark">image</span>
                    <h3 class="font-headline-md text-headline-md text-on-surface dark:text-on-surface-dark">Project Assets</h3>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div class="aspect-square rounded-lg bg-cover bg-center"
                        data-alt="A collection of minimalist logo variations and color swatches on a clean digital board, deep indigo and emerald accents, professional brand identity moodboard, high resolution digital design."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuDzF8vNHWUbZhvhkX3BSVeYImDob-nFTT2ha2c02ptQWzAnNwXSEtEZqQf2bW2h9xa6ndbuAAtFwE0baj-xKKcb4FdZxMLO42_LyrzN--6_E7NJBUhe6d00Wxo5DzaFnEb6ekouEmEEnPINY_TLqar6ynp4nT3QfhJPv5Oe_aRDSJvR6cc143_N8PjNixlfZxazuTpSPmG5sNRs1WIXcUkjHO2e-kR4vcCVi9xrzzMSGSSbco0S0lwdlg')">
                    </div>
                    <div class="aspect-square rounded-lg bg-cover bg-center"
                        data-alt="Close up of a modern sans-serif typography specimen in high contrast black and white, clean corporate aesthetic, professional graphic design showcase."
                        style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuBM49sD02cZ_0NV3POOPWNzwCICvy90B_DVqZDc1sGAFcwhB7ABq5_tTyLM41Xsl6uCXJwlXc9mhC0ddKuhPIdbZB90Y2zInKLv45sI2bygUwGnnG-ysI8AB0lnPS4UOwZR1DmEXbJ0cvU_rgyyYQ5i643wMFU5ZY-QHicesq-n5oAdhZ7o4Q_CETUg6mCOV3cLNIfsx7PYEK1OnUYpZ8wLb4lDp3E-vfPKvJjQGVvSRWV-r2Hil8A6VA')">
                    </div>
                    <div
                        class="aspect-square rounded-lg bg-surface dark:bg-surface-dark-container-low border border-dashed border-outline dark:border-outline-dark-variant dark:border-outline dark:border-outline-dark-variant-dark flex flex-col items-center justify-center cursor-pointer hover:bg-surface dark:bg-surface-dark-container-high transition-colors col-span-2">
                        <span class="material-symbols-outlined text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark">upload_file</span>
                        <span class="text-label-sm font-label-sm text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mt-1">Upload More</span>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <!-- Delete Confirmation Modal (Hidden by Default) -->
    <div class="hidden fixed inset-0 z-[100] flex items-center justify-center px-4" id="deleteModal">
        <div class="absolute inset-0 bg-on-surface/40 backdrop-blur-sm"></div>
        <div
            class="relative bg-surface dark:bg-surface-dark-container-lowest w-full max-w-md rounded-2xl p-stack-lg shadow-2xl animate-in fade-in zoom-in duration-300">
            <div class="flex items-center gap-4 text-error dark:text-error-dark mb-4">
                <div class="bg-error dark:bg-error-dark-container dark:bg-error dark:bg-error-dark-container-dark p-3 rounded-full">
                    <span class="material-symbols-outlined text-[32px]">warning</span>
                </div>
                <h3 class="font-headline-md text-headline-md">Delete Project?</h3>
            </div>
            <p class="text-body-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark mb-8">
                This action is permanent and cannot be undone. All project data, including tasks, files, and team access,
                will be purged from the workspace.
            </p>
            <div class="flex gap-3 justify-end">
                <button
                    class="px-6 py-2.5 rounded-lg font-label-md text-label-md text-on-surface dark:text-on-surface-dark-variant dark:text-on-surface dark:text-on-surface-dark-variant-dark hover:bg-surface dark:bg-surface-dark-container-low transition-colors"
                    onclick="toggleDeleteModal()">Cancel</button>
                <button
                    class="px-6 py-2.5 rounded-lg font-label-md text-label-md bg-error dark:bg-error-dark text-on-error dark:text-on-error-dark shadow-md hover:bg-error dark:bg-error-dark/90 transition-colors">Yes,
                    Delete Everything</button>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
