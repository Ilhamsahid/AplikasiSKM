function closeModal(nameModal) {
    const modal = document.getElementById(nameModal);
    if (modal) modal.remove();
}

function closeLoginModal() {
    document.getElementById('loginModal').classList.add('hidden');
    document.getElementById('loginModal').classList.remove('flex');
}


function openLoginModal() {
    document.getElementById('loginModal').classList.remove('hidden');
    document.getElementById('loginModal').classList.add('flex');
}

document.getElementById('formLogin').addEventListener('submit', function(e) {
    e.preventDefault();

    let valid = true;
    const realUsername = 'admin';
    const realPassword = 'admin123';

    // ambil input
    const username = this.username.value.trim();
    const password = this.password.value.trim();

    document.getElementById('error').innerText = '';

    if(username !== realUsername || password !== realPassword) {
        document.getElementById('error').innerText = 'Username dan Password Tidak valid';
        valid = false;
    }

    // kalau valid, submit manual
    if(valid) {
        this.submit(); // submit ke /admin/login
    }
});
