<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500  text-lg">Respond to a Non-conformance</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Non-conformance Response</li>
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
                    <div class="max-w-md mx-auto sm:max-w-7xl">

                        <x-success-message />
                        <section class="m-1 p-2 w-12/12 flex flex-col rounded border sm:pt-0 text-sm">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if($data == 0)
                            <h5 class="font-bold text-center text-green-900">Non-Conformances</h5>
                            <input wire:model="search" type="text" class="w-1/4 rounded border h-8 bg-gray-200 mb-2" placeholder="Search" />
                            @if($conformances->count()==0)
                            <p class="text-center text-orange-500 mt-2">No Received Non-comformance</p>
                            @else
                            <table class="table">
                                <thead class="text-green-900">
                                    <tr>
                                        <th>Date Received</th>
                                        <th>CAR No.</th>
                                        <th>Auditee</th>
                                        <th>HOD Comment</th>
                                        <th>MD Comment</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($conformances as $conformance)
                                <tr class="odd gradeX">
                                    <td>{{$conformance->date}}</td>
                                    <td>{{$conformance->number}}</td>
                                    <td>{{$conformance->auditee}}</td>
                                    <td>{{$conformance->HOD_comment}}</td>
                                    <td>{{$conformance->mt_comment}}</td>
                                    <td>{{$conformance->status}}</td>
                                    <td><i wire:click.prevent="respond({{$conformance->id}})" class="fas fa-reply-all cursor-pointer text-blue-700"></i></td>
                                </tr>
                                @endforeach
                                @endif
                                </tbody>
                            </table>
                            <div class="mt-2">
                                {{$conformances->links()}}
                            </div>

                            @else
                            <div class="flex items-center justify-between mt-1">
                                <div class="flex ml-1">
                                    <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="far fa-hand-point-left"></i> Go back</span>
                                </div>
                              
                              @if(auth()->user()->LA)
                                <button data-toggle="modal" data-target="#updateModal" class="items-center px-3 py-2 bg-blue-500 border  rounded-md  text-xs 
                                    text-white hover:bg-blue-800 focus:outline-none focus:border-gray-900
                                    focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                    Add Response</button>
                              @endif

                            </div>
                            <div class="sm:min-w-screen flex items-center justify-between mt-2 mb-3">
                                <section class="lg:w-2/12">
                                </section>
                                <section class="lg:w-8/12 sm:w-full">
                                    <div class="rounded bg-white overflow-hidden shadow-md px-2 py-2">

                                        <header class="flex justify-center">
                                            <img class="w-12 h-12 rounded-full" src="{{asset('/storage/logo.png')}}" alt="logo image" />
                                            <h5 class="mt-2.5 font-bold">Monitoring and Evaluation Department</h5>
                                        </header>
                                        <div class="flex justify-center">
                                            <h6 class="mt-2 font-bold">Corrective Action Report</h6>
                                        </div>
                                        <div class="flex justify-center space-x-1 mt-3">
                                            <label for="disabledSelect" class="text-green-500">Status:</label>
                                            <p class="form-control-static font-bold text-blue-700">{{$status}}</p>
                                        </div>

                                        <section class="p-2 w-full border rounded">
                                            <div class="rounded border py-3 px-3">

                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Company</label>
                                                        <p class="form-control-static">Better Globe<br>Forestry</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Date</label>
                                                        <p class="form-control-static">{{$dateMade}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">CAR Number</label>
                                                        <p class="form-control-static">{{$number}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Type</label>
                                                        <p class="form-control-static">{{$checkbox}}</p>
                                                    </div>
                                                </div>


                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Auditor</label>
                                                        <p class="form-control-static">{{$auditor}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Auditee</label>
                                                        <p class="form-control-static">{{$auditee}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Department</label>
                                                        <p class="form-control-static">{{$department}}</p>
                                                    </div>
                                                    <div>
                                                        <label class="text-green-500">Site</label>
                                                        <p class="form-control-static">{{$site}}</p>
                                                    </div>
                                                </div>

                                                <div class="mt-2 flex justify-between">
                                                    <div>
                                                        <label for="disabledSelect" class="text-green-500">Standard && Clause</label>
                                                        <p class="form-control-static">{{$clause}}</p>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div>
                                                    <label for="disabledSelect" class="text-green-500">Auditor's Report</label>
                                                    <p class="form-control-static">{{$nonconformance}}</p>
                                                </div>
                                            </div>

                                            <div class="rounded border mt-2 py-3 px-4">
                                                <label for="disabledSelect" class="text-green-500">Evidence</label>
                                                @forelse ($files as $attach)
                                                <p class="form-control-static">
                                                    <a href="{{route('view.file',$attach->id)}}" target="_blank">{{$attach->file}}</a>
                                                </p>
                                                @empty
                                                <p>No Evidence was attached</p>
                                                @endforelse
                                            </div>

                                            <h5 class="text-blue-700 mt-2 py-3 px-4">Auditees Response</h5>
                                            @forelse($solutions as $solution)
                                            @if($solution->owner == 'auditee')
                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Cause {{$loop->iteration}}</label>
                                                        <p class="form-control-static">{{$solution->cause}}</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="text-green-500">Proposed Corrective Action {{$loop->iteration}}</label>
                                                    <p class="form-control-static">{{$solution->proposed_solution}}</p>
                                                </div>
                                                <div>
                                                    <label class="text-green-500">Proposed Completion Date {{$loop->iteration}}</label>
                                                    <p class="form-control-static">{{$solution->proposed_date}}</p>
                                                </div>
                                            </div>
                                            @endif
                                            @empty
                                            <div class="rounded border mt-2 py-3 px-4">
                                                <span class="text-red-600">No response added yet</span>
                                            </div>
                                            @endforelse

                                            <h5 class="text-blue-700 mt-2 py-3 px-4">HOD Response</h5>
                                            @foreach($solutions as $solution)
                                            @if($solution->owner == 'HOD')
                                            <div class="rounded border mt-2 py-3 px-4">
                                                <div class="flex justify-between">
                                                    <div>
                                                        <label class="text-green-500">Cause</label>
                                                        <p class="form-control-static">{{$solution->cause}}</p>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="text-green-500">Proposed Corrective Action</label>
                                                    <p class="form-control-static">{{$solution->proposed_solution}}</p>
                                                </div>
                                                <div>
                                                    <label class="text-green-500">Proposed Completion Date</label>
                                                    <p class="form-control-static">{{$solution->proposed_date}}</p>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach

                                            <div class="mt-2 flex space-x-2 rounded border py-3 px-4">
                                                <div class="flex-1">
                                                    <label for="disabledSelect" class="text-green-500">HOD Decision</label>
                                                    <select wire:model="decision" type="text" class="w-full py-1 rounded-lg shadow-sm focus:outline-none focus:shadow-outline bg-gray-200 text-gray-600">
                                                        <option value="">-- Select Decision --</option>
                                                        <option value="HOD approved">HOD approved</option>
                                                        <option value="HOD declined">HOD declined</option>
                                                    </select>
                                                    <input wire:model="auditeeN" type="hidden">
                                                </div>
                                                <div class="flex-1">
                                                    <label for="disabledSelect" class="text-green-500">Comment</label>
                                                    <textarea wire:model.lazy="HODcomment" class="w-full py-1 bg-gray-200 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600"></textarea>
                                                </div>
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

                                            <div wire:loading wire:target="update" class="text-red-500 font-bold">
                                                Updating please wait...
                                            </div>

                                      @if(auth()->user()->LA)
                                            <div class="mt-2 flex justify-end">
                                                <a wire:click="update" class="items-center px-3 py-2 bg-black border  rounded-md  text-xs cursor-pointer
                                                text-white hover:bg-green-500 focus:outline-none focus:border-gray-900
                                                 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                                    Update</a>
                                            </div>
                                     @endif


                                        </section>
                                        <!-- footer -->
                                    </div>

                                </section>
                                <section class="lg:w-2/12">

                                </section>

                            </div>

                            @endif
                        </section>

                    </div>


                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">My Response</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <input type="hidden" wire:model="report_id">
                            <label class="text-green-700">Cause</label>
                            <textarea class="form-control" wire:model.defer="cause" placeholder="Enter Cause"></textarea>
                            @error('cause') <span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="text-green-700">Proposed Corrective Action</label>
                            <textarea class="form-control" wire:model.defer="proposed_solution" placeholder="Enter proposed_solution"></textarea>
                            @error('proposed_solution') <span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label class="text-green-700">Proposed Completion Date</label>
                            <input type="date" class="form-control" wire:model.defer="proposed_date" />
                            @error('proposed_date') <span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <x-button type="button" class="bg-black" data-dismiss="modal">Cancel</x-button>
                    <x-button type="button" wire:click.prevent="answers()" class="btn btn-primary" data-dismiss="modal">Save</x-button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
</div>