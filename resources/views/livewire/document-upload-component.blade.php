<div>
    <h1>📄 Subir Documento</h1>

    @if (session()->has('message'))
        <div style="background: green; color: white; padding: 10px; margin: 10px 0;">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="upload" enctype="multipart/form-data">
        <div>
            <label for="file">Seleccionar archivo PDF:</label>
            <input type="file" wire:model="file" id="file" accept=".pdf">
            @error('file')
                <span style="color: red;">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" wire:loading.attr="disabled">
            <span wire:loading.remove>📤 Subir Documento</span>
            <span wire:loading>⏳ Subiendo...</span>
        </button>
    </form>
</div>
