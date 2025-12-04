<!-- Profile Modal -->
<div id="profileModal" class="fixed inset-0 z-[9999] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" onclick="closeProfileModal()"></div>

        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

        <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full">
            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                        <h3 class="mb-4 text-2xl font-bold leading-6 text-gray-900" id="modal-title">
                            <i class="mr-2 text-blue-600 fas fa-landmark"></i> Profil Desa Tegalsambi
                        </h3>
                        
                        <!-- Tabs -->
                        <div class="mb-4 border-b border-gray-200">
                            <nav class="flex -mb-px space-x-8" aria-label="Tabs">
                                <button onclick="switchProfileTab('history')" id="tab-history" class="px-1 py-4 text-sm font-medium text-blue-600 border-b-2 border-blue-600 whitespace-nowrap">
                                    Sejarah
                                </button>
                                <button onclick="switchProfileTab('vision')" id="tab-vision" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                                    Visi & Misi
                                </button>
                                <button onclick="switchProfileTab('structure')" id="tab-structure" class="px-1 py-4 text-sm font-medium text-gray-500 border-b-2 border-transparent hover:text-gray-700 hover:border-gray-300 whitespace-nowrap">
                                    Perangkat Desa
                                </button>
                            </nav>
                        </div>

                        <!-- Content -->
                        <div id="content-history" class="text-sm text-gray-600">
                            <p class="mb-2">Desa Tegalsambi memiliki sejarah panjang yang erat kaitannya dengan Perang Obor. Tradisi ini dilaksanakan setiap tahun sebagai bentuk rasa syukur dan tolak bala.</p>
                            <p>Nama "Tegalsambi" konon berasal dari kata "Tegal" (ladang) dan "Sambi" (pohon sambi), tempat di mana leluhur desa pertama kali membuka lahan.</p>
                        </div>

                        <div id="content-vision" class="hidden text-sm text-gray-600">
                            <h4 class="mb-2 font-bold text-gray-800">Visi</h4>
                            <p class="mb-4 italic">"Terwujudnya Desa Tegalsambi yang Maju, Mandiri, dan Berbudaya"</p>
                            
                            <h4 class="mb-2 font-bold text-gray-800">Misi</h4>
                            <ul class="pl-5 list-disc">
                                <li>Meningkatkan pelayanan publik yang transparan dan akuntabel.</li>
                                <li>Mengembangkan potensi wisata budaya Perang Obor.</li>
                                <li>Meningkatkan kesejahteraan masyarakat melalui pemberdayaan UMKM.</li>
                            </ul>
                        </div>

                        <div id="content-structure" class="hidden text-sm text-gray-600">
                            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                <div class="p-3 text-center rounded bg-gray-50">
                                    <div class="font-bold text-gray-900">H. Agus Santoso</div>
                                    <div class="text-xs text-gray-500">Petinggi (Kepala Desa)</div>
                                </div>
                                <div class="p-3 text-center rounded bg-gray-50">
                                    <div class="font-bold text-gray-900">Budi Utomo</div>
                                    <div class="text-xs text-gray-500">Carik (Sekretaris Desa)</div>
                                </div>
                                <!-- Add more as needed -->
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm" onclick="closeProfileModal()">
                    Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function switchProfileTab(tabName) {
        // Hide all content
        ['history', 'vision', 'structure'].forEach(t => {
            document.getElementById('content-' + t).classList.add('hidden');
            document.getElementById('tab-' + t).classList.remove('text-blue-600', 'border-blue-600');
            document.getElementById('tab-' + t).classList.add('text-gray-500', 'border-transparent');
        });

        // Show selected
        document.getElementById('content-' + tabName).classList.remove('hidden');
        document.getElementById('tab-' + tabName).classList.add('text-blue-600', 'border-blue-600');
        document.getElementById('tab-' + tabName).classList.remove('text-gray-500', 'border-transparent');
    }
</script>
