<div>
    <div class="p-10">
        <h1 class="px-2 mb-5 text-2xl font-medium text-slate-700 text-center">Vaccination Sign Up Form</h1>
        <div
            class="px-8 mx-auto flex items-center justify-center max-w-xl min-h-screen bg-white border border-gray-200">
            <form wire:submit="create" class="flex-1">
                {{ $this->form }}

                <button wire:loading.attr="disabled" type="submit"
                        class="px-4 py-2 block text-md font-semibold uppercase bg-amber-600 text-white hover:bg-amber-700 w-full rounded-lg mt-5 transition-all disabled:bg-amber-800">
                    Submit
                </button>
                <div class="sr-only mx-auto text-gray-800 text-sm py-2 text-center" wire:loading.class.remove="sr-only">
                    Loading...
                </div>
            </form>
        </div>
    </div>

    <x-filament-actions::modals/>
</div>
