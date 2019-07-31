 <nav class="navigation px--1 px--0h@d pt--2h@d filter-menu ta--l@d"
            id="filter_menu"
            role="navigation"
            data-navigation-handle="#filter_menu_handle"
            data-navigation-content="#app_nav_buttons"
        >
            <div class="filter-menu__text mb--1">{{ strings.text }}</div>
            <div class="filter-menu__wrapper" tabindex="0">
                <label for="year-filter" class="filter-menu__label">{{ strings.year }}</label>
                <select-component 
                    @input="e => updateFilter('year', e)" 
                    id="year-filter"
                    :class="`${$store.state.activeYear != ALL_YEARS ? 'v-select--active' : ''}`"
                    :value="$store.state.activeYear"
                    :clearable="false" 
                    :options="validYears"
                />
            </div>
            <div class="filter-menu__wrapper" tabindex="0">
                <label for="college-filter" class="filter-menu__label">{{ strings.college }}</label>
                <select-component
                    @input="e => updateFilter('college', e)" 
                    id="college-filter" 
                    :class="`${$store.state.activeCollege != ALL_COLLEGES ? 'v-select--active' : ''}`"
                    :value="$store.state.activeCollege" 
                    :options="validColleges"
                    :clearable="false" 
                />
            </div>
            <div class="filter-menu__wrapper mb--2" tabindex="0">
                <label for="major-filter" class="filter-menu__label">{{ strings.major }}</label>
                <select-component @input="e => updateFilter('majors', e)"
                    :class="$store.state.activeMajors.length > 0 ? 'multiselect multiselect--active' : 'multiselect'"
                    id="major-filter"
                    :value="$store.state.activeMajors"
                    :options="validMajors"
                    :multiple="true"
                    placeholder="All Disciplines" />
            </div>
            <a class="btn my--1 tt--caps filter-menu__apply bg--red br--pill hidden--up@d" href="#" v-scroll-to="'#app_content'">{{ strings.apply }}</a>
            <a v-if="$store.getters.areFiltersApplied()" class="btn my--1 filter-menu__reset" tabIndex="0" v-on:keyup.enter="resetFilters" v-on:keyup.space="resetFilters" v-on:click="resetFilters" v-scroll-to="'#app_content'">{{ strings.reset }}</a>
            <div class="d--flex flex--middle bc--gray bwa--0 bwt--1 pt--1 mt--1" >
                <p class="ma--1 ml--0 fs--xs pt--0 fw--700">{{ strings.contrast }}</p>
                <toggle-button :value="$store.state.contrast" @change="$store.commit('setContrast', $event.value)" :color="{checked: '#d41b2c', unchecked: '#d0d0d0'}" :width=95 :height=25 :sync="true" :labels="{checked: strings.contrastOn, unchecked: strings.contrastOff}"/>
            </div>
        </nav>