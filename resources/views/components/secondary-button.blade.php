<button {{ $attributes->merge(['type' => 'button', 'class' => 'mt-4 inline-block bg-btnsecondary text-black font-semibold py-2 px-4
    rounded-2xl shadow-md hover:bg-btnsecondary-hover transition']) }}>
    {{ $slot }}
</button>