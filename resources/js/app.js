import './bootstrap';

let dropdownToggle = document.getElementById('dropdownToggle');
let dropdownMenu = document.getElementById('dropdownMenu');

function handleClick() {
    if (dropdownMenu.className.includes('block')) {
        dropdownMenu.classList.add('hidden')
        dropdownMenu.classList.remove('block')
    } else {
        dropdownMenu.classList.add('block')
        dropdownMenu.classList.remove('hidden')
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const inputIds = ['nama-input', 'alamat-input', 'notelp-input', 'email-input', 'password-input'];
    const editButton = document.getElementById('edit-button');
    let isEditing = false;

    function toggleAllInputs() {
        isEditing = !isEditing;
        inputIds.forEach(id => {
            const input = document.getElementById(id);
            if (isEditing) {
                input.removeAttribute('readonly');
                editButton.textContent = 'Simpan';
            } else {
                input.setAttribute('readonly', true);
                editButton.textContent = 'Edit';
            }
        });
        console.log(`Editing mode: ${isEditing}`);
    }

    editButton.onclick = toggleAllInputs;
});

dropdownToggle.addEventListener('click', handleClick);

import './dropdown';