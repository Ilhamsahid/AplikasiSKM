<div class="lg:hidden space-y-4">
  <?php $no = 1; ?>
  <?php foreach ($questionsAndAnswer as $key => $qA): ?>

    <div class="border-2 border-gray-200 rounded-xl overflow-hidden shadow-sm">

      <!-- Question Header -->
      <div class="bg-gradient-to-r from-green-600 to-green-500 p-4">
        <div class="flex items-start gap-3">
          <span
            class="flex-shrink-0 w-8 h-8 bg-white text-green-600 rounded-full flex items-center justify-center text-sm font-bold shadow">
            <?= $no++ ?>
          </span>

          <p class="text-white font-medium text-sm flex-1 pt-1 leading-relaxed">
            <?= $qA['pertanyaan'] ?>
          </p>
        </div>
      </div>

      <!-- Answer Options -->
      <div class="p-4 bg-white space-y-2">
        <?php $labels = ['A', 'B', 'C', 'D']; ?>
        <?php foreach ($qA['opsi']['label'] as $i => $label): ?>

          <label
            class="flex items-center gap-3 cursor-pointer p-3 rounded-lg border-2 border-gray-200 hover:border-green-500 hover:bg-green-50 transition-all">

            <input
              type="radio"
              name="q<?= $key ?>"
              value="<?= $qA['opsi']['id'][$i] ?>"
              class="w-5 h-5 text-green-600 focus:ring-green-500 cursor-pointer flex-shrink-0"
              required />

            <div class="flex-1 flex items-center gap-2">
              <span
                class="bg-green-100 text-green-700 px-2.5 py-1 rounded-md text-xs font-bold flex-shrink-0">
                <?= $labels[$i] ?>
              </span>

              <span class="text-sm text-gray-700 leading-relaxed">
                <?= $label ?>
              </span>
            </div>
          </label>

        <?php endforeach; ?>
      </div>

    </div>

  <?php endforeach; ?>
</div>
