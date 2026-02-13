# Details

Date : 2026-02-03 14:43:11

Directory c:\\xampp\\htdocs\\AplikasiSKM\\app

Total : 45 files,  2898 codes, 17 comments, 504 blanks, all 3419 lines

[Summary](results.md) / Details / [Diff Summary](diff.md) / [Diff Details](diff-details.md)

## Files
| filename | language | code | comment | blank | total |
| :--- | :--- | ---: | ---: | ---: | ---: |
| [app/configs/database.php](/app/configs/database.php) | PHP | 9 | 0 | 4 | 13 |
| [app/controllers/AdminController.php](/app/controllers/AdminController.php) | PHP | 140 | 0 | 34 | 174 |
| [app/controllers/SurveyController.php](/app/controllers/SurveyController.php) | PHP | 48 | 0 | 13 | 61 |
| [app/data/Faskes.php](/app/data/Faskes.php) | PHP | 76 | 0 | 30 | 106 |
| [app/data/Jawaban.php](/app/data/Jawaban.php) | PHP | 21 | 0 | 10 | 31 |
| [app/data/Pertanyaan.php](/app/data/Pertanyaan.php) | PHP | 159 | 0 | 64 | 223 |
| [app/data/Responden.php](/app/data/Responden.php) | PHP | 267 | 1 | 63 | 331 |
| [app/helpers/app\_helpers.php](/app/helpers/app_helpers.php) | PHP | 12 | 0 | 3 | 15 |
| [app/logic/ikm\_result.php](/app/logic/ikm_result.php) | PHP | 64 | 0 | 11 | 75 |
| [app/process/ProsesFaskes.php](/app/process/ProsesFaskes.php) | PHP | 35 | 0 | 9 | 44 |
| [app/process/ProsesLogin.php](/app/process/ProsesLogin.php) | PHP | 9 | 0 | 4 | 13 |
| [app/process/ProsesLogout.php](/app/process/ProsesLogout.php) | PHP | 3 | 0 | 3 | 6 |
| [app/process/ProsesQuestion.php](/app/process/ProsesQuestion.php) | PHP | 74 | 4 | 13 | 91 |
| [app/process/ProsesSubmit.php](/app/process/ProsesSubmit.php) | PHP | 41 | 2 | 10 | 53 |
| [app/process/ProsesUser.php](/app/process/ProsesUser.php) | PHP | 63 | 4 | 11 | 78 |
| [app/routes/admin.php](/app/routes/admin.php) | PHP | 48 | 0 | 11 | 59 |
| [app/routes/web.php](/app/routes/web.php) | PHP | 14 | 0 | 4 | 18 |
| [app/view/admin/dashboard.php](/app/view/admin/dashboard.php) | PHP | 200 | 0 | 10 | 210 |
| [app/view/admin/faskes-page.php](/app/view/admin/faskes-page.php) | PHP | 56 | 0 | 6 | 62 |
| [app/view/admin/results-page.php](/app/view/admin/results-page.php) | PHP | 362 | 6 | 46 | 414 |
| [app/view/admin/survey-question-page.php](/app/view/admin/survey-question-page.php) | PHP | 76 | 0 | 10 | 86 |
| [app/view/admin/users-page.php](/app/view/admin/users-page.php) | PHP | 55 | 0 | 7 | 62 |
| [app/view/components/admin/delete-confirmation-modal.php](/app/view/components/admin/delete-confirmation-modal.php) | PHP | 24 | 0 | 4 | 28 |
| [app/view/components/admin/header.php](/app/view/components/admin/header.php) | PHP | 16 | 0 | 2 | 18 |
| [app/view/components/admin/modal-detail-responden.php](/app/view/components/admin/modal-detail-responden.php) | PHP | 45 | 0 | 3 | 48 |
| [app/view/components/admin/modal-faskes.php](/app/view/components/admin/modal-faskes.php) | PHP | 42 | 0 | 4 | 46 |
| [app/view/components/admin/modal-question.php](/app/view/components/admin/modal-question.php) | PHP | 117 | 0 | 8 | 125 |
| [app/view/components/admin/modal-user.php](/app/view/components/admin/modal-user.php) | PHP | 73 | 0 | 10 | 83 |
| [app/view/components/admin/navbar.php](/app/view/components/admin/navbar.php) | PHP | 46 | 0 | 5 | 51 |
| [app/view/components/admin/partials/logo-sidebar.php](/app/view/components/admin/partials/logo-sidebar.php) | PHP | 18 | 0 | 1 | 19 |
| [app/view/components/admin/partials/user-info.php](/app/view/components/admin/partials/user-info.php) | PHP | 17 | 0 | 1 | 18 |
| [app/view/components/admin/restore-confirmation-modal.php](/app/view/components/admin/restore-confirmation-modal.php) | PHP | 44 | 0 | 9 | 53 |
| [app/view/components/admin/sidebar.php](/app/view/components/admin/sidebar.php) | PHP | 11 | 0 | 4 | 15 |
| [app/view/components/public/footer.php](/app/view/components/public/footer.php) | PHP | 6 | 0 | 2 | 8 |
| [app/view/components/public/modal-login.php](/app/view/components/public/modal-login.php) | PHP | 63 | 0 | 8 | 71 |
| [app/view/components/public/modal-notification.php](/app/view/components/public/modal-notification.php) | PHP | 36 | 0 | 6 | 42 |
| [app/view/components/public/navbar.php](/app/view/components/public/navbar.php) | PHP | 39 | 0 | 5 | 44 |
| [app/view/components/public/page-title.php](/app/view/components/public/page-title.php) | PHP | 4 | 0 | 1 | 5 |
| [app/view/layouts/admin.php](/app/view/layouts/admin.php) | PHP | 37 | 0 | 6 | 43 |
| [app/view/layouts/guest.php](/app/view/layouts/guest.php) | PHP | 26 | 0 | 6 | 32 |
| [app/view/public/hasil-ikm.php](/app/view/public/hasil-ikm.php) | PHP | 142 | 0 | 12 | 154 |
| [app/view/public/index-main.php](/app/view/public/index-main.php) | PHP | 27 | 0 | 5 | 32 |
| [app/view/public/mobile/question-view.php](/app/view/public/mobile/question-view.php) | PHP | 43 | 0 | 12 | 55 |
| [app/view/public/question-view.php](/app/view/public/question-view.php) | PHP | 41 | 0 | 2 | 43 |
| [app/view/public/responden-view.php](/app/view/public/responden-view.php) | PHP | 149 | 0 | 12 | 161 |

[Summary](results.md) / Details / [Diff Summary](diff.md) / [Diff Details](diff-details.md)