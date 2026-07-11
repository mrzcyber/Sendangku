@extends('layouts.dashboard')

@section('title', 'Create Service - Sendangku')
@section('meta_description', 'Tambah layanan baru Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-muted min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Manajemen Service</h2>
      </div>

      <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
        <i data-lucide="bell" class="size-6 text-secondary"></i>
        <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Tambah Service</h1>
          <p class="text-secondary text-sm">Buat layanan baru tanpa konfigurasi package terlebih dahulu.</p>
        </div>
        <a href="{{ route('admin.service.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white">
          <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
          <span>Kembali</span>
        </a>
      </div>

      <form action="{{ route('admin.service.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_420px] gap-6">
        @csrf

        <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
          <div class="p-6 border-b border-border">
            <h3 class="font-bold text-lg text-foreground">Informasi Service</h3>
          </div>

          <div class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="flex flex-col gap-2">
                <label for="name" class="text-sm font-semibold text-foreground">Nama Service</label>
                <input
                  id="name"
                  name="name"
                  type="text"
                  value="{{ old('name') }}"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  autocomplete="off"
                  required
                >
                @error('name')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>

              <div class="flex flex-col gap-2">
                <label for="price" class="text-sm font-semibold text-foreground">Harga</label>
                <input
                  id="price"
                  name="price"
                  type="number"
                  min="0"
                  value="{{ old('price') }}"
                  placeholder="Contoh: 25000"
                  class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                  required
                >
                @error('price')
                  <p class="text-sm font-medium text-error">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="flex flex-col gap-2">
              <label for="duration" class="text-sm font-semibold text-foreground">Durasi</label>
              <input
                id="duration"
                name="duration"
                type="text"
                value="{{ old('duration') }}"
                placeholder="Contoh: 30 menit"
                class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                required
              >
              @error('duration')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex flex-col gap-2">
              <label for="description" class="text-sm font-semibold text-foreground">Deskripsi</label>
              <textarea
                id="description"
                name="description"
                rows="5"
                class="w-full px-4 py-3 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium leading-6 text-foreground transition-all resize-y min-h-[100px]"
                required
              >{{ old('description') }}</textarea>
              @error('description')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex flex-col gap-4">
              <div>
                <h3 class="font-bold text-lg text-foreground">Galery</h3>
                <p class="text-sm text-secondary mt-1">Pilih maksimal 5 gambar untuk preview galery.</p>
              </div>

              <div id="galleryPreviewGrid" class="grid grid-cols-2 md:grid-cols-5 gap-3">
                @for ($i = 1; $i <= 5; $i++)
                  <div class="gallery-slot aspect-[4/3] overflow-hidden rounded-2xl bg-muted ring-1 ring-border flex items-center justify-center text-secondary">
                    <i data-lucide="image" class="size-6"></i>
                  </div>
                @endfor
              </div>

              <label for="gallery" class="flex cursor-pointer items-center justify-center gap-2 rounded-2xl border border-dashed border-border px-4 py-4 text-sm font-bold text-foreground hover:border-primary hover:text-primary transition-all duration-300">
                <i data-lucide="upload" class="size-5"></i>
                <span>Pilih Galery</span>
              </label>
              <input id="gallery" name="image[]" type="file" accept="image/*" class="sr-only" multiple>

              <p id="galleryFileName" class="text-sm font-medium text-secondary truncate">Belum ada file dipilih.</p>
              @error('image')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
              @error('image.*')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <aside class="flex flex-col gap-6">
          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border">
              <h3 class="font-bold text-lg text-foreground">Thumbnail</h3>
            </div>

            <div class="p-6 space-y-4">
              <div class="aspect-[16/9] w-full overflow-hidden rounded-2xl bg-muted ring-1 ring-border">
                <img id="thumbnailPreview" src="" alt="Thumbnail preview" class="hidden h-full w-full object-cover object-center">
                <div id="thumbnailPlaceholder" class="h-full w-full flex flex-col items-center justify-center gap-3 text-secondary">
                  <div class="size-12 rounded-2xl bg-white ring-1 ring-border flex items-center justify-center">
                    <i data-lucide="image" class="size-6"></i>
                  </div>
                  <p class="text-sm font-semibold">Preview landscape</p>
                </div>
              </div>

              <label for="thumbnail" class="flex cursor-pointer items-center justify-center gap-2 rounded-2xl border border-dashed border-border px-4 py-4 text-sm font-bold text-foreground hover:border-primary hover:text-primary transition-all duration-300">
                <i data-lucide="upload" class="size-5"></i>
                <span>Pilih Thumbnail</span>
              </label>
              <input id="thumbnail" name="thumbnail" type="file" accept="image/*" class="sr-only" required>

              <p id="thumbnailFileName" class="text-sm font-medium text-secondary truncate">Belum ada file dipilih.</p>
              @error('thumbnail')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>


          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm p-6 gap-3">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
              <i data-lucide="save" class="size-5"></i>
              <span>Simpan Service</span>
            </button>
          </div>
        </aside>
      </form>
    </div>
  </main>
</div>

<script>
  (() => {
    const input = document.getElementById('thumbnail');
    const preview = document.getElementById('thumbnailPreview');
    const placeholder = document.getElementById('thumbnailPlaceholder');
    const fileName = document.getElementById('thumbnailFileName');
    const galleryInput = document.getElementById('gallery');
    const galleryGrid = document.getElementById('galleryPreviewGrid');
    const galleryFileName = document.getElementById('galleryFileName');
    let objectUrl = null;
    let galleryObjectUrls = [];

    const resetGalleryPreview = () => {
      galleryObjectUrls.forEach((url) => URL.revokeObjectURL(url));
      galleryObjectUrls = [];

      if (!galleryGrid) {
        return;
      }

      galleryGrid.innerHTML = Array.from({ length: 5 }, () => `
        <div class="gallery-slot aspect-[4/3] overflow-hidden rounded-2xl bg-muted ring-1 ring-border flex items-center justify-center text-secondary">
          <i data-lucide="image" class="size-6"></i>
        </div>
      `).join('');

      if (window.lucide) {
        window.lucide.createIcons();
      }
    };

    input?.addEventListener('change', () => {
      const file = input.files?.[0];

      if (objectUrl) {
        URL.revokeObjectURL(objectUrl);
        objectUrl = null;
      }

      if (!file) {
        preview.classList.add('hidden');
        preview.removeAttribute('src');
        placeholder.classList.remove('hidden');
        fileName.textContent = 'Belum ada file dipilih.';
        return;
      }

      objectUrl = URL.createObjectURL(file);
      preview.src = objectUrl;
      preview.classList.remove('hidden');
      placeholder.classList.add('hidden');
      fileName.textContent = file.name;
    });

    galleryInput?.addEventListener('change', () => {
      resetGalleryPreview();

      const files = Array.from(galleryInput.files ?? []);

      if (!files.length) {
        galleryFileName.textContent = 'Belum ada file dipilih.';
        return;
      }

      const previewFiles = files.slice(0, 5);
      galleryFileName.textContent = files.length > 5
        ? `${files.length} file dipilih, 5 preview ditampilkan.`
        : `${files.length} file dipilih.`;

      galleryGrid.innerHTML = previewFiles.map((file) => {
        const url = URL.createObjectURL(file);
        galleryObjectUrls.push(url);

        return `
          <div class="aspect-[4/3] overflow-hidden rounded-2xl bg-muted ring-1 ring-border">
            <img src="${url}" alt="Gallery preview" class="h-full w-full object-cover object-center">
          </div>
        `;
      }).join('');

      for (let i = previewFiles.length; i < 5; i++) {
        galleryGrid.insertAdjacentHTML('beforeend', `
          <div class="gallery-slot aspect-[4/3] overflow-hidden rounded-2xl bg-muted ring-1 ring-border flex items-center justify-center text-secondary">
            <i data-lucide="image" class="size-6"></i>
          </div>
        `);
      }

      if (window.lucide) {
        window.lucide.createIcons();
      }
    });

    window.addEventListener('beforeunload', () => {
      if (objectUrl) {
        URL.revokeObjectURL(objectUrl);
      }

      galleryObjectUrls.forEach((url) => URL.revokeObjectURL(url));
    });
  })();
</script>
@endsection
