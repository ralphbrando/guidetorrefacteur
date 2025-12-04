@php
    $groupIcons = [
        'Torréfacteurs' => '☕',
        'Offres & équipements' => '🧺',
        'Territoires' => '🗺️',
        'Administration' => '⚙️',
    ];
@endphp

@if (count(\Laravel\Nova\Nova::resourcesForNavigation(request())))
    <div class="nova-nav-title">
        <h3 class="flex items-center font-normal text-white mb-4 text-base no-underline">
            <svg class="sidebar-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path fill="var(--sidebar-icon)" d="M3 1h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2V3c0-1.1045695.8954305-2 2-2zm0 2v4h4V3h-4zM3 11h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2H3c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4H3zm10-2h4c1.1045695 0 2 .8954305 2 2v4c0 1.1045695-.8954305 2-2 2h-4c-1.1045695 0-2-.8954305-2-2v-4c0-1.1045695.8954305-2 2-2zm0 2v4h4v-4h-4z" />
            </svg>
            <span class="sidebar-label ml-2">{{ __('Resources') }}</span>
        </h3>
    </div>

    <div class="nova-nav-groups">
        @foreach($navigation as $group => $resources)
            @php
                $label = (count($groups) > 1) ? $group : __('Resources');
            @endphp

            <details class="nova-nav-section" @if($loop->first) open @endif>
                <summary class="nova-nav-summary">
                    <span class="nav-section-icon" aria-hidden="true">{{ $groupIcons[$group] ?? '☕' }}</span>
                    <span class="nav-section-label">{{ $label }}</span>
                    <span class="nav-section-caret" aria-hidden="true"></span>
                </summary>
                <ul class="nova-submenu list-reset">
                    @foreach($resources as $resource)
                        <li class="nova-submenu-item">
                            <router-link :to="{
                                name: 'index',
                                params: {
                                    resourceName: '{{ $resource::uriKey() }}'
                                }
                            }" class="nova-submenu-link" dusk="{{ $resource::uriKey() }}-resource-link">
                                <span class="nova-submenu-dot" aria-hidden="true"></span>
                                <span>{{ $resource::label() }}</span>
                            </router-link>
                        </li>
                    @endforeach
                </ul>
            </details>
        @endforeach
    </div>
@endif

