@props(['errors' => $errors, 'for'])

@if ($errors->any() && $errors->has($for))
<p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ is_array($errors->get($for)) ? $errors->get($for)[0] : $errors->get($for) }}</p>
@else
@error($for)
<p {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>{{ is_array($message) ? $message[0] : $message }}</p>
@enderror
@endif
