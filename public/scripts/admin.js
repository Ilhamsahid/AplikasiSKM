let filteredUser = [...users];
let filteredQuestion = [...pertanyaan];
let idUser = null;
let idQuestion = null;
let typeNow = null;
const formUser = document.getElementById("formUser");
const formQuestion = document.getElementById("formQuestion");

const paginations = {
	users: {
		data: filteredUser,
		currentPage: 1,
		perPage: 10,
		container: "paginationUser",
		info: "paginationInfoUser",
		renderTable: renderUserTable,
	},

	questions: {
		data: filteredQuestion,
		currentPage: 1,
		perPage: 10,
		container: "paginationQuestion",
		info: "paginationInfoQuestion",
		renderTable: renderQuestions,
	},

	results: {
		data: userResults.data !== null ? userResults.data : ["hai", "hai"],
		currentPage: 1,
		perPage: 10,
		container: "paginationResults",
		info: "paginationInfoResults",
		renderTable: renderResults,
	},
};

formQuestion.addEventListener("submit", function () {
	if (formQuestion.dataset.mode === "add") {
		formQuestion.action = "/admin/tambah/question";
	} else if (formQuestion.dataset.mode === "edit") {
		formQuestion.action = `/admin/edit/question/${idQuestion}`;
	}
});

formUser.addEventListener("submit", function (e) {
	if (formUser.dataset.mode === "add") {
		formUser.action = "/admin/tambah/user";
	} else if (formUser.dataset.mode === "edit") {
		formUser.action = `/admin/edit/user/${idUser}`;
	}
});

function closeModal(nameModal) {
	const modal = document.getElementById(nameModal);
	if (nameModal !== "flashModal") {
		modal.classList.add("hidden");
		return;
	}
	if (modal) modal.remove();
}

function deleteModal() {
	const form = document.getElementById("formDelete");
	let url = "";

	if (typeNow === "user") {
		url = `/admin/delete/user/${idUser}`;
	} else if (typeNow === "question") {
		url = `/admin/delete/question/${idUser}`;
	}

	form.addEventListener("submit", function (e) {
		form.action = url;
	});
}

function navigateTo(page, push = true) {
	// Hide all pages
	document
		.querySelectorAll(".page-content")
		.forEach((p) => p.classList.add("hidden"));

	// Remove active state from all nav links
	document.querySelectorAll(".nav-link").forEach((link) => {
		link.classList.remove("bg-green-900");
	});

	// Show selected page
	document.getElementById(page + "Page").classList.remove("hidden");

	// Add active state to current nav link
	document.querySelector(`[data-page="${page}"]`).classList.add("bg-green-900");

	// Update page title
	const titles = {
		dashboard: {
			title: "Dashboard",
			subtitle: "Selamat datang di panel admin E-SKM",
		},
		users: { title: "Manajemen User", subtitle: "Kelola data pengguna sistem" },
		questions: {
			title: "Pertanyaan Survei",
			subtitle: "Kelola pertanyaan kuisioner",
		},
		results: {
			title: "Hasil Kuisioner",
			subtitle: "Lihat dan analisis hasil survei",
		},
	};

	document.getElementById("pageTitle").textContent = titles[page].title;
	document.getElementById("pageSubtitle").textContent = titles[page].subtitle;

	// update URL TANPA reload
	if (push) {
		history.pushState({ page }, "", "/admin/" + page);
	}

	// Close sidebar on mobile after navigation
	if (window.innerWidth < 1024) {
		toggleSidebar();
	}
}

function toggleNotFound(show, table) {
	document.getElementById("notFound" + table).classList.toggle("hidden", !show);
	document.getElementById(table + "TableBody").classList.toggle("hidden", show);
}

