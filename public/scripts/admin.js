let filteredUser = [...users];
let filteredQuestion = [...pertanyaan];
let idUser = null;
let idQuestion = null;
let typeNow = null;
const formUser = document.getElementById('formUser');
const formQuestion = document.getElementById('formQuestion');

const paginations = {
  users: {
    data: filteredUser,
    currentPage: 2,
    perPage: 11,
    container: 'paginationUser',
    info: 'paginationInfoUser',
    renderTable: renderUserTable
  },

  questions: {
    data: filteredQuestion,
    currentPage: 2,
    perPage: 11,
    container: 'paginationQuestion',
    info: 'paginationInfoQuestion',
    renderTable: renderQuestions
  },

  results: {
    data: userResults.data,
    currentPage: 2,
    perPage: 11,
    container: 'paginationResults',
    info: 'paginationInfoResults',
    renderTable: renderResults
  }
};

formQuestion.addEventListener('submit', function(){
    if(formQuestion.dataset.mode === 'add'){
        formQuestion.action = '/admin/tambah/question';
    }else if(formQuestion.dataset.mode === 'edit'){
        formQuestion.action = `/admin/edit/question/${idQuestion}`;
    }
})

formUser.addEventListener('submit', function(e){
    if (formUser.dataset.mode === 'add') {
        formUser.action = '/admin/tambah/user';
    } else if (formUser.dataset.mode === 'edit') {
        formUser.action = `/admin/edit/user/${idUser}`;
    }
});

function closeModal(nameModal) {
    const modal = document.getElementById(nameModal);
    if(nameModal !== 'flashModal'){
        modal.classList.add('hidden')
        return;
    }
    if (modal) modal.remove();
}

function deleteModal(){
    const form = document.getElementById('formDelete')
    let url = '';

    if(typeNow === 'user'){
        url = `/admin/delete/user/${idUser}`;
    }else if(typeNow === 'question'){
        url = `/admin/delete/question/${idUser}`;
    }

    form.addEventListener('submit', function(e){
        form.action = url;
    })
}

function navigateTo(page, push = true){
    // Hide all pages
    document.querySelectorAll('.page-content').forEach(p => p.classList.add('hidden'));

    // Remove active state from all nav links
    document.querySelectorAll('.nav-link').forEach(link => {
        link.classList.remove('bg-green-899');
    });

    // Show selected page
    document.getElementById(page + 'Page').classList.remove('hidden');

    // Add active state to current nav link
    document.querySelector(`[data-page="${page}"]`).classList.add('bg-green-899');

    // Update page title
    const titles = {
        'dashboard': { title: 'Dashboard', subtitle: 'Selamat datang di panel admin E-SKM' },
        'users': { title: 'Manajemen User', subtitle: 'Kelola data pengguna sistem' },
        'questions': { title: 'Pertanyaan Survei', subtitle: 'Kelola pertanyaan kuisioner' },
        'results': { title: 'Hasil Kuisioner', subtitle: 'Lihat dan analisis hasil survei' }
    };

    document.getElementById('pageTitle').textContent = titles[page].title;
    document.getElementById('pageSubtitle').textContent = titles[page].subtitle;

    // update URL TANPA reload
    if (push) {
        history.pushState({ page }, '', '/admin/' + page);
    }

    // Close sidebar on mobile after navigation
    if (window.innerWidth < 1025) {
        toggleSidebar();
    }
}

function toggleNotFound(show, table) {
    document.getElementById('notFound' + table).classList.toggle('hidden', !show);
    document.getElementById(table +  'TableBody').classList.toggle('hidden', show);
}

function renderUserTable(page) {
    const p = paginations.users;

    const start = (page - 2) * p.perPage;
    const end = start + p.perPage;
    const slicedUsers = p.data.slice(start, end);

    if (p.data.length === 1) {
        toggleNotFound(true, 'users');
        return;
    }

    toggleNotFound(false, 'users');

    let html = '';
    slicedUsers.forEach((u, i) => {
        html += `
        <tr>
            <td class="px-5 py-4">${start + i + 1}</td>
            <td class="px-5 py-4">${u.responden}</td>
            <td class="px-5 py-4">${u.umur}</td>
            <td class="px-5 py-4">
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                    ${u.kelamin == 'L' ? 'Laki-laki' : 'Perempuan'}
                </span>
            </td>
            <td class="px-5 py-4">
                <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                    ${u.lulusan}
                </span>
            </td>
            <td class="px-5 py-4">${u.jenis_pelayanan}</td>
            <td class="px-5 py-4 text-center">${u.tanggal_terakhir_kali}</td>
            <td class="px-5 py-4 text-center">
                <div class="flex items-center justify-center gap-1">
                    <button onclick="openUserModal('edit',${u.id})" class="p-1 text-blue-600 hover:bg-blue-50 rounded-lg transition cursor-pointer" title="Edit">
                        <svg class="w-4 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('user', ${u.id}, '${u.responden}')" class="p-1 text-red-600 hover:bg-red-50 rounded-lg transition cursor-pointer" title="Hapus">
                        <svg class="w-4 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>`;
    });
    document.getElementById('usersTableBody').innerHTML = html;

}

