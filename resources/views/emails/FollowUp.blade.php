@component('mail::message')
# Dear {{$follower->name}}

{{$sender->name}} has assigned you a new task to follow up.

logon to the system for more information

@component('mail::button', ['url' => route('home')])
 View Task
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
