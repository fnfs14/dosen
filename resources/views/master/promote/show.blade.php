<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">Pengajuan Promosi</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                <div class="row">
                                    <div class="col-md-6 mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <h3>Pengajuan</h3>
                                                <hr class="bg-gray-500"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Dosen</div>
                                            <div class="col-1">:</div>
                                            <div class="col">{{ $data->user->name }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Diajukan pada</div>
                                            <div class="col-1">:</div>
                                            <div class="col">{{ date("Y-m-d",strtotime($data->created_at)) }}</div>
                                        </div>
                                        <div class="row">
                                            <div class="col-3">Bukti</div>
                                            <div class="col-1">:</div>
                                            <div class="col"><a href="{{ str_replace("public//","",asset("storage/app/".$data->file)) }}" target="_blank">Unduh</a></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-3">
                                        <div class="row">
                                            <div class="col">
                                                <h3>Persyaratan</h3>
                                                <hr class="bg-gray-500"/>
                                            </div>
                                        </div>
                                        @foreach ($requirements as $k => $v)
                                            <div class="row">
                                                <div class="col-5">{{ $v->name }}</div>
                                                <div class="col-1">:</div>
                                                <div class="col">
                                                    @if(@$data->requirement[$v->id])
                                                        <a href="{{ str_replace("public//","",asset("storage/app/".$data->requirement[$v->id])) }}" target="_blank">Unduh</a>
                                                    @else
                                                        Tidak ada file yang diunggah
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        <button type="button" class="btn btn-success btn-md" pk="{{ $data->id }}">Setuju</button>
                                        <button type="button" class="btn btn-danger btn-md" pk="{{ $data->id }}">Tolak</button>
                                        <a href="{{ route('promote.user',$data->user->id) }}" class="btn btn-primary btn-md">Kembali</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('styles')
        {!! LoadAssets([
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "toastr-js",
            "swa",
        ]) !!}

        <script src="{{ asset('js/promote/show.js') }}"></script>
    @endpush
</x-app-layout>