function renderUserTable(page) {
	const p = paginations.users;

	const start = (page - 1) * p.perPage;
	const end = start + p.perPage;
	const slicedUsers = p.data.slice(start, end);

	document.getElementById("mobileCardUsers").innerHTML = "";

	if (p.data.length === 0) {
		toggleNotFound(true, "users");
		return;
	}

	toggleNotFound(false, "users");

	let html = "";
	let cardMobile = "";
	slicedUsers.forEach((u, i) => {
		html += `
        <tr>
            <td class="px-6 py-4">${start + i + 1}</td>
            <td class="px-6 py-4">${u.responden}</td>
            <td class="px-6 py-4">${u.umur}</td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                    ${u.kelamin == "L" ? "Laki-laki" : "Perempuan"}
                </span>
            </td>
            <td class="px-6 py-4">
                <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                    ${u.lulusan}
                </span>
            </td>
            <td class="px-6 py-4">${u.jenis_pelayanan}</td>
            <td class="px-6 py-4 text-center">${u.tanggal_terakhir_kali}</td>
            <td class="px-6 py-4 text-center">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="openUserModal('edit',${
											u.id
										})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition cursor-pointer" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('user', ${u.id}, '${
			u.responden
		}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition cursor-pointer" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>`;

		cardMobile += `
        <div class="md:hidden space-y-6">
            <div class="bg-white rounded-xl shadow-md p-5">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex items-center gap-4">
                        <div class="w-13 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-701">Ad</span>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-800">${u.responden}</h3>
                            <p class="text-xs text-gray-601">${u.umur} tahun</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-3 mb-3">
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-601">Kelamin:</span>
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-medium">${u.kelamin}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-601">Lulusan:</span>
                        <span class="px-3 py-1 text-xs font-medium bg-green-100 text-green-700 rounded-full">
                            ${u.lulusan}
                        </span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-601">Jenis pelayanan:</span>
                        <span class="font-medium text-gray-801">${u.jenis_pelayanan}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs">
                        <span class="text-gray-601">Tanggal terakhir:</span>
                        <span class="font-medium text-gray-801">${u.tanggal_terakhir_kali}</span>
                    </div>
                </div>

                <div class="flex gap-3 pt-3 border-t border-gray-200">
                    <button onclick="openUserModal('edit',${u.id})" class="flex-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </button>
                    <button onclick="confirmDelete('user', ${u.id}, '${u.responden}')" class="flex-2 bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition flex items-center justify-center gap-2">
                        <svg class="w-5 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        `;
	});

	document.getElementById("usersTableBody").innerHTML = html;
	document.getElementById("mobileCardUsers").innerHTML = cardMobile;
}

function renderQuestions(page) {
	const p = paginations.questions;

	const start = (page - 1) * p.perPage;
	const end = start + p.perPage;
	const slicedQuestions = p.data.slice(start, end);

	document.getElementById("mobileCardQuestions").innerHTML = "";

	if (p.data.length === 0) {
		toggleNotFound(true, "questions");
		return;
	}

	toggleNotFound(false, "questions");

	let html = "";
	let cardMobile = "";
	slicedQuestions.forEach((q, i) => {
		const answerSplit = q.jawaban.split(":");

		html += `
        <tr class="hover:bg-gray-50 transition">
            <td class="px-6 py-4 text-sm text-gray-700 font-medium">${
							start + i + 1
						}</td>
            <td class="px-6 py-4 text-sm text-gray-800">${q.pertanyaan}</td>
            <td class="px-6 py-4 text-sm text-gray-600">${answerSplit[0]}</td>
            <td class="px-6 py-4 text-sm text-gray-600">${answerSplit[1]}</td>
            <td class="px-6 py-4 text-sm text-gray-600">${answerSplit[2]}</td>
            <td class="px-6 py-4 text-sm text-gray-600">${answerSplit[3]}</td>
            <td class="px-6 py-4">
                <div class="flex items-center justify-center gap-2">
                    <button onclick="openQuestionModal('edit', ${
											q.id
										})" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </button>
                    <button onclick="confirmDelete('question', ${q.id}, '${
			q.pertanyaan
		}')" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </td>
        </tr>
        `;

		cardMobile += `
        <div class="lg:hidden space-y-4">
            <div class="bg-white rounded-xl shadow-md p-4">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-start gap-3 flex-1">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center flex-shrink-0 text-sm font-bold">
                        ${start + i + 1}
                        </div>
                        <p class="text-sm text-gray-800 font-medium leading-relaxed">${
													q.pertanyaan
												}</p>
                    </div>
                </div>

                <div class="space-y-2 mb-3 pl-11">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="bg-green-50 border border-green-200 rounded-lg p-2">
                            <p class="text-xs font-semibold text-green-700 mb-1">A</p>
                            <p class="text-xs text-gray-700">${
															answerSplit[0]
														}</p>
                        </div>
                        <div class="bg-blue-50 border border-blue-200 rounded-lg p-2">
                            <p class="text-xs font-semibold text-blue-700 mb-1">B</p>
                            <p class="text-xs text-gray-700">${
															answerSplit[1]
														}</p>
                        </div>
                        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-2">
                            <p class="text-xs font-semibold text-yellow-700 mb-1">C</p>
                            <p class="text-xs text-gray-700">${
															answerSplit[2]
														}</p>
                        </div>
                        <div class="bg-red-50 border border-red-200 rounded-lg p-2">
                            <p class="text-xs font-semibold text-red-700 mb-1">D</p>
                            <p class="text-xs text-gray-700">${
															answerSplit[3]
														}</p>
                        </div>
                    </div>
                </div>

                <div class="flex gap-2 pt-3 border-t border-gray-200">
                    <button onclick="openQuestionModal('edit', ${
											q.id
										})" class="flex-1 bg-blue-50 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-100 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit
                    </button>
                    <button onclick="confirmDelete('question', ${q.id}, '${
			q.pertanyaan
		}')" class="flex-1 bg-red-50 text-red-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-100 transition flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Hapus
                    </button>
                </div>
            </div>
        </div>
        `;
	});

	document.getElementById("questionsTableBody").innerHTML = html;
	document.getElementById("mobileCardQuestions").innerHTML = cardMobile;
}

