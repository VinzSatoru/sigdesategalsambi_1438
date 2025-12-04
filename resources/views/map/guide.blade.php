<!-- Guide Modal -->
<div id="guideModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="closeGuideModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="mb-4 text-xl font-bold leading-6 text-gray-900" id="modal-title">
                            <i class="mr-2 text-green-600 fas fa-book-open"></i> Panduan Penggunaan
                        </h3>
                        
                        <div class="space-y-4 text-sm text-gray-600">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full">1</div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900">Navigasi Peta</h4>
                                    <p>Gunakan mouse untuk menggeser peta. Gunakan tombol <b>+</b> dan <b>-</b> di pojok kanan atas untuk memperbesar/memperkecil.</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full">2</div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900">Cari Lokasi</h4>
                                    <p>Gunakan kolom pencarian di kiri atas untuk menemukan sekolah, masjid, atau kantor pemerintahan.</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full">3</div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900">Layer & Legenda</h4>
                                    <p>Gunakan panel di sebelah kiri untuk menyembunyikan/menampilkan layer tertentu (misal: batas desa, jalan).</p>
                                </div>
                            </div>

                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <div class="flex items-center justify-center w-8 h-8 text-white bg-blue-500 rounded-full">4</div>
                                </div>
                                <div class="ml-3">
                                    <h4 class="font-bold text-gray-900">Detail Objek</h4>
                                    <p>Klik pada ikon atau area berwarna di peta untuk melihat informasi detailnya.</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeGuideModal()">
                    Mengerti
                </button>
            </div>
        </div>
    </div>
</div>
