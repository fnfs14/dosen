<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">Daftar Jabatan Fungsional</h2>
                            <table class="table table-hover mt-3 mb-3 table-primary" id="list-position">
                                <thead>
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th>Nama</th>
                                        <th></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        {!! LoadAssets([
            "fa",
            "jq-dt-css",
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "jq-dt-js",
            "toastr-js",
            "swa",
        ]) !!}

        <script src="{{ asset('js/position/index.js') }}"></script>
    @endpush
</x-app-layout>
