<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500  text-lg">Car Logs</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Closed CARs</li>
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
                            <div class="flex mb-4">
                                <input wire:model.debounce.150ms="search" class="bg-gray-200 mr-2 h-9 rounded border" type="text" placeholder="Search..." />
                                <select wire:model="filterAuditor" class="rounded border bg-gray-200 h-9 mr-2">
                                    <option value="">-- Filter by Auditor --</option>
                                    @foreach($Users as $user)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <select wire:model="filterAuditee" class="rounded border bg-gray-200 h-9 mr-2">
                                    <option value="">-- Filter by Auditee --</option>
                                    @foreach($Users as $user)
                                    <option value="{{$user->name}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <select wire:model="filterSite" class="rounded border bg-gray-200 h-9 mr-3">
                                    <option value="">-- Filter with Site --</option>
                                    <option value="Kiambere">Kiambere</option>
                                    <option value="Nyongoro">Nyongoro</option>
                                    <option value="Dokolo">Dokolo</option>
                                    <option value="Head Office">Head Office</option>
                                    <option value="Kampala">Kampala</option>
                                    <option value="7 Forks">7 Forks</option>
                                </select>
                                <x-button wire:click.prevent="back" class="bg-black">Reset</x-button>
                            </div>
                            @if($conformances->count()==0)
                            <p class="text-center text-orange-500 mt-2">No Received Non-comformance</p>
                            @else
                            <table class="table">
                                <thead class="text-green-900">
                                    <tr>
                                        <th>CAR No.</th>
                                        <th>Site.</th>
                                        <th>Auditor</th>
                                        <th>Audit Date</th>
                                        <th>Auditee</th>
                                        <th>Status</th>
                                        <th>HOD Comment</th>
                                        <th>More Info</th>
                                    </tr>
                                </thead>
                                @foreach ($conformances as $conformance)
                                <tr class="odd gradeX">
                                    <td>{{$conformance->number}}</td>
                                    <td>{{$conformance->site}}</td>
                                    <td>{{$conformance->auditor}}</td>
                                    <td>{{$conformance->date}}</td>
                                    <td>{{$conformance->auditee}}</td>
                                    <td>{{$conformance->status}}</td>
                                    <td>{{$conformance->HOD_comment}}</td>
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
                            <div class="flex ml-1">
                                <span wire:click="back()" class="cursor-pointer" style="line-height: 32px;"><i class="far fa-hand-point-left"></i> Go back</span>
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

                                            @if($hodName != '')
                                            <div class="mt-2 flex space-x-2 rounded border py-3 px-4">
                                                <div class="flex-1">
                                                    <span class="text-green-500 font-bold">HOD Name</span>
                                                    <p class="form-control-static">{{App\Models\User::find($hodName)->name}}</p>
                                                </div>
                                                <div class="flex-1">
                                                    <Span class="text-green-500 font-bold">HOD Comment</span>
                                                    <p class="form-control-static">{{$HODcomment}}</p>
                                                </div>
                                            </div>
                                            @endif


                                            <div class="mt-2 flex space-x-2 rounded border py-3 px-4">
                                                <div class="flex-1">
                                                    <span class="text-green-500 font-bold">Follow Up By</span>
                                                    <p class="form-control-static">{{App\Models\User::find($followName)->name}}</p>
                                                </div>
                                                <div class="flex-1">
                                                    <Span class="text-green-500 font-bold">Start Follow-up date</span>
                                                    <p class="form-control-static">{{$followDate}}</p>
                                                </div>
                                                <div class="flex-1">
                                                    <Span class="text-green-500 font-bold">End Follow-up date</span>
                                                    <p class="form-control-static">{{$EndfollowDate}}</p>
                                                </div>
                                            </div>

                                            <div class="mt-2 rounded border py-3 px-4">
                                                <Span class="text-green-500 font-bold">Follow Up Observations</span>
                                                @forelse($followUpdateData as $follow)
                                                <div class="flex justify-between">
                                                    {{$loop->iteration}}
                                                    <span class="w-10/12 ml-1">{{$follow->saying}}</span>
                                                    <span class="w-2/12">{{$follow->created_at->format('d-m-Y')}}</span>
                                                </div>
                                                @empty
                                                <p class="text-red-500">No Observations recorded yet</p>
                                                @endforelse
                                            </div>

                                            <div class="mt-2 flex space-x-2 rounded border py-3 px-4">
                                                <Span class="text-green-500 font-bold">Date Closed:</span>
                                                <p class="form-control-static">{{$ClosedDate}}</p>
                                            </div>


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

    <!-- /.content -->
</div>