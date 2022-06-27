<x-app-layout>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-center">Master Data</h2>
                            </div>
                        </div>
                        <div class="row master-menu">
                            <div class="col bg-sky rounded-lg hover:shadow cursor-pointer text-center m-3 pt-3 pb-3 text-black" href="{{ route('master.college.index') }}">
                                Perguruan Tinggi
                            </div>
                            <div class="col bg-sky rounded-lg hover:shadow cursor-pointer text-center m-3 pt-3 pb-3 text-black" href="{{ route('master.major.index') }}">
                                Program Studi
                            </div>
                            <div class="col bg-sky rounded-lg hover:shadow cursor-pointer text-center m-3 pt-3 pb-3 text-black" href="{{ route('master.position.index') }}">
                                Jabatan Fungsional
                            </div>
                            <div class="col bg-sky rounded-lg hover:shadow cursor-pointer text-center m-3 pt-3 pb-3 text-black" href="{{ route('master.rank.index') }}">
                                Pangkat
                            </div>
                        </div>
                        <div class="row master-menu">
                            <div class="col bg-sky rounded-lg hover:shadow cursor-pointer text-center m-3 pt-3 pb-3 text-black" href="{{ route('master.requirement.index') }}">
                                Persyaratan Promosi
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
                const cols = menu.find(".col")

                cols.on("click", (e)=>{
                    window.location.href = $(e.target).attr("href")
                })
            })
        </script>
    @endpush
</x-app-layout>
