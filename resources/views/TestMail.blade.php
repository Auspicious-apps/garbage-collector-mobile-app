<!DOCTYPE html>
<html>
<head>
<title>Abc.com</title>
</head>
<body>
<div style="background: #edf2f7; padding: 20px; display: flex; align-items: center;" class="thanks-page">
	<div style=" background-color: #ffffff; border-color: #e8e5ef;  border-radius: 2px;border-width: 1px;box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 20px; width: 100%;  max-width: 400px; text-align: center;" class="thanks-content">
		<!-- <img src="{{ asset('/images/mailicon.png') }}" width="30%" height="30%"> -->
		<img src="{{ asset('/images/Logo_redu.png') }}" width="25%" height="25%" style="object-fit: cover;">
<h1 style="font-size: 24px; line-height: 28px; font-weight: 400;">{{ $details['body'] }}</h1>
<h4 style="font-size: 30px;  line-height: 36px; margin:20px 0 ;  font-weight: 700;">{{ $details['otp'] }}</h4>
<p style="font-size: 14px; line-height: 20px;">Here is your verification code.</p>
<p style="font-size: 11px; line-height: 20px;">Thanks & Regards</p>
<p style="font-size: 11px; line-height: 20px;">Team Purocircular</p>
</div>
</div>
</body>
</html>