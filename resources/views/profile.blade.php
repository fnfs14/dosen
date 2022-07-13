<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12">
                            <h2 class="text-center">Data Diri</h2>
                            <hr class="bg-gray-500"/>
                        </div>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Biodata</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Riwayat Pendidikan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Riwayat Mengajar</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="inline-grid md:grid-cols-2 gap-1 w-100">
                                    <div class="p-4">
                                        <img src="{{ AuthUser("profile_photo_path") }}" class="w-100" />
                                    </div>
                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-4">Nama</div>
                                            <div class="col-1"> : </div>
                                            <div class="col">{{ AuthUser("name") }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Perguruan Tinggi</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Program Studi</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Jenis Kelamin</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Jabatan Fungsional</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Pendidikan Tertinggi</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Status Ikatan Kerja</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-4">Status Aktivitas</div>
                                            <div class="col-1"> : </div>
                                            <div class="col"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">.2.</div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">..3</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        {!! LoadAssets([
            "toastr-css",
            "bs-tab-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "toastr-js",
        ]) !!}
    @endpush
</x-app-layout>
