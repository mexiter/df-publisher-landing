@if($lead->type === 'waitlist')
Thank you for joining our waitlist.

You are on our waitlist. We will reach out to you soon.

@if($launchConfigured ?? false)
Launch window:
{{ $launchPhrase }}
Target: {{ $launchAtFormatted }}
@else
We will share a concrete launch window as we open the list.
@endif
@else
Thank you for contacting us.

We received your message and will reach out to you very soon.
@endif

Here is what we received:

Role: {{ $lead->displayRole() }}
Email: {{ $lead->email }}
@if($lead->company)
Company: {{ $lead->company }}
@endif
@if($lead->website)
Website: {{ $lead->website }}
@endif
@if($lead->message)
Message:

{{ $lead->message }}
@endif

— DataFlair Marketplace
