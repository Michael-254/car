@extends('layouts.parent')

@section('content')


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

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="max-w-md mx-auto sm:max-w-3xl">
                            <section class="rounded-lg shadow-sm text-sm">
                                <form action="{{route('update',$nonConformance)}}" method="POST">

                                    @method('patch')
                                    @csrf
                                    <div class="rounded bg-white overflow-hidden shadow-md px-2 py-2 mb-2">
                                        <header class="flex justify-center">
                                            <img class="w-12 h-12 rounded-full" src="{{asset('/storage/logo.png')}}" alt="logo image" />
                                            <h5 class="mt-2 font-bold">Corrective Action Request</h5>
                                        </header>

                                        <section class="p-2 w-full border rounded">
                                            <div class="rounded border py-3 px-4">

                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Company</label>
                                                        <p class="form-control-static">Better Globe Forestry</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Date</label>
                                                        <p class="form-control-static">{{$nonConformance->date}}</p>
                                                        <input name="date" type="hidden">
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">CAR Number</label>
                                                        <p class="form-control-static">{{$nonConformance->number}}</p>
                                                        <input name="number" type="hidden">
                                                    </div>
                                                </div>

                                                <div class="mt-2">
                                                    <div>
                                                        <label for="disabledSelect" class="text-green-500">Auditor</label>
                                                        <input name="auditor" type="text" value="{{$nonConformance->auditor}}" class="w-full py-1 bg-gray-200 rounded shadow-sm focus:outline-none focus:shadow-outline text-gray-600" disabled>
                                                    </div>
                                                </div>

                                                <div class="mt-2 flex space-x-2">
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee</label>
                                                        <select name="response_id" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                            @foreach($users as $user)
                                                            <option value="{{$user->id}}" @if ($nonConformance->response_id == $user->id) selected @endif>{{$user->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee Site</label>
                                                        <select name="site" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                            <option value="{{$nonConformance->site}}">{{$nonConformance->site}}</option>
                                                            <option value="Kiambere">Kiambere</option>
                                                            <option value="Nyongoro">Nyongoro</option>
                                                            <option value="Dokolo">Dokolo</option>
                                                            <option value="Head Office">Head Office</option>
                                                            <option value="Kampala">Kampala</option>
                                                            <option value="7 Forks">7 Forks</option>
                                                        </select>
                                                    </div>
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Auditee Department</label>
                                                        <select name="department" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                            <option value="{{$nonConformance->department}}">{{$nonConformance->department}}</option>
                                                            <option value="Forestry">Forestry</option>
                                                            <option value="Operations">Operations</option>
                                                            <option value="HR">HR</option>
                                                            <option value="IT">IT</option>
                                                            <option value="Communications">Communications</option>
                                                            <option value="Miti Magazine">Miti Magazine</option>
                                                            <option value="Accounts">Accounts</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="mt-2 flex space-x-2">
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Reference</label>
                                                        <input name="clause" type="text" value="{{$nonConformance->clause}}" class="w-full py-1 bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600">
                                                    </div>
                                                    <div class="flex-1">
                                                        <label for="disabledSelect" class="text-green-500">Type</label>
                                                        <select name="checkbox" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                            <option value="Minor" @if ($nonConformance->checkbox == 'Minor') selected @endif>Minor</option>
                                                            <option value="Major" @if ($nonConformance->checkbox == 'Major') selected @endif>Major</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div>
                                                    <label for="disabledSelect" class="text-green-500">Non Conformance</label>
                                                    <textarea name="report" id="editor" rows="3" class="w-full bg-gray-200 rounded-lg shadow-sm 
                                                    focus:outline-none focus:shadow-outline text-gray-600">{!!$nonConformance->report!!}</textarea>
                                                </div>
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <h5 class="text-blue-700">Auditees Response</h5>
                                                @forelse($nonConformance->responses as $solution)
                                                @if($solution->owner == 'auditee')
                                                <div class="flex flex-col mb-4">
                                                    <input type="hidden" name="solutionId[]" value="{{$solution->id}}">
                                                    <label class="text-green-500">Cause {{$loop->iteration}}</label>
                                                    <textarea name="cause[]" class="rounded border bg-gray-300">{{$solution->cause}}</textarea>
                                                </div>
                                                <div class="flex flex-col mb-4">
                                                    <label class="text-green-500 ">Proposed Corrective Action {{$loop->iteration}}</label>
                                                    <textarea name="proposed_solution[]" class="rounded border bg-gray-300">{{$solution->proposed_solution}}</textarea>
                                                </div>
                                                <div class="flex flex-col mb-4">
                                                    <label class="text-green-500">Proposed Completion Date {{$loop->iteration}}</label>
                                                    <x-input name="proposed_date[]" type="date" class="bg-gray-300 w-3/12 h-10" value="{{$solution->proposed_date}}" />
                                                </div>
                                                @endif
                                                @empty
                                                <div class="rounded border mt-2 py-3 px-4">
                                                    <span class="text-red-600">No response added yet</span>
                                                </div>
                                                @endforelse
                                            </div>

                                            <div class="flex items-center justify-end mt-4">
                                                <x-button type="submit">
                                                    Update
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
</div>


@endsection
@push('js')
<script src="https://cdn.ckeditor.com/ckeditor5/25.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush