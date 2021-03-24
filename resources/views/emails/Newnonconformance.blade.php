@component('mail::message')
# Dear {{$auditee}}

{{$auditor->name}} submitted a new CAR concerning you.

Follow up to respond to it

@component('mail::button', ['url' => route('home')])
View Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
