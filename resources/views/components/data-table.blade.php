<div>
    <table class="table table-striped table-inverse">
        <thead class="thead-inverse">
            <tr>
                @foreach ($fields as $field)
                    @if(isset($field['label']))
                        <th>{{ ucfirst($field['label']) }}</th>
                    @else
                        <th>{{ ucfirst($field) }}</th>
                    @endif 
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        @foreach ($fields as $field)
                            @if(isset($field['key']))
                                <td>{{ $item[$field['key']]}}</td>
                            @else
                                <td>{{ $item[$field]}}</td>
                            @endif 
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
    </table>

{{-- <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item disabled">
        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
        <a class="page-link" href="#">Next</a>
        </li>
    </ul>
</nav> --}}
</div>