<table class="table table-striped table-bordered text-center">
    <tr>
        <th>#</th>
        <th>عنوان</th>
        <th>توضیحات</th>
        <th>حذف</th>
    </tr>
    @foreach($documents as $document)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$document->title}}</td>
            <td>
                {{$document->content}}
            </td>
            <td>
                <a href="/panel/documents/{{$document->id}}" class="btn btn-primary"target="_blank" >
                    دانلود
                </a>
            </td>
        </tr>
    @endforeach
</table>
