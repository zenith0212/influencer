@props(['errors'])

@if ($errors->any())
    <div {{ $attributes->merge(['class' => 'alert alert-danger alert-dismissible fade show', 'role' => 'alert']) }}>
        <span class="fs-4">{{ __('Whoops! Something went wrong.') }}</span>

        <ul class="mt-3 list-group-numbered">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
