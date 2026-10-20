@php
    $nonce = \Illuminate\Support\Facades\Vite::cspNonce();
    $nonceAttribute = $nonce ? ' nonce="'.e($nonce).'"' : '';
@endphp

<style{!! $nonceAttribute !!}>{!! $css !!}</style>
<script{!! $nonceAttribute !!} data-animate="{{ $animate }}" data-delay="{{ $delay }}">{!! $js !!}</script>
