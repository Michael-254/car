<div class="content-wrapper text-sm">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500 text-lg">View Year Plan</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">This year Plan</li>
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

                        @if($assign == 'true')
                        <form wire:submit.prevent="assignTask">
                            <div class="m-1 p-2 w-full flex space-x-2 rounded border sm:pt-0">
                                <div class="inline-block mt-1 w-1/3 pr-1">
                                    <label class="text-sm font-bold text-green-500">User To Assign Task</label>
                                    <select wire:model="user_id" class="form-control rounded">
                                        <option>--Select User--</option>
                                        @foreach($Users as $user)
                                        <option value="{{$user->id}}">{{$user->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="inline-block mt-1 w-1/3 pr-1">
                                    <label class="text-sm font-bold text-green-500">Date To Complete Task</label>
                                    <x-input wire:model="date" type="date" class="form-control" />
                                </div>
                                <div class="inline-block mt-8 w-1/3 pr-1">
                                    <button type="submit" class=" items-center px-3 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white hover:bg-yellow-800 focus:outline-none 
                                focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Assign</button>
                                </div>
                            </div>
                        </form>
                        @endif

                        <section class="m-1 p-2 w-full flex justify-between space-x-2 rounded border sm:pt-0">
                            <section class="bg-white w-3/4 overflow-hidden sm:rounded-lg">
                                <x-auth-validation-errors class="px-2 py-2" :errors="$errors" />
                                <div class="flex justify-between px-2 py-2 sm:px-6">
                                    <h5 class=" text-blue-500">2021 Full Year Plan</h5>
                                    <p class="font-bold text-sm underline">Current Week: Week-{{ now()->weekOfYear }}</p>
                                </div>
                                <table class="table">
                                    <thead class="text-green-900">
                                        <th style="width: 15%;">Week</th>
                                        <th>Sites with Monitoring</th>
                                    </thead>
                                    @foreach($plans as $plan)
                                    <tr>
                                        <td>
                                            <div class="m-1 p-2 w-full flex flex-col rounded border bg-gray-200 sm:pt-0">
                                                {{$plan->week}}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="flex justify-between">
                                                @forelse($plan->sitess as $plan)
                                                <div class="m-1 p-2 w-full flex flex-col rounded border {{$current == $plan->id ? 'bg-green-300' : ''}} 
                                                bg-gray-200 sm:pt-0">
                                                    <a wire:click.prevent="selected({{$plan}})" class="cursor-pointer focus:bg-blue-600">
                                                        {{$plan->site}}</a>
                                                </div>
                                                @empty
                                                <p class="mt-2.5 text-red-500">No Site with Activity yet in this week</p>
                                                @endforelse
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-2 text-center">
                                    {{$plans->links()}}
                                </div>
                            </section>
                            <section class="w-1/4">
                                <section class="bg-white w-full mt-12 overflow-hidden sm:rounded-lg">
                                    <h5 class="px-2 py-2 sm:px-6 text-blue-500">Activity to Monitor</h5>
                                    <div class="border-t border-gray-200">
                                    </div>
                                    @if($current != "")
                                    @forelse($todos as $todo)
                                    <div class="m-1 p-2 w-full rounded border sm:pt-0">
                                        <div class="flex justify-between">
                                            {{$todo->MonitoringActivities->list}}
                                            <i onclick="confirm('Warning! if you delete this,All Weekly plans related to it will be deleted too') || event.stopImmediatePropagation()" wire:click="remove({{$todo->id}})" class="fas fa-trash mt-1 cursor-pointer text-red-500"></i>
                                        </div>
                                        <div class="mt-1 text-blue-700">
                                            @if($todo->checked)
                                            <p>Monitoring Done</p>
                                            @else
                                            <p>Pending</p>
                                            @endif
                                        </div>
                                        @if($todo->userplan != '')
                                        <p class="text-red-600 font-bold">Assigned to:
                                            {{App\Models\User::find($todo->userplan->user_id)->name}}
                                        </p>
                                        <span onclick="confirm('Warning! if you unassign this,All Work Done by User on this Task will be lost') || event.stopImmediatePropagation()"
                                              wire:click="Unassign({{$todo->id}})" class="text-green-600 font-bold hover:underline 
                                            hover:text-yellow-500 cursor-pointer">Unassign Task</span>
                                        <div class="flex justify-end mb-1">
                                            <a href="{{route('view.tasks')}}" class="items-center px-3 py-2 font-bold text-black hover:underline">More Info</a>
                                        </div>
                                        @else
                                        <div>
                                            <span wire:click="assign({{$todo->id}})" class="text-green-600 font-bold hover:underline 
                                            hover:text-yellow-500 cursor-pointer">Assign Task</span>
                                        </div>
                                        @endif
                                    </div>

                                    @empty
                                    <p class="mt-2.5 px-2 text-red-500">No activity in this site</p>
                                    @endforelse
                                    <div class="text-blue-500 text-center">
                                        <i data-toggle="modal" data-target="#exampleModal" class="fas fa-plus-circle cursor-pointer"></i>
                                    </div>
                                    @endif
                                </section>
                            </section>


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
                    <h5 class="modal-title" id="exampleModalLabel">Add New Activity to Monitor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput2">Activities to Monitor</label>
                            <select wire:model="newActivity" class="form-control">
                                <option>--Select One--</option>
                                @foreach($lists as $list)
                                <option value="{{$list->id}}">{{$list->list}}</option>
                                @endforeach
                            </select>
                            @error('newActivity') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <x-button class="btn btn-secondary close-btn" data-dismiss="modal">Close</x-button>
                    <x-button wire:click.prevent="addNew" class="btn btn-primary" data-dismiss="modal">Save changes</x-button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
</div>