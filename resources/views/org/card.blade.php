<article>
    <a class="block py-6 px-3 mb-3 bg-gray-800" href="/org/{{$childOrg->id}}">
        <header>
            <h1 class="">{{$childOrg->title}}</h1>
        </header>
        <div class="h-24">
            @if ($childOrg->getUptimeCount($childOrg) > 0)
            <div class="mt-4 flex items-center">
                @include('svgs.check')
                <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$childOrg->getUptimeCount($childOrg)}} </span> Properties</p>
            </div>
            @endif
            @if ($childOrg->hasDownProps($childOrg))
                <div class="mt-4 flex items-center">
                    @include('svgs.warning')
                    <p class="ml-2 text-sm font-light"><span class="text-lg font-bold">{{$childOrg->getPropCount($childOrg) - $childOrg->getUptimeCount($childOrg)}} </span> Properties</p>
                </div>
            @endif
        </div>
        <div class="mt-auto flex flex-col text-gray-400">
            <div>
                <p class="mb1">Accessibility</p>
                <div class="audit_bar mt-2 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$childOrg->getA11yScore()}}%"></span>
                </div>
            </div>
            <div class="mt-4">
                <p class="mb1">SEO</p>
                <div class="audit_bar mt-2 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$childOrg->getSeoScore()}}%"></span>
                </div>
            </div>
            <div class="mt-4">
                <p class="mb1">Performance</p>
                <div class="audit_bar mt-2 h-1 bg-gray-700">
                    <span class="bg-blue-400" style="width: {{$childOrg->getPerfScore()}}%"></span>
                </div>
            </div>
        </div>
    </a>
</article>
