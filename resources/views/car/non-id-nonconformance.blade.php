<div>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-green-500 text-lg">Prepare New Non-Conformance</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right text-sm">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Prepare Non-conformance</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div wire:loading wire:target="save">
            <div style="display: flex; justify-content: center; align-items: center; background-color: black; position:fixed; 
              top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: .75;">
                <div class="la-ball-scale-ripple-multiple">
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="max-w-md mx-auto sm:max-w-3xl">
                            <section class="rounded-lg shadow-sm">
                                <form wire:submit.prevent="save">
                                    <div class="rounded bg-white overflow-hidden shadow-md px-2 py-2 mb-2 text-sm">

                                        <header class="flex justify-center">
                                            <img class="w-12 h-12 rounded-full" src="{{asset('/storage/logo.png')}}" alt="logo image" />
                                            <h5 class="mt-2.5 font-bold">Monitoring and Evaluation Department</h5>
                                        </header>
                                        <div class="flex justify-center">
                                            <h6 class="mt-2 font-bold">Corrective Action Request</h6>
                                        </div>

                                        <section class="p-2 w-full border rounded">
                                            <div class="rounded border py-3 px-4">

                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Company</label>
                                                        <p class="form-control-static">Better Globe Forestry</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Date</label>
                                                        <p class="form-control-static">{{date("d-m-Y")}}</p>
                                                        <input wire:model="date" type="hidden">
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">CAR Number</label>
                                                        <p class="form-control-static">{{$unique}}</p>
                                                        <input wire:model="number" type="hidden">
                                                    </div>
                                                </div>

                                                <div class="mt-2">
                                                    <div>
                                                        <label for="disabledSelect" class="text-green-500">Auditor</label>
                                                        <input wire:model="auditor" type="text" class="w-full py-1 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline text-gray-600" disabled>
                                                    </div>
                                                </div>

                                                <div class="mt-2 flex space-x-2">
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee</label>
                                                        <select wire:model="auditee" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                            <option value="">-- Select Auditee --</option>
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}">{{$user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <input wire:model="auditeeN" type="hidden">
                                                    </div>
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee Site</label>
                                                        <input wire:model="site" type="text" class="w-full py-1 bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600" disabled>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee Department</label>
                                                        <input wire:model="department" type="text" class="w-full py-1 bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline  text-gray-600" disabled>
                                                    </div>
                                                </div>

                                                <div class="mt-2 flex space-x-2">
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Reference</label>
                                                        <input wire:model="clause" type="text" class="w-full py-1 bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600">
                                                        @error('clause') <span class="text-red-500">{{ $message }}</span> @enderror
                                                    </div>
                                                    <div>
                                                        <div class="flex space-x-2 mt-4">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" wire:model="checkbox" class="custom-control-input" id="customRadio1" value="Major">
                                                                <label for="customRadio1" class="custom-control-label text-green-500">Major</label>
                                                            </div>
                                                            <div class="custom-control custom-radio">
                                                                <input wire:model="checkbox" class="custom-control-input" type="radio" id="customRadio2" value="Minor">
                                                                <label for="customRadio2" class="custom-control-label text-green-500">Minor</label>
                                                            </div>
                                                        </div>
                                                        @error('checkbox') <span class="text-red-500">{{ $message }}</span> @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div wire:ignore>
                                                    <label for="note" class="text-green-500">Non conformance</label>
                                                    <textarea data-note="@this" id="note" wire:model.defer="report" type="text" rows="3" class="w-full bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600"></textarea>
                                                </div>
                                                @error('report') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <input type="file" wire:model="file" class="cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4  rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-blue-200 font-medium">
                                                @error('file') <span class="text-red-500">{{ $message }}</span> @enderror
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Signature</label>
                                                        <p class="form-control-static">{{auth()->user()->name}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Date</label>
                                                        <p class="form-control-static">{{date("d-m-Y")}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div wire:loading wire:target="save" class="text-red-500 font-bold">
                                                Submitting please wait...
                                            </div>
                                            <div class="flex items-center justify-end mt-4">
                                                <x-button id="submit" type="submit">
                                                    Submit
                                                </x-button>
                                            </div>

                                        </section>
                                        <!-- footer -->
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>


                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    @push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#note'))
            .then(editor => {
                document.querySelector('#submit').addEventListener('click', () => {
                    let note = $('#note').data('note');
                    eval(note).set('report', editor.getData());
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
    @endpush
</div>