<x-app-layout>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12">
                            <h2 class="text-center">Dashboard</h2>
                            <hr class="bg-gray-500"/>
                            <div class="grid sm:grid-cols-3 grid-cols-1 gap-1 w-100 text-center">
                                <div class="p-3">
                                    <div class="card bg-info text-white hover:shadow-lg-info cursor-pointer master-menu">
                                        <div class="card-body pb-2" href="{{route("promote.draf")}}">
                                            <div class="grid grid-cols-2 gap-1 w-100">
                                                <div>
                                                    <h4 class="card-title text-xl">Draf</h4>
                                                    <h1 class="fas fa-file-alt"></h1>
                                                </div>
                                                <div>
                                                    <h1 class="card-text text-85xl d-flex align-items-center justify-content-center">{{ $amount->draf }}</h1>
                                                </div>
                                            </div>
                                            <hr class="bg-white mb-2"/>
                                            <p class="card-text text-sm">
                                                <span class="float-start">Lihat lebih rinci</span>
                                                <i class="fas fa-arrow-right float-end"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="card bg-primary text-white hover:shadow-lg-primary cursor-pointer master-menu">
                                        <div class="card-body pb-2" href="{{route("promote.diajukan")}}">
                                            <div class="grid grid-cols-2 gap-1 w-100">
                                                <div>
                                                    <h4 class="card-title text-xl">Diajukan</h4>
                                                    <h1 class="fas fa-sync-alt"></h1>
                                                </div>
                                                <div>
                                                    <h1 class="card-text text-85xl d-flex align-items-center justify-content-center">{{ $amount->diajukan }}</h1>
                                                </div>
                                            </div>
                                            <hr class="bg-white mb-2"/>
                                            <p class="card-text text-sm">
                                                <span class="float-start">Lihat lebih rinci</span>
                                                <i class="fas fa-arrow-right float-end"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-3">
                                    <div class="card bg-danger text-white hover:shadow-lg-danger cursor-pointer master-menu">
                                        <div class="card-body pb-2" href="{{route("promote.ditolak")}}">
                                            <div class="grid grid-cols-2 gap-1 w-100">
                                                <div>
                                                    <h4 class="card-title text-xl">Ditolak</h4>
                                                    <h1 class="fas fa-times"></h1>
                                                </div>
                                                <div>
                                                    <h1 class="card-text text-85xl d-flex align-items-center justify-content-center">{{ $amount->ditolak }}</h1>
                                                </div>
                                            </div>
                                            <hr class="bg-white mb-2"/>
                                            <p class="card-text text-sm">
                                                <span class="float-start">Lihat lebih rinci</span>
                                                <i class="fas fa-arrow-right float-end"></i>
                                            </p>
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
    @push('styles')
        {!! LoadAssets([
            "fa",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
        ]) !!}
    @endpush
    @push('scripts')
        <script>
            $(document).ready((e)=>{
                const menu = $(".master-menu")
                const cols = menu.find("div[href]")

                cols.on("click", (e)=>{
                    var target = $(e.target)
                        target = target.hasClass("master-menu")
                            ? target
                            : target.parents(".master-menu").find("div[href]")
                    window.location.href = target.attr("href")
                })
            })
        </script>
    @endpush
</x-app-layout>
