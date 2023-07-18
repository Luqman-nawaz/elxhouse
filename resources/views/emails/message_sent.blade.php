


@component('mail::message')
# Dear {{$data['name'] }}
 
You Have Received New Message From {{ $data['from_name'] }}
 
{{-- @component('mail::button', ['url' => $url])
View Order
@endcomponent --}}
 
Thanks,<br>
{{ config('app.name') }}
@endcomponent
