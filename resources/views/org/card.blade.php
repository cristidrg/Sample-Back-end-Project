<article class="w-full mb-4 lg:w-56">
    <a class="block h-full px-4 py-6 bg-gray-800" href="/org/{{ $childOrg->id }}">
        <header>
            <h1 class="font-medium">{{ $childOrg->title }}</h1>
        </header>
        <div class="flex mt-4 mb-8">
            @if ($childOrg->getUptimeCount($childOrg) > 0)
            <div class="flex items-center flex-1 mt-4">
                @include('svgs.check')
                <p class="ml-2 text-sm font-light"><span class="text-base font-bold lg:text-lg">{{ $childOrg->getUptimeCount($childOrg) }}</span> Properties</p>
            </div>
            @endif
            @if ($childOrg->hasDownProps($childOrg))
                <div class="flex items-center flex-1 mt-4">
                    @include('svgs.warning')
                    <p class="ml-2 text-xs font-light lg:text-sm"><span class="text-base font-bold lg:text-lg">{{ $childOrg->getPropCount($childOrg) - $childOrg->getUptimeCount($childOrg) }}</span> Properties</p>
                </div>
            @endif
        </div>
        <div class="flex-col mt-auto text-sm text-gray-500">
            <div class="flex-1">
                <p class="mb-0">Accessibility</p>
                <div class="h-1 mt-1 bg-gray-700 audit_bar">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getScore('a11yScore')  }}%"></span>
                </div>
            </div>
            <div class="flex-1 mt-4">
                <p class="mb-0">SEO</p>
                <div class="h-1 mt-1 bg-gray-700 audit_bar">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getScore('seoScore')  }}%"></span>
                </div>
            </div>
            <div class="flex-1 mt-4">
                <p class="mb-0">Performance</p>
                <div class="h-1 mt-1 bg-gray-700 audit_bar">
                    <span class="bg-blue-400" style="width: {{ $childOrg->getScore('perfScore')  }}%"></span>
                </div>
            </div>
        </div>
    </a>
</article>
