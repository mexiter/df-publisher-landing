<?php if($lead->type === 'waitlist'): ?>
Thank you for joining our waitlist.

You are on our waitlist. We will reach out to you soon.

<?php if($launchConfigured ?? false): ?>
Launch window:
<?php echo e($launchPhrase); ?>

Target: <?php echo e($launchAtFormatted); ?>

<?php else: ?>
We will share a concrete launch window as we open the list.
<?php endif; ?>
<?php else: ?>
Thank you for contacting us.

We received your message and will reach out to you very soon.
<?php endif; ?>

Here is what we received:

Role: <?php echo e($lead->displayRole()); ?>

Email: <?php echo e($lead->email); ?>

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

— DataFlair Marketplace
<?php /**PATH /Users/mexpower/Sites/df-publisher-landing/resources/views/emails/marketplace/lead-confirmation-text.blade.php ENDPATH**/ ?>