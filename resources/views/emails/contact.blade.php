<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; }
        .container { padding: 20px; }
        .header { background: #2563eb; color: white; padding: 15px; border-radius: 5px; }
        .content { margin-top: 20px; font-size: 16px; line-height: 1.6; }
        .footer { margin-top: 30px; border-top: 1px solid #ddd; padding-top: 10px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Baru dari Website Desa</h2>
        </div>
        <div class="content">
            <p><strong>Nama:</strong> {{ $contactData['name'] }}</p>
            <p><strong>Email:</strong> {{ $contactData['email'] }}</p>
            <hr>
            <p><strong>Pesan:</strong></p>
            <p>{{ $contactData['message'] }}</p>
        </div>
        <div class="footer">
            Dikirim melalui Formulir Kontak Website Desa Tegalsambi.
        </div>
    </div>
</body>
</html>
