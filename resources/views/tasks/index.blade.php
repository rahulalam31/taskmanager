@extends('layouts.app')
@section('content')
    <!--Project Modal -->
    <div class="modal fade" id="exampleModalProject" tabindex="-1" role="dialog" aria- labelledby="exampleModalProject"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/project-store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Project Name</label>
                            <input type="text" class="form-control" name="project" placeholder="Project Name">
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submit" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Task Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria- labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/tasks') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Task Name</label>
                            <input type="text" class="form-control" name="task" placeholder="Task Name">
                        </div>
                        <div class="form-group">
                            <label>Project</label>
                            <select class="form-control" name="project">
                                <option selected>Select Project</option>
                                @foreach ($projects as $projectItem)
                                    <option value="{{ $projectItem->id }}">{{ $projectItem->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Priroty</label>
                            <select class="form-control" name="priority">
                                <option value="1">High</option>
                                <option value="2">Medium</option>
                                <option value="3">Normal</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="submit" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row d-flex justify-content-center container">
        <div class="col-md-8">
            <div class="card-hover-shadow-2x mb-3 card">
                <div class="card-header-tab card-header">
                    <div class="card-header-title font-size-lg text-capitalize font-weight-normal"><i
                            class="fa fa-tasks"></i>&nbsp;Task Lists
                    </div>&nbsp;&nbsp;&nbsp;

                    <button class="btn btn-success" data-toggle="modal" data-target="#exampleModalProject">Add
                        Project</button>&nbsp;&nbsp;&nbsp;
                    <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Task</button>

                </div>
                <div class="scroll-area-sm">
                    <perfect-scrollbar class="ps-show-limits">
                        <div style="position: static;" class="ps ps--active-y">
                            <div class="ps-content">
                                <ul class=" list-group list-group-flush">
                                    @foreach ($tasks as $taskItem)
                                        <li class="list-group-item">
                                            <div class="todo-indicator bg-warning"></div>
                                            <div class="widget-content p-0">
                                                <div class="widget-content-wrapper">
                                                    <div class="widget-content-left">
                                                        <div class="widget-heading">{{ $taskItem->name }}
                                                            @if($taskItem->priority == 1)
                                                            <div class="badge badge-danger ml-2">Highest</div>
                                                            @elseif ($taskItem->priority == 2)
                                                            <div class="badge badge-warning ml-2">Medium</div>
                                                            @elseif ($taskItem->priority == 3)
                                                            <div class="badge badge-info ml-2">Low</div>
                                                            @endif
                                                        </div>
                                                        <div class="widget-subheading"><i>By {{  $taskItem->project->name}}</i></div>
                                                    </div>
                                                    <div class="widget-content-right">
                                                        {{-- <button class="border-0 btn-transition btn btn-outline-success">
                                                            <i class="fa fa-check"></i></button> --}}
                                                        <a href="tasks/{{$taskItem->id }}/delete" class="border-0 btn-transition btn btn-outline-danger">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                    {{-- <li class="list-group-item">
                                        <div class="todo-indicator bg-focus"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"><input
                                                            class="custom-control-input" id="exampleCustomCheckbox1"
                                                            type="checkbox"><label class="custom-control-label"
                                                            for="exampleCustomCheckbox1">&nbsp;</label></div>
                                                </div>
                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Make payment to Bluedart</div>
                                                    <div class="widget-subheading">
                                                        <div>By Johnny <div class="badge badge-pill badge-info ml-2">NEW
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="widget-content-right">
                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                        <i class="fa fa-check"></i></button>
                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-primary"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"><input
                                                            class="custom-control-input" id="exampleCustomCheckbox4"
                                                            type="checkbox"><label class="custom-control-label"
                                                            for="exampleCustomCheckbox4">&nbsp;</label></div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">Office rent </div>
                                                    <div class="widget-subheading">By Samino!</div>
                                                </div>

                                                <div class="widget-content-right">
                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                        <i class="fa fa-check"></i></button>
                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-info"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"><input
                                                            class="custom-control-input" id="exampleCustomCheckbox2"
                                                            type="checkbox"><label class="custom-control-label"
                                                            for="exampleCustomCheckbox2">&nbsp;</label></div>
                                                </div>

                                                <div class="widget-content-left">
                                                    <div class="widget-heading">Office grocery shopping</div>
                                                    <div class="widget-subheading">By Tida</div>
                                                </div>
                                                <div class="widget-content-right">
                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                        <i class="fa fa-check"></i></button>
                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-success"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"><input
                                                            class="custom-control-input" id="exampleCustomCheckbox3"
                                                            type="checkbox"><label class="custom-control-label"
                                                            for="exampleCustomCheckbox3">&nbsp;</label></div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">Ask for Lunch to Clients</div>
                                                    <div class="widget-subheading">By Office Admin</div>
                                                </div>

                                                <div class="widget-content-right">
                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                        <i class="fa fa-check"></i></button>
                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="list-group-item">
                                        <div class="todo-indicator bg-success"></div>
                                        <div class="widget-content p-0">
                                            <div class="widget-content-wrapper">
                                                <div class="widget-content-left mr-2">
                                                    <div class="custom-checkbox custom-control"><input
                                                            class="custom-control-input" id="exampleCustomCheckbox10"
                                                            type="checkbox"><label class="custom-control-label"
                                                            for="exampleCustomCheckbox10">&nbsp;</label></div>
                                                </div>
                                                <div class="widget-content-left flex2">
                                                    <div class="widget-heading">Client Meeting at 11 AM</div>
                                                    <div class="widget-subheading">By CEO</div>
                                                </div>

                                                <div class="widget-content-right">
                                                    <button class="border-0 btn-transition btn btn-outline-success">
                                                        <i class="fa fa-check"></i></button>
                                                    <button class="border-0 btn-transition btn btn-outline-danger">
                                                        <i class="fa fa-trash"></i>

                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>

                        </div>
                    </perfect-scrollbar>
                </div>
            </div>
        </div>
    </div>
@endsection
