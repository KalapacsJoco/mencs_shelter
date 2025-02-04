<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-btnsecondary border
    border-black rounded-2xl text-xs tracking-widest hover:bg-btnsecondary-hover text-black font-semibold py-2 px-4
    rounded-2xl shadow-md hover:bg-btnprimary-hover transition']) }}>
    {{ $slot }}
</button>