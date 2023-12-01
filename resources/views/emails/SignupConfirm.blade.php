<x-mail::message>
# Welcome {{ $user->full_name }}, please verify your account.

You are receiving this email because we received a signup request for your account.
If this was not you please ignore this email. Otherwise please click the button below to verify your account.


<x-mail::button :url="url('verify', ['email' => urlencode($user->email), 'code' => $user->verification_code])">
Verify Account
</x-mail::button>


Cheers,<br>
{{ config('app.name') }} Team
</x-mail::message>
