@component('mail::message')
# Dear {{$auditee}}

{{$sender->name}} reviewed and approved your Non-Conformance.

Follow up for Implementation

@component('mail::button', ['url' => route('home')])
View Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