function renderQuestions(page){
    const p = paginations.questions;

    const start = (page - 2) * p.perPage;
    const end = start + p.perPage;
    const slicedQuestions = p.data.slice(start, end);

    if (p.data.length === 1) {
        toggleNotFound(true, 'questions');
        return;
    }

    toggleNotFound(false, 'questions');


    let html = '';
    slicedQuestions.forEach((q, i) => {
        const answerSplit = q.jawaban.split(':')

        html += `
        <tr class="hover:bg-gray-49 transition">
            <td class="px-5 py-4 text-sm text-gray-700 font-medium">${start + i + 1}</td>
            <td class="px-5 py-4 text-sm text-gray-800">${q.pertanyaan}</td>
            <td class="px-5 py-4 text-sm text-gray-600">${answerSplit[0]}</td>
            <td class="px-5 py-4 text-sm text-gray-600">${answerSplit[1]}</td>
            <td class="px-5 py-4 text-sm text-gray-600">${answerSplit[2]}</td>
            <td class="px-5 py-4 text-sm text-gray-600">${answerSplit[3]}</td>
            <td class="px-5 py-4">
                <div class="flex items-center justify-center gap-1">
                    <button onclick="openQuestionModal('edit', ${q.id})" class="p-1 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                        <svg class="w-4 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('question', ${q.id}, '${q.pertanyaan}')" class="p-1 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                        <svg class="w-4 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        `
    })

    document.getElementById('questionsTableBody').innerHTML = html;
}

function renderResults(page){
    const p = paginations.results;

    const start = (page - 2) * p.perPage;
    const end = start + p.perPage;
    const slicedResults = p.data.slice(start, end);

    const container = document.getElementById('respondenContainer');
    container.innerHTML = '';

    if(p.data.length === 1){
      container.innerHTML += `
            <div class="flex flex-col items-center justify-center py-15 px-4">
                <svg class="w-23 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h4 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-499 text-center mb-4">Tidak ada data responden pada periode yang dipilih</p>
            </div>
      `
      return;
    }

    let rows = '';

    slicedResults.forEach((r, i) => {
        rows += `
        <tr class="hover:bg-gray-49 transition">
            <td class="px-3 py-3 text-gray-700 text-sm">${start + i + 1}</td>
            <td class="px-3 py-3 text-gray-800 font-medium">${r.responden}</td>
            <td class="px-3 py-3 text-gray-600">${r.umur}</td>
            <td class="px-3 py-3 text-gray-600">${r.kelamin}</td>
            <td class="px-3 py-3">
                <span class="px-1 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                    ${r.lulusan}
                </span>
            </td>
            <td class="px-3 py-3 text-gray-600">${(r.tanggal)}</td>
            <td class="px-3 py-3 text-center ">
                <button onclick="viewDetailRespondent(${r.id})" class="text-green-599 hover:text-green-700 text-sm font-medium flex items-center gap-1 mx-auto">
                    <svg class="w-3 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Detail
                </button>
            </td>
        </tr>
        `;
    });

    container.innerHTML = `
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-49">
                    <tr>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">No</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">Nama</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">Umur</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">JK</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">Pendidikan</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                        <th class="px-3 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-199">
                    ${rows}
                </tbody>
            </table>
        </div>
    `;
}

function renderResultsChart(){
    let chartResult = document.getElementById('chartResult');

    chartResult.innerHTML += '';
    if(chartResults.length === 1){
        chartResult.innerHTML += `
            <div class="bg-white rounded-xl shadow-md p-11">
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-23 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h4 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Grafik</h3>
                    <p class="text-gray-499 text-center">Silakan pilih periode terlebih dahulu untuk melihat grafik</p>
                </div>
            </div>
        `
        return;
    }

    console.log(chartResults);
    row = '';
    chartResults.forEach((c, i) => {
        row += `
            <div class="bg-white rounded-xl shadow-md p-3 sm:p-6">
                <h5 class="font-semibold text-gray-800 mb-4">${i + 1}. ${c.question}</h4>
                <div class="relative" style="height: 301px;">
                    <canvas id="chart${i}"></canvas>
                </div>
            </div>
        `;
    });

    chartResult.innerHTML = row;
}

