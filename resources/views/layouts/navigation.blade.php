        <div class="z-10 w-full px-3 py-6 bg-gray-800 lg:fixed lg:w-nav lg:h-full lg:py-10 lg:px-6">
            <div class="flex items-center w-full">
                <a class="text-2xl font-bold text-gray-100" href="/">NUprops</a>
                <div class="ml-auto nav__handle lg:hidden">
                    @include('svgs/menu')
                </div>
            </div>
            <nav id="navigation" class="flex flex-col h-full" data-navigation-handle=".nav__handle" role="navigation">
                <form id="nav_form" action="/search" class="flex flex-col py-8 bg-gray-800" method="POST" role="search">
                    @csrf
                    <input class="w-full px-1 py-2 mb-8 text-xs text-white bg-transparent border border-gray-400" name="search_title" type="text" placeholder="Search props by title"
                    value="{{$q}}">

                    <p class="text-lg font-extrabold">Jump to props with</p>
                    <div class="text-sm text-gray-600 nav__filters 4">
                        <div class="navigation_group">
                            <div class="flex items-center justify-between">
                                <p class="relative mt-1 text-base font-medium text-white">Uptime Status</p>
                                <a class="{{(request('uptime') == 'up') ? 'active' : ''}}" href="/props/?uptime=up">Up</a>
                                <a class="{{(request('uptime') == 'down') ? 'active' : ''}}" href="/props/?uptime=down">Down</a>
                            </div>
                        </div>
                        <div class="navigation_group">
                            <p class="text-base font-medium text-white">Accessibility Score</p>
                            <div class="flex justify-between">
                                <a class="{{(request('a11y') == '90-100') ? 'active' : ''}}" href="/props/?a11y=90-100">90-100</a>
                                <a class="{{(request('a11y') == '50-89') ? 'active' : ''}}" href="/props/?a11y=50-89">50-89</a>
                                <a class="{{(request('a11y') == '0-49') ? 'active' : ''}}" href="/props/?a11y=0-49">0-49</a>
                            </div>
                        </div>
                        <div class="navigation_group">
                            <p class="flex-wrap text-base font-medium text-white">Performance Score</p>
                            <div class="flex justify-between">
                                <a class="{{(request('perf') == '90-100') ? 'active' : ''}}" href="/props/?perf=90-100">90-100</a>
                                <a class="{{(request('perf') == '50-89') ? 'active' : ''}}" href="/props/?perf=50-89">50-89</a>
                                <a class="{{(request('perf') == '0-49') ? 'active' : ''}}" href="/props/?perf=0-49">0-49</a>
                            </div>
                        </div>
                        <div class="navigation_group">
                            <p class="text-base font-medium text-white">SEO Score</p>
                            <div class="flex justify-between">
                                <a class="{{(request('seo') == '90-100') ? 'active' : ''}}" href="/props/?seo=90-100">90-100</a>
                                <a class="{{(request('seo') == '50-89') ? 'active' : ''}}" href="/props/?seo=50-89">50-89</a>
                                <a class="{{(request('seo') == '0-49') ? 'active' : ''}}" href="/props/?seo=0-49">0-49</a>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="flex flex-col mt-auto mb-4 text-xs text-blue-300">
                    <div class="flex items-center">
                        @include('svgs/edit')
                        <p class="ml-1 text-blue-200">Administrator View</p>
                    </div>
                    
                    <a class="ml-4" href="/org">Organizations</a>
                    <a class="ml-4" href="/prop">Properties</a>
                    <a class="ml-4" href="/user">Users</a>
                    <a class="ml-4" href="/technology">Technologies</a> 
                </div>
            </nav>
        </div>