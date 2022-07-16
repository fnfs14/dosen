<x-app-layout>
    <x-slot name="bearerToken">{{ ArrToStr($bearerToken) }}</x-slot>
    <div class="sm:pt-8 mt-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 p-6 pt-1">
                    <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden">
                        <div class="grid grid-cols-1 md:grid-cols-12 table-responsive-sm table-responsive-md table-responsive-lg table-responsive-xs">
                            <h2 class="text-center">{{ isset($data) ? "Ubah Pengajuan Promosi" : "Mengajukan Promosi" }}</h2>
                            <hr class="bg-gray-500"/>
                            <form action="" id="form-data">
                                @csrf
                                @if(@$data)
                                    <input type="hidden" id="id" value="{{ $data->id }}">
                                @endif
                                <input type="hidden" id="user" value="{{ AuthUser("id") }}">
                                <div class="row">
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label for="position">Jabatan</label>
                                            <select id="position" class="form-select" pk="{{ old('position',@$data->position) }}" required></select>
                                            {!! $errors->first('position', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-3">
                                        <div class="form-group">
                                            <label class="w-100">
                                                Bukti sedang mengajukan
                                                @if(@$data->file)
                                                    <a href="{{ str_replace("public//","",asset("storage/app/".$data->file)) }}" target="_blank" class="float-end">Buka</a>
                                                @endif
                                            </label>
                                            <input type="file" class="form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('file') ? 'border-red-700-important' : '' }}" id="file" name="file">
                                            {!! $errors->first('file', '<label class="help-block error-validation">:message</label>') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    @foreach ($requirements as $k => $v)
                                        <div class="col-md-4 mt-3">
                                            <div class="form-group">
                                                <label class="w-100">
                                                    {{ $v->name }}
                                                    @if(@$data->requirement[$v->id])
                                                        <a href="{{ str_replace("public//","",asset("storage/app/".$data->requirement[$v->id])) }}" target="_blank" class="float-end">Buka</a>
                                                    @endif
                                                </label>
                                                <input type="file" class="requirement form-control focus:border-emerald-300-important focus:ring focus:ring-emerald-100 {{ $errors->has('file') ? 'border-red-700-important' : '' }}" id="file-{{$v->id}}" name="requirement[{{$v->id}}]">
                                                {!! $errors->first('file', '<label class="help-block error-validation">:message</label>') !!}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col mt-4">
                                        <button type="submit" class="btn btn-primary btn-md">Simpan</button>
                                        <a href="{{ route('promote.index') }}" class="btn btn-danger btn-md">Batal</a>
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
            "select2-css",
            "toastr-css",
            "custom-form-css",
        ]) !!}
    @endpush
    @push('scripts')
        {!! LoadAssets([
            "select2-js",
            "toastr-js",
        ]) !!}

        <script src="{{ asset('js/promote/form.js') }}"></script>
    @endpush
</x-app-layout>