function renderResults(page) {
	const p = paginations.results;

	const start = (page - 1) * p.perPage;
	const end = start + p.perPage;
	const slicedResults = p.data.slice(start, end);

	const container = document.getElementById("respondenContainer");
	container.innerHTML = "";

	if (p.data.length === 0) {
		container.innerHTML += `
            <div class="flex flex-col items-center justify-center py-16 px-4">
                <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">Tidak Ada Data</h3>
                <p class="text-gray-500 text-center mb-4">Tidak ada data responden pada periode yang dipilih</p>
            </div>
      `;
		return;
	}

	document.getElementById("EksportHasilButton").classList.remove("hidden");
	document.getElementById("EksportRespondenButton").classList.remove("hidden");

	let rows = "";
	let mobileCard = "";

	slicedResults.forEach((r, i) => {
		rows += `
        <tr class="hover:bg-gray-50 transition">
            <td class="px-4 py-3 text-gray-700 text-sm">${start + i + 1}</td>
            <td class="px-4 py-3 text-gray-800 font-medium">${r.responden}</td>
            <td class="px-4 py-3 text-gray-600">${r.umur}</td>
            <td class="px-4 py-3 text-gray-600">${r.kelamin}</td>
            <td class="px-4 py-3">
                <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-700 rounded-full">
                    ${r.lulusan}
                </span>
            </td>
            <td class="px-4 py-3 text-gray-600">${r.tanggal}</td>
            <td class="px-4 py-3 text-center ">
                <button onclick="viewDetailRespondent(${
									r.id
								})" class="text-green-600 hover:text-green-700 text-sm font-medium flex items-center gap-1 mx-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Detail
                </button>
            </td>
        </tr>
        `;

		mobileCard += `
        <div class="lg:hidden divide-y divide-gray-200">
            <div class="p-4 hover:bg-gray-50 transition">
                <div class="flex items-start justify-between mb-3">
                    <div class="flex items-center gap-3 flex-1">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-green-700">${
															start + i + 1
														}</span>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-sm">${
															r.responden
														}</h4>
                            <p class="text-xs text-gray-600">${r.tanggal}</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-2 mb-3 text-xs">
                    <div class="bg-gray-50 rounded p-2">
                        <span class="text-gray-500 block">Umur</span>
                        <span class="font-semibold text-gray-800">${
													r.umur
												} th</span>
                    </div>
                    <div class="bg-gray-50 rounded p-2">
                        <span class="text-gray-500 block">JK</span>
                        <span class="font-semibold text-gray-800">${
													r.kelamin
												}</span>
                    </div>
                    <div class="bg-gray-50 rounded p-2">
                        <span class="text-gray-500 block">Pendidikan</span>
                        <span class="font-semibold text-gray-800">${
													r.lulusan
												}</span>
                    </div>
                </div>
                <button onclick="viewDetailRespondent(${
									r.id
								})" class="w-full bg-green-50 text-green-600 px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-100 transition flex items-center justify-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    Lihat Detail Jawaban
                </button>
            </div>
        </div>
        `;
	});

	container.innerHTML = `
        <div class="hidden lg:block overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Nama</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Umur</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">JK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Pendidikan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    ${rows}
                </tbody>
            </table>
        </div>
    `;

	document.getElementById("mobileCardResults").innerHTML = mobileCard;
}

