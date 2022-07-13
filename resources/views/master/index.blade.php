<x-app-layout>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800">
                        @php
                            $contentClass = "pt-3 pb-3 ps-2 pe-2 text-break h-100 text-center text-black d-flex align-items-center justify-content-center bg-emerald-200 rounded-lg hover:shadow cursor-pointer";
                        @endphp
                        <div class="inline-flex grid-cols-1 gap-1 w-100 text-center master-menu">
                            <div class="p-2 w-100">
                                <h2 class="text-center">Master Data</h2>
                                <hr class="bg-gray-500"/>

                                <div class="inline-flex grid-cols-1 gap-1 w-100 text-center">
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.lecturer.index') }}">
                                            Dosen
                                        </div>
                                    </div>
                                </div>

                                <div class="inline-flex md:grid-cols-2 gap-1 w-100 text-center">
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.college.index') }}">
                                            Perguruan Tinggi
                                        </div>
                                    </div>
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.major.index') }}">
                                            Program Studi
                                        </div>
                                    </div>
                                </div>

                                <div class="inline-flex md:grid-cols-3 gap-1 w-100 text-center">
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.position.index') }}">
                                            Jabatan Fungsional
                                        </div>
                                    </div>
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.rank.index') }}">
                                            Pangkat
                                        </div>
                                    </div>
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.level.index') }}">
                                            Golongan
                                        </div>
                                    </div>
                                </div>

                                <div class="inline-flex md:grid-cols-1 gap-1 w-100 text-center">
                                    <div class="p-2 w-100">
                                        <div class="{{ $contentClass }}" href="{{ route('master.requirement.index') }}">
                                            Persyaratan Promosi
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready((e)=>{
                const menu = $(".master-menu")
                const cols = menu.find("div[href]")

                cols.on("click", (e)=>{
                    window.location.href = $(e.target).attr("href")
                })
            })
        </script>
    @endpush
</x-app-layout>
