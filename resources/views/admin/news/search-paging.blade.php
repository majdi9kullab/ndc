@extends("admin.layout.app")

@section("title", "Manage Search Paging News")


@section("content")

    <form class='row mb-3'>
        <div  class='col-8'>
            <input name="q" autofocus type="text" value='{{request()->get("q")}}' class="form-control" placeholder="Enter your search">
        </div>
        <div  class='col-2'>
            <button type="submit"  class="btn btn-primary"> <i class="fa fa-search"></i>search</button>
        </div>
        <div  class='col-2'>
            <a href="{{ route("news.create") }}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
        </div>
    </form>

    @if($news->count()>0)
<table align="center" mb-3 class="table table-striped mt-3 table-bordered">
    <thead>
        <tr>
            <th>title</th>
            <th>category  Name</th>
            <th>details</th>
            <th>summery</th>
            <th>published</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $s_news)
        <tr>
            <td><a href="{{ route("news.show", $s_news->id) }}">{{ $s_news->title }}</a></td>
            <td>{{ $s_news->category->name }}</td>
            <td>{{ $s_news->details }}</td>
            <td>{{ $s_news->summary }}</td>
            <td>{{ $s_news->published }}</td>
            <td width="20%">    <form method="post" action="{{ route('news.destroy', $s_news->id) }}">
                    <a href="{{ route("news.show", $s_news->id) }}" class="btn btn-info btn-sm"><i class='fa fa-eye'></i></a>

                    <a href="{{ route("news.edit", $s_news->id) }}" class="btn btn-primary btn-sm"><i class='fa fa-edit'></i></a>


                    <button onclick='return confirm("Are you sure dude?")' type="submit" class="btn btn-danger btn-sm"><i class='fa fa-trash'></i></button>
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $news->links() }}
    @else
        <div class='alert alert-warning'>Sorry , there is no results to your searc</div>
    @endif
@endsection
