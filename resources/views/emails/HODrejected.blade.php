@component('mail::message')
# Dear {{$auditee}}

{{$sender->name}} reviewed and rejected your CAR.

Follow up for Correction

@component('mail::button', ['url' => route('home')])
View Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
