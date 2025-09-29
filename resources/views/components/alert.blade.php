@props(['type' => 'success','title' => 'Thông báo'])
@php
  $bg = $type === 'success' ? '#ECFDF5' : '#FEF3C7';
  $color = $type === 'success' ? '#065F46' : '#92400E';
@endphp
<div style="padding:10px;border-radius:8px;margin-bottom:10px;background:{{ $bg }};color:{{ $color }};">
  <strong>{{ $title }}:</strong> {{ $slot }}
</div>
