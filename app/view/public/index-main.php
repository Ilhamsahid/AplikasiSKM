<!-- HEADER -->
<?= getView('components.public.page-title') ?>

<form action="/submit-survey" method="post">

    <!-- DATA RESPONDEN -->
    <?= getView('public.responden-view') ?>
    <?= getView('public.question-view', [
        'questions' => $questions
    ]) ?>

    <!-- Mobile View -->
    <?= getView('public.mobile.question-view',[
        'questions' => $questions
    ]) ?>

    <!-- SUBMIT BUTTON -->
    <div class="flex justify-end">
        <button
            type="submit"
            class="w-full sm:w-auto bg-gradient-to-r from-green-600 to-green-500 text-white px-8 py-3.5 rounded-xl text-sm font-semibold
                    hover:from-green-700 hover:to-green-600 shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 transform hover:scale-105"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Kirim Survey
        </button>
    </div>
</form>
