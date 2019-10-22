@component('layouts/master')

    <div>
        Current locale: {{ app()->getLocale() }}
    </div>

    <div>
        Current display timezone: {{ config('app.display_timezone') }}
    </div>

@endcomponent
