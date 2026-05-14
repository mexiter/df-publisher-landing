New Marketplace <?php echo e(ucfirst($lead->type)); ?> Lead

Role: <?php echo e($lead->displayRole()); ?>

Email: <?php echo e($lead->email); ?>


<?php if($lead->type === 'contact'): ?>
<?php if($lead->name): ?>
Name: <?php echo e($lead->name); ?>

<?php endif; ?>
<?php if($lead->company): ?>
Company: <?php echo e($lead->company); ?>

<?php endif; ?>
<?php if($lead->website): ?>
Website: <?php echo e($lead->website); ?>

<?php endif; ?>
<?php if($lead->message): ?>
Message:

<?php echo e($lead->message); ?>

<?php endif; ?>
<?php endif; ?>

<?php if($lead->ip_address || $lead->device || $lead->operating_system || $lead->country || $lead->city): ?>
Client context

<?php if($lead->ip_address): ?>
IP: <?php echo e($lead->ip_address); ?>

<?php endif; ?>
<?php if($lead->device): ?>
Device: <?php echo e($lead->device); ?>

<?php endif; ?>
<?php if($lead->operating_system): ?>
OS: <?php echo e($lead->operating_system); ?>

<?php endif; ?>
<?php if($lead->country_code || $lead->country || $lead->region || $lead->city): ?>
Location: <?php echo e(collect([$lead->city, $lead->region, $lead->country, $lead->country_code])->filter()->implode(', ')); ?>

<?php endif; ?>
<?php endif; ?>

Created: <?php echo e($lead->created_at?->toDayDateTimeString()); ?><?php /**PATH /Users/mexpower/Sites/df-publisher-landing/resources/views/emails/marketplace/lead-received-text.blade.php ENDPATH**/ ?>