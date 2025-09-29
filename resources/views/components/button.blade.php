@props(['variant' => 'primary', 'size' => 'md'])
@php
  $bg = $variant === 'danger' ? '#EF4444' : '#3B82F6';
  $hover = $variant === 'danger' ? '#DC2626' : '#2563EB';
  $pad = $size === 'sm' ? '6px 10px' : '8px 14px';
  $style = "background:$bg;color:#fff;border:none;border-radius:8px;padding:$pad;cursor:pointer";
@endphp
<button {{ $attributes->merge(['style' => $style, 'onmouseover' => "this.style.background='$hover'", 'onmouseout' => "this.style.background='$bg'"]) }}>
  {{ $slot }}
</button>
