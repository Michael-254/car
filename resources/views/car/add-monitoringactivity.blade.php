<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500 text-lg">Add Activities to Audit</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Activities to Audit</li>
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
                        <section class="m-1 p-2 w-12/12 flex flex-col rounded border sm:pt-0">
                            <x-auth-validation-errors class="mb-4" :errors="$errors" />
                            @if($show == 1)
                            <form class="flex" wire:submit.prevent="addActivity">
                                <input wire:model.debouce.500ms="list" type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Add activity to Monitor.">
                                <div class="py-2">
                                    <button type="submit" class="p-2 bg-green-800 w-20 rounded shadow
                                       focus:bg-blue-500 text-white">Save</button>
                                </div>
                            </form>
                            <div>
                                @error('list') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <section class="px-2 py-2 flex justify-center">
                                <div>
                                    @foreach ($activities as $activity)
                                    <div class="rounded border shadow p-3 my-2">
                                        <div class="flex my-2">
                                            <div class="flex w-9/12">
                                                <p class="font-bold text-green-500">Main Activity:</p>
                                                <p wire:click.prevent="details({{$activity->id}})" data-toggle="modal" data-target="#exampleModal" class="mx-1 py-0.5 text-sm text-gray-800 font-semibold cursor-pointer hover:underline">
                                                    {{$activity->list}}
                                                </p>
                                            </div>
                                            <div class="flex ">
                                                <p class="font-semibold text-green-500">Created:</p>
                                                <span class="mx-1 py-1.5 text-xs text-gray-500 font-semibold">
                                                    {{$activity->created_at->diffForHumans()}}
                                                </span>
                                            </div>
                                            <i onclick="confirm('Are you sure to delete?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{$activity->id}})" class="py-2 fas fa-trash cursor-pointer text-red-500"></i>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </section>
                            <div class="mt-2 text-center">
                                {{$activities->links()}}
                            </div>

                            @else
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <h5 class="px-3 py-2 sm:px-6 text-green-500">Add list of activities under main Activity to Monitor</h5>
                                <div class="flex">
                                    <div class="px-5 py-2 sm:px-6">
                                        <h6 class="leading-6 font-medium text-blue-600">
                                            Activity to Monitor:
                                        </h6>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            {{$listId->list}}.
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200">
                                </div>
                                <div class="flex py-2 sm:px-6">
                                    <div class="inline-block w-full justify-center px-4 py-4">
                                        <form wire:submit.prevent="addsons">
                                            <label class="text-sm font-bold text-blue-600">list of activities under main Activity to Monitor</label>
                                            <div class="flex justify-between">
                                                <input wire:model.debouce.500ms="sons" type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Type here...">
                                                <div class="py-2 mt-1">
                                                    <x-button type="submit">Add</x-button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200">
                                </div>
                                <div class="px-5 py-2 mt-2 sm:px-6">
                                    <h6 class="leading-6 font-medium text-gray-900">
                                        Checklist Name
                                    </h6>
                                    @if($individual == 1)
                                    @foreach($childs as $child)
                                    <div class="flex justify-between mt-2 space-x-5">
                                        <p class=" max-w-2xl text-sm text-gray-500">
                                            {{$child->sons}}
                                        </p>
                                        <i wire:click.prevent="remove({{$child->id}})" class="fas fa-trash text-red-600 cursor-pointer"></i>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <div class="px-5 m-2 flex items-center justify-end ">
                                    <button wire:click.prevent="finish" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent 
                                        rounded-md font-semibold text-xs text-white  hover:bg-yellow-900 focus:outline-none ">Save All</button>
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


    <div wire:ignore.self class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-green-500" id="exampleModalLabel">Add/Remove list of Activities</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="px-5 py-2 mt-2 sm:px-6">
                        <h6 class="leading-6 font-medium text-blue-500 text-sm">
                            Activity Name
                        </h6>
                        @if($modal == 1)
                        @foreach($childs as $child)
                        <div class="flex justify-between mt-2 space-x-5">
                            <p class=" max-w-2xl text-sm text-gray-500">
                                {{$child->sons}}
                            </p>
                            <i wire:click.prevent="remove({{$child->id}})" class="fas fa-trash text-red-600 cursor-pointer"></i>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div class="border-t border-gray-200">
                    </div>
                    <div class="flex py-2 sm:px-6">
                        <div class="inline-block w-full justify-center px-4 py-4">
                            <label class="text-sm font-bold text-blue-600">New activity under main Activity to Monitor</label>
                            <div class="flex justify-between">
                                <input wire:model.debouce.500ms="sons" type="text" class="w-full rounded border shadow p-2 mr-2 my-2" placeholder="Add Checklist.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <x-button class="btn btn-secondary close-btn" data-dismiss="modal">Close</x-button>
                    <x-button wire:click.prevent="newSon" class="btn btn-primary" data-dismiss="modal">Save changes</x-button>
                </div>
            </div>
        </div>
    </div>

    <!-- /.content -->
</div>