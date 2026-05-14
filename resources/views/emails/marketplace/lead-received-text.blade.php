New Marketplace {{ ucfirst($lead->type) }} Lead

Role: {{ $lead->displayRole() }}
Email: {{ $lead->email }}

@if($lead->type === 'contact')
@if($lead->name)
Name: {{ $lead->name }}
@endif
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
@endif

@if($lead->ip_address || $lead->device || $lead->operating_system || $lead->country || $lead->city)
Client context

@if($lead->ip_address)
IP: {{ $lead->ip_address }}
@endif
@if($lead->device)
Device: {{ $lead->device }}
@endif
@if($lead->operating_system)
OS: {{ $lead->operating_system }}
@endif
@if($lead->country_code || $lead->country || $lead->region || $lead->city)
Location: {{ collect([$lead->city, $lead->region, $lead->country, $lead->country_code])->filter()->implode(', ') }}
@endif
@endif

Created: {{ $lead->created_at?->toDayDateTimeString() }}