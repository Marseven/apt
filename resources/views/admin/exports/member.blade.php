<table>
    <thead>
        <tr>
            <th>N°#</th>
            <th>Nom Complet</th>
            <th>Téléphone</th>
            <th>Quartier</th>
            <th>Date de création</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td>{{ $member->id }}</td>
                <td>{{ $member->firstname . ' ' . $member->lastname }}</td>
                <td>{{ $member->phone }}</td>
                <td>{{ $member->hood }}</td>
                <td>{{ $member->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
