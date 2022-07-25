<!DOCTYPE>
<html>
	<head>
		<meta charset="utf-8">
		<title>Demo Email</title>
	</head>
	<body>
		<div style="width: 80%; height: 150%; background-color: #102530; padding: 10%;">
			<div style="background-color: white; height: auto; width: 50%; margin: auto;">
				<div style="padding: 30px 30px; font-size: 20px; font-weight: 400; font-family: system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans; border: 4px solid white; color: white; background-image: linear-gradient(-360deg, #1f304e, #0dcaf0);"> Hello {{$name}}</div>
				<div style="font-size: 14px; font-family: system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans; padding: 10px 10px 30px 10px; text-align: justify;">
					<p>This email recieved from <b>Mohitan Mishra & Mishra Technology Private Limited</b>. Email do not harmfull for your pc. Its contain only your Username and Password. If you registered on Mishra Technology Private Limited so Please Carry your Username and Password otherwise Igoner this email.</p>

					<p style="margin-left: 20%; font-weight: 700; color: #012970;">Username : {{$username}}</p>
					<p style="margin-left: 20%; font-weight: 700; color: #012970;">Password : {{$password}}</p>
					<p style="margin-left: 20%; font-weight: 700; color: #012970;">Roll : {{$roll}}</p>

					<p>Mishra Technology Private Limited will always in your service. <a href="http://127.0.0.1:8000/">Mohitan Mishra Pvt. Lmt.</a></p>
				</div>
			</div>
		</div>
	</body>
</html>