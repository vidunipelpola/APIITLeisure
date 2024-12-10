<a {{ $attributes->merge(['class' => 'block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 dark:text-gray-300 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out', 'style' => 'transition: background-color 0.3s ease;']) }} 
   onmouseover="this.style.backgroundColor='#8B0000';" 
   onmouseout="this.style.backgroundColor='';">
    {{ $slot }}
</a>
