<button {{ $attributes->merge(['type' => 'submit', 'class' =>
    'px-4 py-2 text-sm font-medium leading-5 text-white transition-colors 
    duration-150 bg-primary border
    border-transparent rounded-lg active:bg-primary hover:bg-primary-dark
     focus:outline-none
    focus:shadow-outline-primary']) }}>
    {{ $slot }}
</button>