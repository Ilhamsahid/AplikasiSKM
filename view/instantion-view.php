
  <!-- Instansi -->
  <div>

    <label class="block mb-2 text-sm font-medium text-gray-700">
      Instansi
    </label>
    <input
      type="text"
      name="instansi"
      placeholder="Contoh: SMKN 1 Probolinggo"
      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
             focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none"
    id="instansi"
    />
    <label class="text-red-500 text-sm" for="" id="instansiMsg"></label>
  </div>

  <!-- Umur -->
  <div>
    <label class="block mb-2 text-sm font-medium text-gray-700">
      Umur
    </label>
    <input
      type="number"
      name="umur"
      placeholder="Contoh: 18"
      class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
             focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none"
    id="umur"
    />
    <label class="text-red-500 text-sm" for="" id="umurMsg"></label>
  </div>

  <!-- Jenis Kelamin -->
  <div>
    <label class="block mb-3 text-sm font-medium text-gray-700">
      Jenis Kelamin
    </label>


    <div class="flex gap-4">
      <!-- Laki-laki -->
      <label class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
          type="radio"
          name="jenis_kelamin"
          value="Laki-laki"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"
        />
        <span class="text-sm text-gray-700">Laki-laki</span>
      </label>

      <!-- Perempuan -->
      <div class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
       type="radio"
          name="jenis_kelamin"
          value="Perempuan"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"
        />
        <span class="text-sm text-gray-700">Perempuan</span>
      </div>
    </div>

    <label class="text-red-500 text-sm" for="" id="jkMsg"></label>
  </div>

  <!-- Pendidikan Terakhir -->
  <div>
    <label class="block mb-3 text-sm font-medium text-gray-700">
      Pendidikan Terakhir
    </label>

    <label class="grid grid-cols-2 gap-4">
      <label class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
          type="radio"
          name="pendidikan"
          value="SMA/SMK"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"

        />
        <span class="text-sm text-gray-700">SMA / SMK</span>
      </label>

      <label class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
          type="radio"
          name="pendidikan"
          value="D3"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"
        />
        <span class="text-sm text-gray-700">D3</span>
      </label>

      <label class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
          type="radio"
          name="pendidikan"
          value="S1"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"
        />
        <span class="text-sm text-gray-700">S1</span>
      </label>

      <label class="flex items-center gap-3 cursor-pointer rounded-lg border border-gray-300 px-4 py-2.5
                    hover:border-blue-500 transition">
        <input
          type="radio"
          name="pendidikan"
          value="S2/S3"
          class="h-4 w-4 text-blue-600 focus:ring-blue-500"
        />
        <span class="text-sm text-gray-700">S2 / S3</span>
      </label>
      <label class="text-red-500 text-sm" id="pendidikanMsg" for=""></label>
    </label>
  </div>
  <button
    type="button"
    onclick="nextStep()"
    class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white
        hover:bg-blue-700 transition"
    >
    Berikutnya →
</button>
