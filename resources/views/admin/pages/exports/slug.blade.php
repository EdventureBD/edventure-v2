<table>
    <thead>
        <tr>
            <th>Slug</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($slugs as $slug)
            <tr>
                <td>{{ $slug }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
