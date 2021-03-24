@component('mail::message')
# Dear {{$HOD}}

{{$auditee}} responded to a CAR and request for your review.

Follow up to respond to it

@component('mail::button', ['url' => route('home')])
 View Report
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