function renderResultsChart() {
	let chartResult = document.getElementById("chartResult");

	chartResult.innerHTML += "";
	if (chartResults.length === 0) {
		chartResult.innerHTML += `
            <div class="bg-white rounded-xl shadow-md p-12">
                <div class="flex flex-col items-center justify-center">
                    <svg class="w-24 h-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Data Grafik</h3>
                    <p class="text-gray-500 text-center">Silakan pilih periode terlebih dahulu untuk melihat grafik</p>
                </div>
            </div>
        `;
		return;
	}

	console.log(chartResults);
	row = "";
	chartResults.forEach((c, i) => {
		row += `
            <div class="bg-white rounded-xl shadow-md p-4 sm:p-6">
                <h4 class="font-semibold text-gray-800 mb-4">${i + 1}. ${
			c.question
		}</h4>
                <div class="relative h-64 sm:h-80 lg:h-96">
                    <canvas id="chart${i}"></canvas>
                </div>
            </div>
        `;
	});

	chartResult.innerHTML = row;
}

function confirmDelete(type, userId, name) {
	idUser = userId;
	typeNow = type;
	if (type == "user") {
		document.getElementById("deleteUserName").textContent = `user ${name}`;
	} else if (type == "question") {
		document.getElementById("deleteUserName").textContent = `${name}`;
	}
	document.getElementById("deleteModal").classList.remove("hidden");
}

function renderPagination(key) {
	const p = paginations[key];

	const totalItems = p.data.length;
	const totalPages = Math.ceil(totalItems / p.perPage);
	let html = "";

	const maxRange = 2; // kiri & kanan page aktif

	if (totalItems === 0) {
		document.getElementById(p.container).innerHTML = "";
		document.getElementById(p.info).innerHTML = "Showing 0 of 0";
		return;
	}

	// PREV
	html += `
    <button
        ${p.currentPage === 1 ? "disabled" : ""}
        onclick="changePage('${key}', ${p.currentPage - 1})"
        class="px-3 py-2 rounded-lg text-sm font-medium
        ${
					p.currentPage === 1
						? "bg-gray-200 text-gray-400 cursor-not-allowed"
						: "bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700"
				}
        transition">
        ‹
    </button>`;

	for (let i = 1; i <= totalPages; i++) {
		if (
			i === 1 ||
			i === totalPages ||
			(i >= p.currentPage - maxRange && i <= p.currentPage + maxRange)
		) {
			html += `
            <button
                onclick="changePage('${key}', ${i})"
                class="px-4 py-2 rounded-lg text-sm font-medium transition
                ${
									i === p.currentPage
										? "bg-green-600 text-white shadow-md"
										: "bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700"
								}">
                ${i}
            </button>`;
		} else if (
			i === p.currentPage - maxRange - 1 ||
			i === p.currentPage + maxRange + 1
		) {
			html += `<span class="px-2 text-gray-400">…</span>`;
		}
	}

	// NEXT
	html += `
    <button
        ${p.currentPage === totalPages ? "disabled" : ""}
        onclick="changePage('${key}',${p.currentPage + 1})"
        class="px-3 py-2 rounded-lg text-sm font-medium
        ${
					p.currentPage === totalPages
						? "bg-gray-200 text-gray-400 cursor-not-allowed"
						: "bg-white border border-gray-300 text-gray-700 hover:bg-green-50 hover:border-green-400 hover:text-green-700"
				}
        transition">
        ›
    </button>`;

	document.getElementById(p.container).innerHTML = html;

	renderPaginationInfo(key);
}

function renderPaginationInfo(key) {
	const p = paginations[key];

	const totalItems = p.data.length;
	const start = (p.currentPage - 1) * p.perPage + 1;
	const end = Math.min(start + p.perPage - 1, totalItems);

	document.getElementById(
		p.info
	).innerHTML = `Showing <span class="font-medium text-gray-800">${start}</span>
         – <span class="font-medium text-gray-800">${end}</span>
         of <span class="font-medium text-gray-800">${totalItems}</span>`;
}

function changePage(key, page) {
	const p = paginations[key];
	const totalPages = Math.ceil(p.data.length / p.perPage);
	if (page < 1 || page > totalPages) return;

	p.currentPage = page;
	p.renderTable(page);
	renderPagination(key);
}

