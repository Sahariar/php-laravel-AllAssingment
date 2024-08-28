@props(['projects'])
<div class="bg-sd-bg py-20">
    <div class="max-w-[85rem] mx-auto">
        <h2 class="block font-medium text-gray-200 text-4xl sm:text-5xl md:text-6xl uppercase">Latest Work
        </h2>
    </div>
    <div class="max-w-[85rem] px-4 pt-6 lg:pt-10 pb-12 sm:px-6 lg:px-8 mx-auto">
        <div class="grid sm:grid-cols-12 gap-6">
            @foreach ($projects as $project)
                <div class="{{ $project['class'] }}"">
                    <!-- Card -->
                    <a class="group relative block rounded-xl overflow-hidden focus:outline-none"
                        href="{{ route('project.detail', $project['id']) }}">
                        <div class="aspect-w-12 aspect-h-7 sm:aspect-none rounded-xl overflow-hidden">
                            <img class="group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out rounded-xl w-full object-cover" src="{{ asset($project['image']) }}" alt={{ $project['title'] }}>
                        </div>
                        <div class="absolute bottom-0 start-0 end-0 p-2 sm:p-4">
                            <div class="text-sm font-semibold text-white rounded-lg bg-prime-bg p-4 md:text-xl">
                                {{ $project['title'] }}
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
