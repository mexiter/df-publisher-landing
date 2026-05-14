<?php
    $logoPath = public_path('images/dataflair-logo.svg');
    $hasLogo = is_file($logoPath);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New <?php echo e(ucfirst($lead->type)); ?> Lead</title>
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
                            <?php if($hasLogo): ?>
                                <img src="<?php echo e($message->embed($logoPath)); ?>" alt="DataFlair" width="140" style="display:block;max-width:140px;height:auto;border:0;outline:none;text-decoration:none;" />
                            <?php else: ?>
                                <span style="font-size:18px;font-weight:800;letter-spacing:-0.02em;color:#006386;">DataFlair</span>
                            <?php endif; ?>
                            <p style="margin:10px 0 0 0;font-size:11px;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:#6f787f;">Publisher Marketplace</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:26px 26px 8px 26px;background-color:#ffffff;">
                            <h1 style="margin:0 0 22px 0;font-size:22px;font-weight:800;letter-spacing:-0.03em;line-height:1.15;color:#1c1c19;">New <?php echo e(ucfirst($lead->type)); ?> Lead</h1>

                            <p style="margin:0 0 12px 0;font-size:12px;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:#6f787f;">Details</p>

                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate;border-spacing:0;background-color:#f6f3ee;border:1px solid #bec8cf;border-radius:8px;margin-bottom:22px;">
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                        <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Role</span>
                                        <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->displayRole()); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding:14px 16px;border-bottom:<?php echo e($lead->type === 'contact' ? '1px solid #e5ded4' : 'none'); ?>;">
                                        <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Email</span>
                                        <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->email); ?></span>
                                    </td>
                                </tr>
                                <?php if($lead->type === 'contact'): ?>
                                    <?php if($lead->name): ?>
                                        <tr>
                                            <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                                <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Name</span>
                                                <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->name); ?></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($lead->company): ?>
                                        <tr>
                                            <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                                <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Company</span>
                                                <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->company); ?></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($lead->website): ?>
                                        <tr>
                                            <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                                <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Website</span>
                                                <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->website); ?></span>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php if($lead->message): ?>
                                        <tr>
                                            <td style="padding:14px 16px;">
                                                <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Message</span>
                                                <p style="margin:8px 0 0 0;font-size:14px;line-height:1.55;color:#3f484e;white-space:pre-wrap;"><?php echo e($lead->message); ?></p>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </table>

                            <?php if($lead->ip_address || $lead->device || $lead->operating_system || $lead->country || $lead->city): ?>
                                <p style="margin:0 0 12px 0;font-size:12px;font-weight:800;letter-spacing:0.14em;text-transform:uppercase;color:#6f787f;">Client Context</p>

                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate;border-spacing:0;background-color:#f6f3ee;border:1px solid #bec8cf;border-radius:8px;">
                                    <?php if($lead->ip_address): ?>
                                    <tr>
                                        <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">IP</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->ip_address); ?></span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($lead->device): ?>
                                    <tr>
                                        <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Device</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->device); ?></span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($lead->operating_system): ?>
                                    <tr>
                                        <td style="padding:14px 16px;border-bottom:1px solid #e5ded4;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">OS</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e($lead->operating_system); ?></span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                    <?php if($lead->country_code || $lead->country || $lead->region || $lead->city): ?>
                                    <tr>
                                        <td style="padding:14px 16px;">
                                            <span style="display:block;font-size:11px;font-weight:800;letter-spacing:0.12em;text-transform:uppercase;color:#6f787f;">Location</span>
                                            <span style="display:block;margin-top:4px;font-size:15px;font-weight:600;color:#1c1c19;"><?php echo e(collect([$lead->city, $lead->region, $lead->country, $lead->country_code])->filter()->implode(', ')); ?></span>
                                        </td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 26px;background-color:#fcf9f3;border-top:1px solid #bec8cf;">
                            <p style="margin:0;font-size:11px;line-height:1.5;color:#6f787f;">Created: <?php echo e($lead->created_at?->toDayDateTimeString()); ?></p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html><?php /**PATH /Users/mexpower/Sites/df-publisher-landing/resources/views/emails/marketplace/lead-received.blade.php ENDPATH**/ ?>