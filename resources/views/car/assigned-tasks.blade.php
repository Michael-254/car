<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500 text-lg">My Weekly Assigned Tasks</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right font-bold text-sm">
                        <li class="breadcrumb-item active"><a href="{{route('follow')}}">Assigned CARS To Follow-Up</a></li>
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
                            <x-auth-validation-errors class="px-2 py-2" :errors="$errors" />
                            @if($taskresponse == false)
                            <table class="table text-sm">
                                <thead wire:loading.delay.class="opacity-50" class="text-green-900">
                                    <tr>
                                        <th>Plan for</th>
                                        <th style="width: 35%;">Activity</th>
                                        <th>Inspected</th>
                                        <th>Findings</th>
                                        <th>Reviewer Comment</th>
                                        <th>Task Response</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($activities as $acti)
                                <tr>
                                    <td>{{$acti->date}}</td>
                                    <td>{{$acti->activityParent->MonitoringActivities->list}}</td>
                                    <td>{{$acti->inspected}}</td>
                                    <td>{{$acti->findings}}</td>
                                    <td>{{$acti->comment}}</td>
                                    <td>
                                        @if($acti->inspected == "yes")
                                        <button wire:click="viewTask({{$acti->id}})" data-toggle="modal" data-target="#exampleModal" class="inline-flex items-center px-3 py-1 bg-yellow-500 border border-transparent 
                                        rounded-md text-xs text-white  focus:outline-none">view</button>
                                        @endif
                                    </td>
                                    <td class="space-x-3 text-green-600 font-bold cursor-pointer">
                                        @if(!$acti->task_completed && $acti->inspected == 'no')
                                        <a wire:click.prevent="respond({{$acti->id}})">Respond</a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            @if($activities->count() > 5)
                            <div class="mt-2 text-center">
                                <button wire:click.prevent="loadMore" class="btn btn-sm btn-outline-primary">Load More</button>
                            </div>
                            @endif
                            <p wire:loading wire:target="loadMore" class="text-red-500 text-center">
                                Loading more Data...
                            </p>

                            @else
                            <form action="{{route('task.response')}}">

                                @csrf
                                <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                    <div class="flex px-3 mt-1">
                                        <span wire:click="back()" class="cursor-pointer">
                                            <i class="fas fa-hand-point-left "></i> Go back</span>
                                    </div>
                                    <h5 class="px-3 py-2 sm:px-6 text-green-500">Respond To Task Assigned</h5>
                                    <div class="flex">
                                        <div class="px-5 py-2 sm:px-6">
                                            <h6 class="leading-6 font-medium text-blue-600">
                                                Activity to Monitor:
                                            </h6>
                                            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                                {{$selectedActivity}}.
                                                <input type="hidden" name="selected" value="{{$selectedId}}">
                                            </p>
                                        </div>
                                    </div>

                                    <div class="border-t border-gray-200">
                                    </div>

                                    <div class="px-5 py-2 mt-2 sm:px-6">
                                        <div class="flex justify-between mt-2 space-x-5">
                                            <span class="leading-6 w-4/12 font-medium text-gray-900">
                                                Sub-activity Name
                                            </span>
                                            <span class="leading-6 w-2/12 font-medium text-gray-900">
                                                Checked
                                            </span>
                                            <span class="leading-6 w-3/12 font-medium text-gray-900">
                                                Findings
                                            </span>
                                            <span class="leading-6 w-3/12 font-medium text-gray-900">
                                                Comment
                                            </span>
                                        </div>
                                        @foreach($action as $child)
                                        <div class="flex justify-between mt-2">
                                            <p class="w-4/12 text-sm text-gray-500">
                                                {{$child->sons}}
                                                <input type="hidden" name="title[]" value="{{$child->sons}}">
                                            </p>
                                            <p class="w-2/12 mr-2">
                                                <select name="checkbox[]" class="rounded border py-1 bg-gray-200 w-2/3" required>
                                                    <option value="">--Action--</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </p>
                                            <p class="w-3/12 mr-2">
                                                <select name="state[]" class="rounded border py-1 bg-gray-200 w-2/3" required>
                                                    <option value="">--Select Findings--</option>
                                                    <option value="conforming">Conforming</option>
                                                    <option value="not conforming">Not Conforming</option>
                                                    <option value="not checked">Not Checked</option>
                                                </select>
                                            </p>
                                            <p class="w-3/12">
                                                <textarea type="text" placeholder="comment" name="comment[]" rows="1" class="px-2 py-1 relative rounded 
                                  border bg-gray-200 outline-none w-full" required></textarea>
                                            </p>

                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="px-5 m-2 flex items-center justify-end ">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-black border border-transparent 
                                        rounded-md font-semibold text-xs text-white  hover:bg-blue-600 focus:outline-none ">Save</button>
                                    </div>
                            </form>
                            @endif

                        </section>

                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-500" id="exampleModalLabel">Submitted Checklist</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center">
                        <a href="#" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent 
                    rounded-md text-xs text-white  hover:bg-blue-600 focus:outline-none" data-dismiss="modal">More Info</a>
                    </div>
                    <div class="px-5 py-2 mt-2 sm:px-6">
                        @if($modal == true)
                        @foreach($action as $child)
                        <ul class="list-group">
                            <li class="list-group-item">
                                <div class="flex">
                                    <input type="checkbox" class="text-blue-300 rounded mr-2 mt-1.5" value="{{$child->id}}">
                                    {{$child->title}}
                                </div>
                                <div class="mt-2 px-4">
                                    @if($child->state == "not conforming")
                                    <a href="{{route('new.audit',$child->id)}}" class="badge badge-primary">New CAR</a>
                                    @foreach($child->fails as $fail)
                                    <span class="badge badge-warning">
                                        CAR:{{$fail->number}}
                                    </span>
                                    @endforeach
                                    @elseif($child->state == "not checked")
                                    <p class="text-sm badge badge-danger">Not checked</p>
                                    @else
                                    <p class="text-sm badge badge-success">Conforming</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                        @endforeach
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button class="inline-flex items-center px-4 py-2 bg-black border border-transparent 
                    rounded-md text-xs text-white focus:outline-none" data-dismiss="modal">Close</button>
                    <x-button type="button" wire:click.prevent="multiSelect" class="inline-flex items-center px-4 py-2 bg-blue-500 border border-transparent 
                    rounded-md text-xs text-white focus:outline-none" data-dismiss="modal">Merge</x-button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
</div>