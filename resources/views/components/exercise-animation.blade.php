{{-- Exercise Animation Component --}}
@props([
    'exercise' => 'pushup',
    'size' => '200',
    'speed' => '1',
    'autoplay' => true,
    'loop' => true
])

<div class="exercise-animation-wrapper">
    <lottie-player
        src="{{ asset('lottie/exercises/' . $exercise . '.json') }}"
        background="transparent"
        speed="{{ $speed }}"
        style="width: {{ $size }}px; height: {{ $size }}px;"
        @if($loop) loop @endif
        @if($autoplay) autoplay @endif
        class="exercise-lottie">
    </lottie-player>
</div>

<style>
.exercise-animation-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
}

.exercise-lottie {
    filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
}
</style>
