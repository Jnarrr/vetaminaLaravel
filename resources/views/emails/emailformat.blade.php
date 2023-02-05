@component('mail::message')
# Welcome to Vetamina!

Dear {{ $email }},

We look forward to have a deeper connection with you, 
Kindly enter the OTP code below to verify your account.

# Code: {{ $otp }}

@component('mail::button', ['url' => 'https://www.facebook.com/jnar.jnar.jnar'])
Developer
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
