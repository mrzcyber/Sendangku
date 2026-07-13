@if (session('success'))
<div id="flash-message" class=" absolute inset-0 flex justify-center items-center  bg-black/20 z-50">
    <div class="px-8 py-6 gap-4 bg-white rounded-2xl shadow-gray-800 shadow-sm flex flex-col justify-center items-center">
            <div class="text-2xl font-semibold text-gray-700">{{ session('success') }}</div>
          <button onclick="document.getElementById('flash-message').remove()" class="flex items-center max-w-40 justify-center gap-2 px-6 py-2 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 cursor-pointer w-full md:w-auto shadow-sm">
            <i data-lucide="x" class="size-5"></i>
            <span>Tutup</span>
          </button>
    </div>
</div>
@endif