@props(['disabled' => false])

@if ($attributes->get('type') === 'password')
    @php
        // Move top margins to the wrapper so the toggle button stays vertically centered on the input.
        $classes = array_filter(explode(' ', (string) $attributes->get('class')));
        $wrapperClasses = implode(' ', array_filter($classes, fn ($c) => str_starts_with($c, 'mt-')));
        $inputClasses = implode(' ', array_filter($classes, fn ($c) => ! str_starts_with($c, 'mt-')));
    @endphp
    <div x-data="{ show: false }" class="relative {{ $wrapperClasses }}">
        <input @disabled($disabled) x-bind:type="show ? 'text' : 'password'" {{ $attributes->except('class')->merge(['class' => trim('form-control pr-11 '.$inputClasses)]) }}>
        <x-password-toggle/>
    </div>
@else
    <input @disabled($disabled) {{ $attributes->merge(['class' => 'form-control']) }}>
@endif
