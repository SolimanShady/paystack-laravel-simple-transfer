@include("admin.header")

<div class="page">
    <h4>Transfer List ( {{$data->count()}} )</h4>
    <hr>
    <form action="{{ route('search') }}" method="get">
        <input type="text" class="form-control" name="search" placeholder="search" required>
    </form>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="page-heading">
                <tr>
                    <th>
                        #
                    </th>
                    <th>
                        reference
                    </th>
                    <th>
                        transfer_code
                    </th>
                    <th>
                        amount
                    </th>
                    <th>
                        reason
                    </th>
                    <th>
                        currency
                    </th>
                    <th>
                        status
                    </th>
                    <th>
                        Created at
                    </th>
                    <th>
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                <tr>
                    <td>
                        {{ $d->id }}
                    </td>
                    <td>
                        {{ $d->reference }}
                    </td>
                    <td>
                        {{ $d->transfer_code }}
                    </td>
                    <td>
                        {{ $d->amount }}
                    </td>
                    <td>
                        {{ $d->reason }}
                    </td>
                    <td>
                        {{ $d->currency }}
                    </td>
                    <td>
                        <span style="border-radius:2px;font-weight:bold;padding:1px;color:#fff;background:#39AC37;">
                            {{ $d->status }}
                        </span>
                    </td>
                    <td>
                        {{ $d->created_at }}
                    </td>
                    <td>
                        <form action="{{ route('transactions.delete', ['id' => $d->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <ul class="pagination">
            {{ $data->links('pagination::default') }}
        </ul>
    </div>
</div>

@include("admin.footer")