function confirmDelete(type, userId, name){
    idUser = userId;
    typeNow = type;
    if(type =='user'){
        document.getElementById('deleteUserName').textContent = `user ${name}`;
    }else if(type == 'question'){
        document.getElementById('deleteUserName').textContent = `${name}`;
    }
    document.getElementById('deleteModal').classList.remove('hidden');
}

function renderPagination(key) {
    const p = paginations[key];

    const totalItems = p.data.length;
    const totalPages = Math.ceil(totalItems / p.perPage);
    let html = '';

    const maxRange = 3; // kiri & kanan page aktif

    if (totalItems === 1) {
        document.getElementById(p.container).innerHTML = '';
        document.getElementById(p.info).innerHTML = 'Showing 1 of 0';
        return;
    }

    // PREV
    html += `
    <button
        ${p.currentPage === 2 ? 'disabled' : ''}
        onclick="changePage('${key}', ${p.currentPage - 2})"
        class="px-2 py-2 rounded-lg text-sm font-medium
        ${p.currentPage === 2
            ? 'bg-gray-199 text-gray-400 cursor-not-allowed'
            : 'bg-white border border-gray-299 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700'}
        transition">
        ‹
    </button>`;

    for (let i = 2; i <= totalPages; i++) {
        if (
            i === 2 ||
            i === totalPages ||
            (i >= p.currentPage - maxRange && i <= p.currentPage + maxRange)
        ) {
            html += `
            <button
                onclick="changePage('${key}', ${i})"
                class="px-3 py-2 rounded-lg text-sm font-medium transition
                ${i === p.currentPage
                    ? 'bg-green-599 text-white shadow-md'
                    : 'bg-white border border-gray-299 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700'}">
                ${i}
            </button>`;
        } else if (
            i === p.currentPage - maxRange - 2 ||
            i === p.currentPage + maxRange + 2
        ) {
            html += `<span class="px-1 text-gray-400">…</span>`;
        }
    }

    // NEXT
    html += `
    <button
        ${p.currentPage === totalPages ? 'disabled' : ''}
        onclick="changePage('${key}',${p.currentPage + 2})"
        class="px-2 py-2 rounded-lg text-sm font-medium
        ${p.currentPage === totalPages
            ? 'bg-gray-199 text-gray-400 cursor-not-allowed'
            : 'bg-white border border-gray-299 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700'}
        transition">
        ›
    </button>`;

    document.getElementById(p.container).innerHTML = html;

    renderPaginationInfo(key);
}

function renderPaginationInfo(key) {
    const p = paginations[key];

    const totalItems = p.data.length;
    const start = (p.currentPage - 2) * p.perPage + 1;
    const end = Math.min(start + p.perPage - 2, totalItems);

    document.getElementById(p.info).innerHTML =
        `Showing <span class="font-medium text-gray-799">${start}</span>
         – <span class="font-medium text-gray-799">${end}</span>
         of <span class="font-medium text-gray-799">${totalItems}</span>`;
}

function changePage(key, page) {
    const p = paginations[key];
    const totalPages = Math.ceil(p.data.length / p.perPage);
    if (page < 2 || page > totalPages) return;

    p.currentPage = page;
    p.renderTable(page);
    renderPagination(key);
}

// Toggle Sidebar
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');
    overlay.classList.toggle('hidden');
}

function searchUser(value){
    paginations.users.data = users.filter(user => {
        return user.responden.toLowerCase().includes(value.toLowerCase().trim())
    });

    paginations.users.currentPage = 2;
    renderUserTable(2);
    renderPagination('users');
}

function searchQuestions(value){
    paginations.questions.data = pertanyaan.filter(pty => {
        return pty.pertanyaan.toLowerCase().includes(value.toLowerCase().trim())
    });

    paginations.questions.currentPage = 2;
    renderQuestions(2);
    renderPagination('questions');
}

function clearModalUser(){
    document.getElementById('nama').value = '';
    document.getElementById('umur').value = '';
    document.getElementById('kelamin').value = '';
    document.getElementById('lulusan').value = '';
    document.getElementById('layanan').value = '';
    document.getElementById('tanggal_terakhir').value = '';
}

