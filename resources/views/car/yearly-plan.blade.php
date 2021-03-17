<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5 class="m-0 text-green-500 text-lg">Prepare Yearly Plan</h5>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right text-sm">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Yearly Plan</li>
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
                            <form wire:submit.prevent="save">
                                <div class="flex justify-center">

                                    <div class="inline-block mt-1 w-1/3 pr-1">
                                        <label class="text-sm font-bold text-gray-600">Week Number</label>
                                        <select class="form-control rounded" wire:model="weekselected">
                                            <option>-- Select Week Number --</option>
                                            @foreach($Week_numbers as $number)
                                            <option value="{{$number->id}}">{{$number->week}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="inline-block mt-1 w-1/3 pr-1">
                                        <label class="text-sm font-bold text-gray-600">Site</label>
                                        <select class="form-control rounded" wire:model.defer="site">
                                            <option>-- Select Site --</option>
                                            <option value="Kiambere">Kiambere</option>
                                            <option value="Nyongoro">Nyongoro</option>
                                            <option value="Dokolo">Dokolo</option>
                                            <option value="Head Office">Head Office</option>
                                            <option value="Kampala">Kampala</option>
                                            <option value="7 Forks">7 Forks</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="py-2 flex justify-center mt-2">
                                    <x-button type="submit" class="">Save</x-button>
                                </div>
                            </form>
                            @else
                            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                                <h5 class="px-2 py-2 sm:px-6 text-green-500">Add Activities for this Week on this site</h5>
                                <div class="flex">
                                    <div class="px-5 py-2 sm:px-6">
                                        <h6 class="leading-6 font-medium text-blue-600">
                                            2021 Yearly Plan of:
                                        </h6>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            {{$savedWeek}}.
                                        </p>
                                    </div>
                                    <div class="px-2 py-2 sm:px-6">
                                        <h6 class="leading-6 font-medium text-blue-600">
                                            Activities added to Site:
                                        </h6>
                                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                                            {{$savedsite}}.
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200">
                                </div>
                                <div class="flex px-5 py-2 sm:px-6">
                                    <div class="inline-block w-full justify-center">
                                        <label class="text-sm font-bold text-blue-600">Activities to be Audited</label>
                                        <select class="form-control rounded" wire:model.defer="todos">
                                            <option>Select Ativity To be Audited</option>
                                            @foreach($lists as $list)
                                            <option value="{{$list->id}}">{{$list->list}}</option>
                                            @endforeach
                                        </select>
                                        @error('weeks_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="mt-8 px-2">
                                        <x-button wire:click.prevent="add" class="flex-shrink-0">Add</x-button>
                                    </div>
                                </div>

                                <div class="border-t border-gray-200">
                                </div>
                                <div class="px-5 py-2 mt-2 sm:px-6">
                                    <h6 class="leading-6 font-medium text-gray-900">
                                        Activities Added
                                    </h6>
                                    @if($individual == 1)
                                    @foreach($individulActivities as $activity)
                                    <div class="flex justify-between mt-2 space-x-5">
                                        <p class=" max-w-2xl text-sm text-gray-500">
                                            {{$activity->MonitoringActivities->list}}
                                        </p>
                                        <i wire:click.prevent="remove({{$activity->id}})" class="fas fa-trash text-red-600 cursor-pointer"></i>
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
    <!-- /.content -->
</div>
