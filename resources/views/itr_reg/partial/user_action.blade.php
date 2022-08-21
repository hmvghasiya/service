<ul class="icons-list">
                                <li class="dropdown dropup">
                                    <a href="#" class="dropdown-toggle mt-10" data-toggle="dropdown" aria-expanded="false">
                                        <span class="label bg-slate">Action <i class="icon-arrow-down5"></i></span>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        	<li><a href="javascript:void(0)" class="change_rat_status" data-id="{{$data->id}}" data-status="3"> Delete</a></li>
	                                        <li><a href="{{route('itr_reg.view',$data->id)}}" > View</a></li>

                                    </ul>
                                </li>
                            </ul>