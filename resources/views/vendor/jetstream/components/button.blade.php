<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-emerald-700 active:bg-emerald-800 focus:outline-none focus:border-emerald-800 focus:ring focus:ring-emerald-100 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
