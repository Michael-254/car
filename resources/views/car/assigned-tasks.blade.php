<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500 text-lg">My Assigned Tasks</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">My Tasks</li>
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
                                        <th>Comment</th>
                                        <th>Task Status</th>
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
                                        @if($acti->task_completed)
                                        Completed
                                        @elseif(!$acti->task_completed && $acti->findings == "not conforming")
                                        <a href="{{route('new.audit',$acti->id)}}" class="inline-flex items-center px-4 py-2 bg-green-500 border border-transparent 
                                        rounded-md text-xs text-white  hover:bg-blue-600 focus:outline-none ">CAR</a>
                                        @else
                                        pending
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
                                            <span class="leading-6 w-5/12 font-medium text-gray-900">
                                                Checklist Name
                                            </span>
                                            <span class="leading-6 w-3/12 font-medium text-gray-900">
                                                Checked
                                            </span>
                                            <span class="leading-6 w-4/12 font-medium text-gray-900">
                                                Comment
                                            </span>
                                        </div>
                                        @foreach($action as $child)
                                        <div class="flex justify-between mt-2">
                                            <p class="w-5/12 text-sm text-gray-500">
                                                {{$child->sons}}
                                                <input type="hidden" name="title[]" value="{{$child->sons}}">
                                            </p>
                                            <p class="w-3/12 mr-2">
                                                <select name="checkbox[]" class="rounded border py-1 bg-gray-200 w-2/3" required>
                                                    <option value="">--Select Action--</option>
                                                    <option value="yes">Yes</option>
                                                    <option value="no">No</option>
                                                </select>
                                            </p>
                                            <p class="w-4/12">
                                                <textarea type="text" placeholder="comment" name="comment[]" rows="1" class="px-2 py-1 relative rounded 
                                  border bg-gray-200 outline-none w-full" required></textarea>
                                            </p>

                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="px-5 mb-4 flex justify-end items-center space-x-2">
                                        <label class="text-green-500 mt-2">Findings:</label>
                                        <select name="finding" class="rounded border py-1 bg-gray-200">
                                            <option value="">--Select Findings--</option>
                                            <option value="conforming">Conforming</option>
                                            <option value="not conforming">Not Conforming</option>
                                        </select>
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
    <!-- /.content -->
</div>