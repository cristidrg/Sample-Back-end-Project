<article class="w-full mb-4 lg:w-56">
    <a class="block py-6 h-full px-4 bg-gray-800" href="/org/{{ $childOrg->id }}">
        <header>
            <h1 class="font-medium">{{ $childOrg->title }}</h1>
        </header>
        <div class="mt-4 mb-8 flex">
            @if ($childOrg->getUptimeCount($childOrg) > 0)
            <div class="mt-4 flex flex-1 items-center">
                @include('svgs.check')
                <p class="ml-2 text-sm font-light"><span class="text-base lg:text-lg font-bold">{{ $childOrg->getUptimeCount($childOrg) }}</span> Properties</p>
            </div>
            @endif
            @if ($childOrg->hasDownProps($childOrg))
                <div class="mt-4 flex flex-1 items-center">
                    @include('svgs.warning')
                    <p class="ml-2 text-xs lg:text-sm font-light"><span class="text-base lg:text-lg font-bold">{{ $childOrg->getPropCount($childOrg) - $childOrg->getUptimeCount($childOrg) }}</span> Properties</p>
                </div>
            @endif
        </div>
        <div class="mt-auto flex-col text-gray-500 text-sm">
            <div class="flex-1">
                <p class="mb-0">Accessibility</p>
                <div class="audit_bar mt-1 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getA11yScore() * 100 }}%"></span>
                </div>
            </div>
            <div class="flex-1 mt-4">
                <p class="mb-0">SEO</p>
                <div class="audit_bar mt-1 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getSeoScore() * 100 }}%"></span>
                </div>
            </div>
            <div class="flex-1 mt-4">
                <p class="mb-0">Performance</p>
                <div class="audit_bar mt-1 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getPerfScore() * 100 }}%"></span>
                </div>
            </div>
        </div>
    </a>
</article>
