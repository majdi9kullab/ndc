@extends("admin.layout.app")

@section("title","Categories Search")


@section("content")

    <form class='row mb-3'>
        <div class='col-8'>
            <input name="q" autofocus type="text" value='{{ request()->get("q") }}' class="form-control" placeholder="Enter your search"/>
        </div>
        <div class='col-2'>
            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
        </div>
{{--        <div class='col-2'>--}}
            <a href="{{ route("category.create") }}" class="btn btn-success"> <i class="fa fa-plus"></i> Create New</a>
{{--        </div>--}}
    </form>
    @if($items->count()>0)
<table align="center" class="table mt-3 table-striped table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Show</th>
            <th>News Count</th>
            <th width="20%"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td><input type="checkbox" disabled {{ $item->show?"checked":"" }} /></td>
            <td>{{ $item->news->count() }}
                <!--ul>
                    @foreach($item->news as $new_item)
                    <li>{{$new_item->title}}</li>
                    @endforeach
                </ul-->
            </td>
            <td width="20%">
                <form method="post" action="{{ route('category.destroy', $item->id) }}">
                    <a href="{{ route('category.show', $item->id) }}" class="btn btn-info btn-sm"><i class='fa fa-eye'></i></a>

                    <a href="{{ route("category.edit", $item->id) }}" class="btn btn-primary btn-sm"><i class='fa fa-edit'></i></a>

{{--                    <a href="" onclick='return confirm("Are you sure ?")' class="btn btn-warning btn-sm"><i class='fa fa-trash'></i></a>--}}

                    <button onclick='return confirm("Are you sure ?")' type="submit" class="btn btn-danger btn-sm"><i class='fa fa-trash'></i></button>
                    @csrf
                    @method("DELETE")
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
    @else
        <div class='alert alert-warning'>Sorry, there is no results to your search</div>
    @endif

    {{$items->links()}}

@endsection
