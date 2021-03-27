{{-- Course Assignment Section --}}
{{-- <div class="container"> --}}
    @if(count($user->courseAssignments)>0)
    <table class="table">
        <tr>
            {{-- <th>id</th> --}}
            <th>Course Name</th>
            <th>topics</th>
            <th>Assesment</th>
        </tr>
        @foreach ($user->courseAssignments as $ca)
            <tr>
                <td>{{$ca->course->title}}</td>
                <td>
                    <ul>
                    @foreach ($user->topicAssignments as $ta)
                        @if($ta->topic->course_id == $ca->course->id)
                            <li>{{ $ta->topic->title }}</li>
                        @endif
                    @endforeach
                    </ul>
                </td>
                <td>{{$ca->assesment}}</td>
            </tr>
        @endforeach
    </table>
    @endif
{{-- </div> --}}
{{-- Course Assignment Section --}}