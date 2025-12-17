<div class="space-y-4 max-h-[600px] overflow-y-auto pr-2">
        <?php
            $no = 1;
            foreach ($questions as $key => $value) {
                $answer = explode(':', $value['jawaban']);
                ?>
                <div class="rounded-lg border border-gray-300 p-4">
                    <p class="mb-3 text-sm font-medium text-gray-700"><?= $key > 1 ? $no++ . '.' : '' ?> <?= $value['pertanyaan'] ?></p>
                    <div class="flex justify-between text-sm">
                        <?php
                        $q = $key + 1;
                        ?>

                        <?php if ($key === 0): ?>
                            <!-- DROPDOWN -->
                            <select
                                name="q<?= $q ?>"
                                class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                                    focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none"
                                required
                            >
                                <option value="">-- Pilih Jawaban --</option>
                                <option value="<?= $answer[0] ?>"><?= $answer[0] ?></option>
                                <option value="<?= $answer[1] ?>"><?= $answer[1] ?></option>
                                <option value="<?= $answer[2] ?>"><?= $answer[2] ?></option>
                                <option value="<?= $answer[3] ?>"><?= $answer[3] ?></option>
                            </select>

                    <?php elseif ($key === 1): ?>
                        <!-- TANGGAL -->
                        <input
                            type="date"
                            name="q<?= $key + 1 ?>"
                            class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm
                                focus:border-blue-500 focus:ring-2 focus:ring-blue-500/30 outline-none"
                            required
                        />

                    <?php else: ?>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="q<?= $q ?>" value="<?= $answer[0] ?>" required> <?= $answer[0] ?>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="q<?= $q ?>" value="<?= $answer[1] ?>" required> <?= $answer[1] ?>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="q<?= $q ?>" value="<?= $answer[2] ?>" required> <?= $answer[2] ?>
                        </label>
                        <label class="flex items-center gap-2">
                            <input type="radio" name="q<?= $q ?>" value="<?= $answer[3] ?>" required> <?= $answer[3] ?>
                        </label>
                    <?php endif ?>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
    <div class="flex gap-3 mt-4">
    <button
        type="button"
        onclick="prevStep()"
        class="w-full rounded-lg border border-gray-300 px-4 py-2.5 text-sm font-medium text-gray-700
                hover:bg-gray-100 transition"
    >
        ← Kembali
    </button>

    <button
        type="submit"
        class="w-full rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-medium text-white
                hover:bg-blue-700 transition"
    >
        Kirim →
    </button>
</div>
</div>
