<!DOCTYPE html>
<html>
<head>
    <title>Reply from StayEase Hotel</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-top: 5px solid #009879;">
        <h2 style="color: #009879;">StayEase Hotel</h2>
        <p>Dear {{ $msg->name }},</p>
        
        <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #009879; margin: 20px 0;">
            {!! nl2br(e($replyContent)) !!}
        </div>

        <p>Thank you for contacting us. We hope this addresses your inquiry.</p>
        
        <hr style="border: 0; border-top: 1px solid #eee;">
        
        <div style="font-size: 0.9em; color: #777;">
            <p><strong>Original Message:</strong></p>
            <p><em>Subject:</em> {{ $msg->subject }}</p>
            <p><em>Message:</em> {{ $msg->message }}</p>
        </div>
    </div>
</body>
</html>
