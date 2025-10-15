<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Staff Invitation</title>
</head>
<body style="font-family: Arial, sans-serif; background-color:#f9f9f9; padding: 30px;">
    <div style="max-width: 600px; background: #fff; margin: auto; border-radius: 8px; overflow: hidden; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div style="background: #2563eb; color: white; padding: 20px; text-align: center;">
            <h2>Welcome to Our Platform</h2>
        </div>
        <div style="padding: 25px; color: #333;">
            <p>Hi there,</p>
            <p>{{ $adminName }} has invited you to join our platform as a staff member.</p>

            <p>Please click the button below to complete your registration.</p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ url('/invitations/accept/' . $token) }}" 
                   style="background: #2563eb; color: white; text-decoration: none; padding: 12px 25px; border-radius: 5px; font-weight: bold;">
                    Accept Invitation
                </a>
            </div>

            <p>If the button above doesn’t work, you can also click this link:</p>
            <p><a href="{{ url('/invitations/accept/' . $token) }}">{{ url('/invitations/accept/' . $token) }}</a></p>

            <p style="margin-top: 30px;">Best regards,<br>The Admin Team</p>
        </div>
        <div style="background: #f1f1f1; padding: 15px; text-align: center; font-size: 13px; color: #555;">
            © {{ date('Y') }} Your Company Name. All rights reserved.
        </div>
    </div>
</body>
</html>
