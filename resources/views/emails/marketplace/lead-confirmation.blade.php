@php
    $logoPath = public_path('images/dataflair-logo.svg');
    $hasLogo = is_file($logoPath);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $lead->type === 'waitlist' ? 'Waitlist confirmation' : 'Contact confirmation' }}</title>
</head>
<body style="margin:0;padding:0;background-color:#ece8e0;font-family:Inter,ui-sans-serif,system-ui,Segoe UI,Helvetica,Arial,sans-serif;-webkit-font-smoothing:antialiased;">
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color:#ece8e0;padding:28px 14px;">
        <tr>
            <td align="center">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:560px;border-collapse:separate;border-spacing:0;background-color:#ffffff;border:1px solid #bec8cf;border-radius:10px;overflow:hidden;">
                    <tr>
                        <td style="height:4px;background-color:#006386;line-height:4px;font-size:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:22px 26px 18px 26px;background-color:#fcf9f3;border-bottom:1px solid #bec8cf;">
                            @if($hasLogo)
                                <img src="{{ $message->embed($logoPath) }}" alt="DataFlair" width="140" style="display:block;max-width:140px;height:auto;border:0;outline:none;text-decoration:none;" />
                            @else
                                <span style="font-size:18px;font-weight:800;letter-spacing:-0.02em;color:#006386;">DataFlair</span>
                            @endif
                            <p style="margin:10px 0 0 0;font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#6f787f;">Publisher Marketplace</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:26px 26px 8px 26px;background-color:#ffffff;">
                            @if($lead->type === 'waitlist')
                                <h1 style="margin:0 0 12px 0;font-size:22px;font-weight:800;letter-spacing:-0.03em;line-height:1.15;color:#1c1c19;">Thank you for joining our waitlist</h1>
                                <p style="margin:0 0 22px 0;font-size:15px;line-height:1.55;color:#3f484e;">You are on our waitlist. We will reach out to you soon.</p>

                                @if($launchConfigured ?? false)
                                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate;border-spacing:0;margin:0 0 18px 0;background-color:#ffffff;border:1px solid #006386;border-radius:8px;">
                                        <tr>
                                            <td style="padding:14px 16px;">
                                                <p style="margin:0 0 6px 0;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#006386;">Launch window</p>
                                                <p style="margin:0 0 8px 0;font-size:17px;font-weight:800;letter-spacing:-0.02em;line-height:1.35;color:#1c1c19;">{{ $launchPhrase }}</p>
                                                <p style="margin:0;font-size:13px;line-height:1.5;color:#3f484e;"><strong style="color:#1c1c19;">Target:</strong> {{ $launchAtFormatted }}</p>
                                            </td>
                                        </tr>
                                    </table>
                                @else
                                    <p style="margin:0 0 18px 0;font-size:14px;line-height:1.55;color:#3f484e;">We will share a concrete launch window as we open the list.</p>
                                @endif
                            @else
                                <h1 style="margin:0 0 12px 0;font-size:22px;font-weight:800;letter-spacing:-0.03em;line-height:1.15;color:#1c1c19;">Thank you for contacting us</h1>
                                <p style="margin:0 0 22px 0;font-size:15px;line-height:1.55;color:#3f484e;">We received your message and will reach out to you very soon.</p>
                            @endif

                            <p style="margin:0 0 12px 0;font-size:12px;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:#6f787f;">What we received</p>

                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate;border-spacing:0;background-color:#f6f3ee;border:1px solid #bec8cf;border-radius:8px;">
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                        <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Role</span>
                                        <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;">{{ $lead->displayRole() }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                        <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Email</span>
                                        <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;">{{ $lead->email }}</span>
                                    </td>
                                </tr>
                                @if($lead->company)
                                    <tr>
                                        <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Company</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;">{{ $lead->company }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if($lead->website)
                                    <tr>
                                        <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Website</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;">{{ $lead->website }}</span>
                                        </td>
                                    </tr>
                                @endif
                                @if($lead->message)
                                    <tr>
                                        <td style="padding:14px 16px;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Message</span>
                                            <p style="margin:8px 0 0 0;font-size:14px;line-height:1.55;color:#3f484e;white-space:pre-wrap;">{{ $lead->message }}</p>
                                        </td>
                                    </tr>
                                @endif
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 26px 22px 26px;background-color:#ffffff;">
                            <p style="margin:0;font-size:14px;line-height:1.5;color:#3f484e;">Thanks,<br /><strong style="color:#006386;">DataFlair Marketplace</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 26px;background-color:#fcf9f3;border-top:1px solid #bec8cf;">
                            <p style="margin:0;font-size:11px;line-height:1.5;color:#6f787f;">This message was sent because you submitted a form on DataFlair Publisher Marketplace. If you did not expect this email, you can ignore it.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
