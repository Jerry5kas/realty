// Simple CRUD Actions - Delete functionality

function deleteItem(url, message = 'Are you sure you want to delete this item?') {
    if (confirm(message)) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = url;
        
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = csrfToken;
        
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        
        form.appendChild(csrfInput);
        form.appendChild(methodInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function bulkDelete(checkboxClass, formId, message = 'Are you sure you want to delete the selected items?') {
    const checkboxes = document.querySelectorAll(`.${checkboxClass}:checked`);
    
    if (checkboxes.length === 0) {
        alert('Please select at least one item to delete.');
        return;
    }
    
    if (confirm(`${message} (${checkboxes.length} items)`)) {
        const form = document.getElementById(formId);
        form.submit();
    }
}

function toggleSelectAll(checkbox, checkboxClass) {
    const checkboxes = document.querySelectorAll(`.${checkboxClass}`);
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    updateBulkDeleteButton(checkboxClass);
}

function updateBulkDeleteButton(checkboxClass) {
    const checkboxes = document.querySelectorAll(`.${checkboxClass}:checked`);
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const selectedCount = document.getElementById('selectedCount');
    
    if (checkboxes.length > 0) {
        bulkDeleteBtn.classList.remove('hidden');
        bulkDeleteBtn.classList.add('flex');
        selectedCount.textContent = checkboxes.length;
    } else {
        bulkDeleteBtn.classList.add('hidden');
        bulkDeleteBtn.classList.remove('flex');
    }
}
