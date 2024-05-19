<div class="table-responsive">
  <table class="table table-hover table-striped">
    <thead>
    <th>Name</th>
    <th>Progress</th>
    <th>Created</th>
    <th></th>
    </thead>
    <tbody>
    @foreach($trips as $trip)
      <tr>
        <td>
          <a href="{{ route('alvatrips.show', [$trip->id]) }}">{{ $trip->name }}</a>
        </td>
        <td>
          {{ $trip->progress }}
        </td>
        <td>
          {{ $trip->created_at }}
        </td>
        <td>
          <a href="{{ route('alvatrips.show', [$trip->id]) }}" class="btn btn-outline-info btn-sm" style="z-index:9999"
             title="View">View</a>
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
