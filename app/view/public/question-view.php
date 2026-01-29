<!-- PERTANYAAN SURVEY -->
<div class="bg-white rounded-xl shadow-md p-4 sm:p-6 mb-4 sm:mb-6">
  <h3 class="text-base sm:text-lg font-semibold text-gray-800 mb-4 pb-2 border-b-2 border-green-600">Pertanyaan Survey</h3>

  <!-- Desktop View -->
  <div class="hidden lg:block overflow-x-auto">
    <table class="w-full border-collapse border border-gray-300">
      <thead>
        <tr class="bg-green-700 text-white">
          <th class="border border-gray-300 px-4 py-3 text-center text-sm font-semibold w-16">No</th>
          <th class="border border-gray-300 px-4 py-3 text-left text-sm font-semibold">Pertanyaan</th>
          <th class="border border-gray-300 px-3 py-3 text-center text-sm font-semibold w-32">1</th>
          <th class="border border-gray-300 px-3 py-3 text-center text-sm font-semibold w-32">2</th>
          <th class="border border-gray-300 px-3 py-3 text-center text-sm font-semibold w-32">3</th>
          <th class="border border-gray-300 px-3 py-3 text-center text-sm font-semibold w-32">4</th>
        </tr>
      </thead>
      <tbody class="bg-white">
        <?php $no = 1; ?>
        <?php foreach ($questionsAndAnswer as $key => $qA): ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="border border-gray-300 px-4 py-4 text-sm text-gray-700 text-center font-medium align-top"><?= $no++ ?></td>
            <td class="border border-gray-300 px-4 py-4 text-sm text-gray-700 align-top"><?= $qA['pertanyaan'] ?></td>
            <?php foreach ($qA['opsi']['label'] as $i => $label): ?>
              <td class="border border-gray-300 px-3 py-4 text-center align-middle">
                <div class="flex flex-col items-center gap-2">
                  <input
                    type="radio"
                    name="q<?= $key ?>"
                    value="<?= $qA['opsi']['id'][$i] ?>"
                    class="w-5 h-5 text-green-600 focus:ring-green-500 cursor-pointer"
                    required />
                  <span class="text-xs text-gray-600 text-center leading-tight">(<?= $label ?>)</span>
                </div>
              </td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