// Toggle Sidebar
function toggleSidebar() {
	const sidebar = document.getElementById("sidebar");
	const overlay = document.getElementById("overlay");

	sidebar.classList.toggle("-translate-x-full");
	overlay.classList.toggle("hidden");
}

function searchUser(value) {
	paginations.users.data = users.filter((user) => {
		return user.responden.toLowerCase().includes(value.toLowerCase().trim());
	});

	paginations.users.currentPage = 1;
	renderUserTable(1);
	renderPagination("users");
}

function searchQuestions(value) {
	paginations.questions.data = pertanyaan.filter((pty) => {
		return pty.pertanyaan.toLowerCase().includes(value.toLowerCase().trim());
	});

	paginations.questions.currentPage = 1;
	renderQuestions(1);
	renderPagination("questions");
}

function clearModalUser() {
	document.getElementById("nama").value = "";
	document.getElementById("umur").value = "";
	document.getElementById("kelamin").value = "";
	document.getElementById("lulusan").value = "";
	document.getElementById("layanan").value = "";
	document.getElementById("tanggal_terakhir").value = "";
}

function openUserModal(mode, userId = null) {
	const modal = document.getElementById("userModal");
	const modalTitle = document.getElementById("modalTitle");

	formUser.dataset.mode = mode;
	idUser = userId;

	if (mode === "add") {
		modalTitle.textContent = "Tambah User";
		clearModalUser();
	} else {
		modalTitle.textContent = "Edit User";
		const userEdit = users.find((u) => u.id == userId);

		document.getElementById("nama").value = userEdit.responden;
		document.getElementById("umur").value = userEdit.umur;
		document.getElementById("kelamin").value = userEdit.kelamin;
		document.getElementById("lulusan").value = userEdit.lulusan;
		document.getElementById("layanan").value = userEdit.jenis_pelayanan;
		document.getElementById("tanggal_terakhir").value =
			userEdit.tanggal_terakhir_kali;
	}

	modal.classList.remove("hidden");
}

function viewDetailRespondent(id) {
	document.getElementById("detailModal").classList.remove("hidden");
	document.getElementById("detailModal").classList.add("flex");

	const responden =
		paginations.results.data.length > 0
			? paginations.results.data.find((u) => u.id == id)
			: recentRespondent.find((u) => u.id == id);
	console.log(responden);

	document.getElementById("namaResponden").textContent = responden.responden;
	document.getElementById("umurResponden").textContent = responden.umur;
	document.getElementById("kelaminResponden").textContent =
		responden.kelamin == "L" ? "Laki-laki" : "Perempuan";
	document.getElementById("pendidikanResponden").textContent =
		responden.lulusan;
	document.getElementById("poinResponden").textContent = responden.nilai;

	let jawabanContainer = document.getElementById("listJawaban");

	jawabanContainer.innerHTML = "";

	let cards = "";
	for (let i = 0; i < responden.jawaban.length; i++) {
		cards += `
            <div class="border border-gray-200 rounded-lg p-4 hover:border-green-500 transition">
                <p class="text-sm font-medium text-gray-700 mb-2">${i + 1}. ${
			pertanyaan[i].pertanyaan
		}</p>
                <div class="bg-green-100 text-green-700 px-3 py-2 rounded-lg text-sm font-semibold inline-block">
                    ${responden.jawaban[i]}
                </div>
            </div>
        `;
	}

	jawabanContainer.innerHTML = cards;
}
function closeDetailModal() {
	document.getElementById("detailModal").classList.add("hidden");
	document.getElementById("detailModal").classList.remove("flex");
}

function clearModalQuestion() {
	document.getElementById("pertanyaanSurvei").value = "";
	document.getElementById("jawabanA").value = "";
	document.getElementById("jawabanB").value = "";
	document.getElementById("jawabanC").value = "";
	document.getElementById("jawabanD").value = "";
}

function openQuestionModal(mode, questionId = null) {
	const modal = document.getElementById("questionModal");
	const modalTitle = document.getElementById("modalTitle");

	formQuestion.dataset.mode = mode;
	idQuestion = questionId;

	if (mode === "add") {
		modalTitle.textContent = "Tambah Pertanyaan";
		clearModalQuestion();
	} else {
		modalTitle.textContent = "Edit Pertanyaan";
		const questionEdit = pertanyaan.find((p) => p.id == questionId);
		const answerSplit = questionEdit.jawaban.split(":");

		document.getElementById("pertanyaanSurvei").value = questionEdit.pertanyaan;
		document.getElementById("jawabanA").value = answerSplit[0];
		document.getElementById("jawabanB").value = answerSplit[1];
		document.getElementById("jawabanC").value = answerSplit[2];
		document.getElementById("jawabanD").value = answerSplit[3];
	}

	modal.classList.remove("hidden");
	modal.classList.add("flex");
}

