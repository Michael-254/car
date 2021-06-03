<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h5 class="m-0 text-green-500 text-lg">Weekly Tasks to Monitor</h5>
                </div><!-- /.col -->
                <div class="col-sm-4 flex justify-center">
                    <svg class="mt-0.5 stroke-current h-9 w-9 animate-spin text-gray-400" wire:loading="wire:loading" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item font-bold"><a href="#">View</a></li>
                        <li class="breadcrumb-item active">Assigned Tasks to Follow-up</li>
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

                            @if($taskview == false)
                            <div class="flex mb-4">
                                <input wire:model.debounce.150ms="search" class="bg-gray-200 mr-2 h-9 rounded border" type="text" placeholder="Search..." />
                                <select wire:model="filterName" class="rounded border bg-gray-200 h-9 mr-2">
                                    <option value="">-- choose User --</option>
                                    @foreach($Users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                                <select wire:model="filterSite" class="rounded border bg-gray-200 h-9 mr-3">
                                    <option value="">-- choose Site --</option>
                                    <option value="Kiambere">Kiambere</option>
                                    <option value="Nyongoro">Nyongoro</option>
                                    <option value="Dokolo">Dokolo</option>
                                    <option value="Head Office">Head Office</option>
                                    <option value="Kampala">Kampala</option>
                                    <option value="7 Forks">7 Forks</option>
                                </select>
                                <x-button wire:click.prevent="back" class="bg-black">Reset</x-button>
                            </div>
                            <table class="table text-sm">
                                <thead wire:loading.delay.class="opacity-50" class="text-green-900">
                                    <tr>
                                        <th>Plan for</th>
                                        <th style="width: 35%;">Activity</th>
                                        <th>Assigned to</th>
                                        <th>Site</th>
                                        <th>Inspected</th>
                                        <th>Findings</th>
                                        <th>Reviwer Comments</th>
                                        <th>Task Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                @foreach ($tasks as $task)
                                <tr>
                                    <td>{{$task->date}}</td>
                                    <td>{{$task->activityParent->MonitoringActivities->list}}</td>
                                    <td>{{$task->userowner->name}}</td>
                                    <td>{{$task->userowner->site}}</td>
                                    <td>{{$task->inspected}}</td>
                                    <td>{{$task->findings}}</td>
                                    <td>{{$task->comment}}</td>
                                    <td>
                                        @if($task->inspected == 'yes')
                                        <p>completed</p>
                                        @else
                                        <p>pending</p>
                                        @endif
                                    </td>
                                    <td class="space-x-3 text-blue-600 font-bold cursor-pointer">
                                        @if($task->inspected == 'yes')
                                        <a wire:click.prevent="view({{$task->id}})">View</a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div>
                                {{$tasks->links()}}
                            </div>

                            @else
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <div class="flex px-3 mt-1">
                                    <span wire:click="back()" class="cursor-pointer">
                                        <i class="fas fa-hand-point-left "></i> Go back</span>
                                </div>
                                <h5 class="px-3 py-2 sm:px-6 text-green-500">Task Response</h5>
                                <div class="flex">
                                    <div class="px-5 py-2 sm:px-6">
                                        <h6 class="leading-6 font-medium text-blue-600">
                                            Date of Task:
                                        </h6>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            {{$response->date}}.
                                        </p>
                                    </div>
                                    <div class="px-5 py-2 sm:px-6">
                                        <h6 class="leading-6 font-medium text-blue-600">
                                            Activity to Monitor:
                                        </h6>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            {{$selectedActivity}}.
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200">
                                </div>

                                <div class="px-5 py-2 mt-2 sm:px-6">
                                    <div class="flex mt-2 space-x-5">
                                        <span class="leading-6 w-4/12 font-medium text-gray-900">
                                           Sub-activity Name
                                        </span>
                                        <span class="leading-6 w-2/12 font-medium text-gray-900">
                                            Checked
                                        </span>
                                        <span class="leading-6 w-2/12 font-medium text-gray-900">
                                            State
                                        </span>
                                        <span class="leading-6 w-2/12 font-medium text-gray-900">
                                            Comment
                                        </span>
                                        <span class="leading-6 w-2/12 font-medium text-gray-900">
                                            CAR
                                        </span>
                                    </div>
                                    @foreach($response->checks as $child)
                                    <div class="flex mt-2">
                                        <p class="w-4/12 text-sm text-gray-500  mr-2">
                                            {{$child->title}}
                                        </p>
                                        <p class="w-2/12 mr-2">
                                            {{$child->checkbox}}
                                        </p>
                                        <p class="w-2/12 mr-2">
                                            {{$child->state}}
                                        </p>
                                        <p class="w-2/12 mr-2">
                                            {{$child->comment}}
                                        </p>
                                        <p class="w-2/12">
                                            @if($child->fails != "")
                                                @foreach($child->fails as $fail)
                                                <span class="badge badge-warning">
                                                    CAR:{{$fail->number}}
                                                </span>
                                                @endforeach
                                            @elseif($child->fails != "" && $child->state == "not conforming")
                                                <span class="badge badge-danger">Awaiting</span>
                                            @endif
                                        </p>


                                    </div>
                                    @endforeach
                                </div>

                                <div class="flex px-5">
                                    <textarea wire:model.debouce.500ms="comment" class="w-full shadow p-2 mr-2 my-2 bg-gray-100" placeholder="Add Comment."></textarea>
                                    <div class="py-2 mt-1">
                                        <x-button wire:click.prevent="comment" class="bg-black">Save</x-button>
                                    </div>
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