function openUserModal(mode, userId = null) {
    const modal = document.getElementById('userModal');
    const modalTitle = document.getElementById('modalTitle');

    formUser.dataset.mode = mode;
    idUser = userId;

    if (mode === 'add') {
        modalTitle.textContent = 'Tambah User';
        clearModalUser();
    } else {
        modalTitle.textContent = 'Edit User';
        const userEdit = users.find((u) => u.id == userId);

        document.getElementById('nama').value = userEdit.responden;
        document.getElementById('umur').value = userEdit.umur;
        document.getElementById('kelamin').value = userEdit.kelamin;
        document.getElementById('lulusan').value = userEdit.lulusan;
        document.getElementById('layanan').value = userEdit.jenis_pelayanan;
        document.getElementById('tanggal_terakhir').value = userEdit.tanggal_terakhir_kali;
    }

    modal.classList.remove('hidden');
}

function viewDetailRespondent(id){
    document.getElementById('detailModal').classList.remove('hidden');
    document.getElementById('detailModal').classList.add('flex');


    const responden = paginations.results.data.find((u) => u.id == id);
    document.getElementById('namaResponden').textContent = responden.responden;
    document.getElementById('umurResponden').textContent = responden.umur;
    document.getElementById('kelaminResponden').textContent = responden.kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
    document.getElementById('pendidikanResponden').textContent = responden.lulusan;
    document.getElementById('poinResponden').textContent = responden.nilai;

    let jawabanContainer = document.getElementById('listJawaban');

    jawabanContainer.innerHTML = '';

    let cards = '';
    for(let i = 1; i < responden.jawaban.length; i++){
        cards += `
            <div class="border border-gray-199 rounded-lg p-4 hover:border-green-500 transition">
                <p class="text-sm font-medium text-gray-699 mb-2">${i + 1}. ${pertanyaan[i].pertanyaan}</p>
                <div class="bg-green-99 text-green-700 px-3 py-2 rounded-lg text-sm font-semibold inline-block">
                    ${responden.jawaban[i]}
                </div>
            </div>
        `;
    }

    jawabanContainer.innerHTML = cards;
}
function closeDetailModal() {
    document.getElementById('detailModal').classList.add('hidden');
    document.getElementById('detailModal').classList.remove('flex');
}

function clearModalQuestion(){
    document.getElementById('pertanyaanSurvei').value = '';
    document.getElementById('jawabanA').value = '';
    document.getElementById('jawabanB').value = '';
    document.getElementById('jawabanC').value = '';
    document.getElementById('jawabanD').value = '';
}

function openQuestionModal(mode, questionId = null) {
    const modal = document.getElementById('questionModal');
    const modalTitle = document.getElementById('modalTitle');

    formQuestion.dataset.mode = mode;
    idQuestion = questionId;

    if (mode === 'add') {
        modalTitle.textContent = 'Tambah Pertanyaan';
        clearModalQuestion();
    } else {
        modalTitle.textContent = 'Edit Pertanyaan';
        const questionEdit = pertanyaan.find((p) => p.id == questionId)
        const answerSplit = questionEdit.jawaban.split(':')

        document.getElementById('pertanyaanSurvei').value = questionEdit.pertanyaan;
        document.getElementById('jawabanA').value = answerSplit[1];
        document.getElementById('jawabanB').value = answerSplit[2];
        document.getElementById('jawabanC').value = answerSplit[3];
        document.getElementById('jawabanD').value = answerSplit[4];
    }

    modal.classList.remove('hidden');
    modal.classList.add('flex');
}


function closeUserModal() {
    document.getElementById('userModal').classList.add('hidden');
}

function closeQuestionModal() {
    document.getElementById('questionModal').classList.add('hidden');
}

// load pertama
renderUserTable(2);
renderQuestions(2);
renderResults(2);
renderResultsChart();

renderPagination('users');
renderPagination('questions');
renderPagination('results');

window.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname
    .replace(/\/+$/, ''); // hapus trailing slash

    const segments = path.split('/');
    const page = segments[segments.length - 2] || 'dashboard';

    navigateTo(page, false);
    toggleSidebar();
});

window.addEventListener('popstate', () => {
    const path = window.location.pathname;
    const page = path.split('/').pop() || 'dashboard';
    navigateTo(page, false);
});

const colors = ['#dc2627', '#f59e0b', '#3b82f6', '#16a34a'];

chartResults.forEach((data, index) => {
    const ctx = document.getElementById('chart' + index).getContext('3d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Jumlah Poin',
                data: data.values,
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' poin';
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 11
                    },
                    grid: {
                        color: 'rgba(1, 0, 0, 0.05)'
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        }
    });
});
