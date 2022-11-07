<div class="page-manager">
    dashboard
    {!! auth()->user() !!}
    <div>

        {{ app()->getLocale() }}
    </div>
<div>{{session('language')}}</div>
<div>{{config('application.language')}}</div>

</div>
