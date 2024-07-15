
@extends('layouts.app')
  @section('content')
      <h1>Student List</h1> 
      <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Add Student</button>
      <div class=”row”>
            <div class=”col-12”>
                <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col"> SR. NO</th>
                                    <th scope="col"> Name</th>
                                    <th scope="col"> Subject</th>
                                    <th scope="col"> Marks</th>   
                                    <th scope="col"> Action</th>   
                                </tr>
                        </thead>
                        <tbody>
                            @if(count($studentList) > 0)
                                @php $i = 0; @endphp
                                    @foreach ($studentList as $studentLists) 
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $studentLists->name }}</td>
                                        <td>{{ $studentLists->subject_name }}</td>
                                        <td >
                                            <span class="{{'old'.$studentLists->id}}">
                                                {{ $studentLists->marks }}
                                            </span>
                                            <span class="{{'new'.$studentLists->id}}" style="display:none;">
                                            <form method="POST" action="{{ route('studentUpdate') }}" >
                                                @csrf
                                                <input type="text"  name="id" value="{{$studentLists->id}}" style="display:none">
                                                <input type="text" name="marks" id="{{'new'.$studentLists->id}}" value="" required>

                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('update') }}
                                                </button>
                                            </form>
                                            </span>
                                        </td> 
                                        <td>
                                            <a href="{{ route('studentDelete',$studentLists->id) }}">Delete</a>
                                            <a href="javascript:void(0);" onclick="studentMarksUpdate({{$studentLists->id}})">Edit</a>
                                        </td>                                                           
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <th colspan="3" class="text-center">No data found</th>
                                </tr>
                            @endif
                        </tbody>
                    </table>
            {!! $studentList->links() !!}
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Form</h4>
                    </div>
                    <div class="modal-body">
                    <form method="POST" action="{{ route('studentInsert') }}" >
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required  autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="subject_name" class="col-md-4 col-form-label text-md-right">{{ __('Subject Name') }}</label>

                        <div class="col-md-6">
                            <input id="subject_name" type="subject_name" class="form-control @error('subject_name') is-invalid @enderror" name="subject_name" required autocomplete="current-password">

                            @error('subject_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="marks" class="col-md-4 col-form-label text-md-right">{{ __('Marks') }}</label>

                        <div class="col-md-6">
                            <input id="marks" type="marks" class="form-control @error('marks') is-invalid @enderror" name="marks" required autocomplete="current-password">

                            @error('marks')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                   
                    <!-- <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>
                    </div> -->
                </form>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>
            </div>
        </div>
      </div>  
      
    <script>
        function studentMarksUpdate(id){            
            $(".old"+id).hide(); 
            $(".new"+id).show();  
        }
    </script>

  @endsection