@props(['id' => 'confirmModal', 'title' => 'Confirm Action', 'message' => 'Are you sure?'])

<div id="{{ $id }}" class="hidden fixed inset-0 z-50 overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" onclick="closeModal('{{ $id }}')"></div>

        <div class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-6 py-4 border-b" style="background-color: {{ $theme['primary_color'] }};">
                <h3 class="text-lg font-semibold" style="color: white;">{{ $title }}</h3>
            </div>
            
            <div class="bg-white px-6 py-4">
                <p class="text-sm" style="color: {{ $theme['accent_color'] }};">{{ $message }}</p>
            </div>

            <div class="bg-gray-50 px-6 py-4 flex flex-col-reverse sm:flex-row sm:justify-end gap-3">
                <button type="button" onclick="closeModal('{{ $id }}')" class="px-6 py-2 border-2 rounded-xl font-medium hover:bg-gray-100 transition-all" style="border-color: {{ $theme['primary_color'] }}; color: {{ $theme['primary_color'] }};">
                    Cancel
                </button>
                <button type="button" onclick="confirmAction('{{ $id }}')" class="px-6 py-2 bg-red-500 text-white rounded-xl font-medium hover:bg-red-600 transition-all">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openModal(modalId, callback) {
    document.getElementById(modalId).classList.remove('hidden');
    window.modalCallback = callback;
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    window.modalCallback = null;
}

function confirmAction(modalId) {
    if (window.modalCallback) {
        window.modalCallback();
    }
    closeModal(modalId);
}
</script>
