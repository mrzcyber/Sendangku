@extends('layouts.dashboard')

@section('title', 'Edit Table - Sendangku')
@section('meta_description', 'Edit meja restaurant Sendangku.')
@section('body_class', 'font-sans bg-muted min-h-screen overflow-x-hidden text-foreground')

@section('content')
<div class="flex h-screen max-h-screen flex-1 overflow-hidden">
  <main class="flex-1 lg:ml-[280px] flex flex-col bg-muted min-h-screen overflow-x-hidden">
    <div class="flex items-center justify-between w-full h-[90px] shrink-0 border-b border-border bg-white px-5 md:px-8">
      <div class="flex items-center gap-4">
        <button onclick="toggleSidebar()" aria-label="Open menu" class="lg:hidden size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer">
          <i data-lucide="menu" class="size-6 text-foreground"></i>
        </button>
        <h2 class="font-bold text-xl md:text-2xl text-foreground">Manajemen Table</h2>
      </div>

      <button onclick="openNotificationModal()" class="size-11 flex items-center justify-center rounded-xl ring-1 ring-border hover:ring-primary transition-all duration-300 cursor-pointer relative" aria-label="Notifications">
        <i data-lucide="bell" class="size-6 text-secondary"></i>
        <span class="absolute -top-1 -right-1 h-5 px-[6px] rounded-full bg-error text-white text-xs font-bold flex items-center justify-center border-2 border-white">2</span>
      </button>
    </div>

    <div class="flex-1 overflow-y-auto p-5 md:p-8">
      <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
          <h1 class="text-foreground text-2xl font-bold mb-1">Edit Table</h1>
          <p class="text-secondary text-sm">Perbarui nomor meja restaurant.</p>
        </div>
        <a href="{{ route('admin.table.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-3 ring-1 ring-border hover:ring-primary rounded-full text-foreground font-semibold transition-all duration-300 bg-white">
          <i data-lucide="arrow-left" class="size-5 text-secondary"></i>
          <span>Kembali</span>
        </a>
      </div>

      <form action="{{ route('admin.table.update', $table) }}" method="POST" class="grid grid-cols-1 xl:grid-cols-[minmax(0,1fr)_360px] gap-6">
        @csrf
        @method('PUT')

        <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
          <div class="p-6 border-b border-border">
            <h3 class="font-bold text-lg text-foreground">Informasi Table</h3>
          </div>

          <div class="p-6 space-y-6">
            <div class="flex flex-col gap-2">
              <label for="number" class="text-sm font-semibold text-foreground">Nomor Meja</label>
              <input
                id="number"
                name="number"
                type="number"
                min="1"
                value="{{ old('number', $table->number) }}"
                placeholder="Contoh: 1"
                class="w-full h-12 px-4 rounded-2xl ring-1 ring-border focus:ring-2 focus:ring-primary bg-muted outline-none text-sm font-medium text-foreground transition-all"
                required
              >
              <p class="text-sm font-medium text-secondary">Kode meja akan dibuat ulang otomatis berdasarkan nomor meja.</p>
              @error('number')
                <p class="text-sm font-medium text-error">{{ $message }}</p>
              @enderror
            </div>
          </div>
        </div>

        <aside class="flex flex-col gap-6">
          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm overflow-hidden">
            <div class="p-6 border-b border-border">
              <h3 class="font-bold text-lg text-foreground">Preview Kode</h3>
            </div>

            <div class="p-6">
              <div class="rounded-2xl bg-muted ring-1 ring-border p-5">
                <div class="mb-4 size-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                  <i data-lucide="utensils" class="size-6"></i>
                </div>
                <p id="tableCodePreview" class="font-bold text-foreground">{{ $table->table_code }}</p>
                <p class="text-sm text-secondary mt-1">Kode final dibuat di controller saat data disimpan.</p>
              </div>
            </div>
          </div>

          <div class="flex flex-col rounded-3xl border border-border bg-white shadow-sm p-6 gap-3">
            <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-primary text-white rounded-full font-bold hover:bg-primary-hover transition-all duration-300 shadow-sm">
              <i data-lucide="save" class="size-5"></i>
              <span>Simpan Perubahan</span>
            </button>
          </div>
        </aside>
      </form>
    </div>
  </main>
</div>

<script>
  (() => {
    const numberInput = document.getElementById('number');
    const codePreview = document.getElementById('tableCodePreview');

    const updatePreview = () => {
      const value = Number.parseInt(numberInput?.value ?? '', 10);
      codePreview.textContent = Number.isInteger(value) && value > 0
        ? `MEJA-${String(value).padStart(3, '0')}`
        : 'MEJA----';
    };

    numberInput?.addEventListener('input', updatePreview);
    updatePreview();
  })();
</script>
@endsection
