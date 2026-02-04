@component('mail::message')
{{-- Header --}}
# 🚀 Nuevo lead desde Betancourt Dev

@component('mail::panel')
**Nombre:** {{ $data['name'] ?? '-' }}  
**Email:** {{ $data['email'] ?? '-' }}  
**Teléfono:** {{ $data['phone'] ?? '-' }}
@if(!empty($data['lead_id']))
**Lead ID:** #{{ $data['lead_id'] }}
@endif
@endcomponent

## Mensaje
@component('mail::panel')
{!! nl2br(e($data['message'] ?? '')) !!}
@endcomponent

@component('mail::button', ['url' => 'mailto:' . ($data['email'] ?? ''), 'color' => 'success'])
Responder por email
@endcomponent

@if(!empty($data['email']))
_Tip:_ podés responder directo a este correo (usa **Reply-To**).
@endif

Gracias,  
**Betancourt Dev**
@endcomponent