function closeUserModal() {
	document.getElementById("userModal").classList.add("hidden");
}

function closeQuestionModal() {
	document.getElementById("questionModal").classList.add("hidden");
}

// load pertama
renderUserTable(1);
renderQuestions(1);
renderResults(1);
renderResultsChart();

renderPagination("users");
renderPagination("questions");
renderPagination("results");

window.addEventListener("DOMContentLoaded", () => {
	const path = window.location.pathname.replace(/\/+$/, ""); // hapus trailing slash

	const segments = path.split("/");
	const page = segments[segments.length - 1] || "dashboard";

	navigateTo(page, false);
	toggleSidebar();
});

window.addEventListener("popstate", () => {
	const path = window.location.pathname;
	const page = path.split("/").pop() || "dashboard";
	navigateTo(page, false);
});

const colors = ["#dc2626", "#f59e0b", "#3b82f6", "#16a34a"];

// chartResults.forEach((data, index) => {
//     const ctx = document.getElementById('chart' + index).getContext('2d');

//     // Filter data yang nilainya 0
//     const filteredData = {
//         labels: [],
//         values: [],
//         colors: []
//     };

//     data.values.forEach((value, i) => {
//         if (value > 0) {
//             filteredData.labels.push(data.labels[i]);
//             filteredData.values.push(data.user[i]);
//             filteredData.colors.push(colors[i]);
//         }
//     });

//     // Hitung total
//     const total = filteredData.values.reduce((a, b) => a + b, 0);

//     new Chart(ctx, {
//         type: 'pie',
//         data: {
//             labels: filteredData.labels,
//             datasets: [{
//                 data: filteredData.values,
//                 backgroundColor: filteredData.colors,
//                 borderWidth: 2,
//                 borderColor: '#ffffff'
//             }]
//         },
//         options: {
//             responsive: true,
//             maintainAspectRatio: false,
//             plugins: {
//                 legend: {
//                     display: true,
//                     position: 'bottom',
//                     labels: {
//                         padding: 15,
//                         font: {
//                             size: 12
//                         },
//                         usePointStyle: true,
//                         pointStyle: 'circle'
//                     }
//                 },
//                 tooltip: {
//                     backgroundColor: 'rgba(0, 0, 0, 0.8)',
//                     padding: 12,
//                     titleFont: {
//                         size: 14,
//                         weight: 'bold'
//                     },
//                     bodyFont: {
//                         size: 13
//                     },
//                     callbacks: {
//                         label: function(context) {
//                             const value = context.parsed;
//                             const percentage = ((value / total) * 100).toFixed(1);
//                             return context.label + ': ' + value + ' orang (' + percentage + '%)';
//                         }
//                     }
//                 },
//                 datalabels: {
//                     color: '#ffffff',
//                     font: {
//                         weight: 'bold',
//                         size: 14
//                     },
//                     formatter: function(value) {
//                         return value + ' orang';
//                     }
//                 }
//             }
//         },
//         plugins: [ChartDataLabels]
//     });
// });

chartResults.forEach((data, index) => {
	const ctx = document.getElementById(`chart${index}`).getContext("2d");

	// Total untuk hitung persentase
	const total = data.values.reduce((a, b) => a + b, 0);

	new Chart(ctx, {
		type: "pie",
		data: {
			labels: data.labels,
			datasets: [
				{
					data: data.user,
					backgroundColor: colors,
					borderWidth: 2,
					borderColor: "#ffffff",
				},
			],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: true,
					position: "bottom",
					labels: {
						padding: 15,
						font: {
							size: 12,
						},
						usePointStyle: true,
						pointStyle: "circle",
					},
				},
				tooltip: {
					backgroundColor: "rgba(0, 0, 0, 0.8)",
					padding: 12,
					titleFont: {
						size: 14,
						weight: "bold",
					},
					bodyFont: {
						size: 13,
					},
					callbacks: {
						label: (context) => {
							const value = context.parsed;
							const percentage = ((value / total) * 100).toFixed(1);

							return `${context.label}: ${value} Responden`;
						},
					},
				},
			},
		},
	});
});
