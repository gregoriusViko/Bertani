
// Toggle for Toko dropdown
const tokoDropdownToggle = document.getElementById('tokoDropdownToggle');
const tokoDropdownMenu = document.getElementById('tokoDropdownMenu');
tokoDropdownToggle.addEventListener('click', () => {
    tokoDropdownMenu.classList.toggle('hidden');
});

// Toggle for Lainnya dropdown
const lainnyaDropdownToggle = document.getElementById('lainnyaDropdownToggle');
const lainnyaDropdownMenu = document.getElementById('lainnyaDropdownMenu');
lainnyaDropdownToggle.addEventListener('click', () => {
    lainnyaDropdownMenu.classList.toggle('hidden');
});

// Close dropdowns when clicking outside
document.addEventListener('click', (event) => {
    if (!tokoDropdownToggle.contains(event.target) && !tokoDropdownMenu.contains(event.target)) {
        tokoDropdownMenu.classList.add('hidden');
    }
    if (!lainnyaDropdownToggle.contains(event.target) && !lainnyaDropdownMenu.contains(event.target)) {
        lainnyaDropdownMenu.classList.add('hidden');
    }
});
