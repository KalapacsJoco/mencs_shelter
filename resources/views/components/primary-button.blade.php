<button {{ $attributes->merge(['class' => 'mt-4 inline-block bg-btnprimary text-black font-semibold py-2 px-4 rounded-2xl shadow-md hover:bg-btnprimary-hover transition']) }}>
    {{ $slot }}
</button>
