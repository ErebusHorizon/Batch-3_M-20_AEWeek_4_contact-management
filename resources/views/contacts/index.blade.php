@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-container">
        <h1>All Contacts (Total Count: {{ $contacts->count() }} of {{ $totalContacts }} )</h1>

        <div class="sort-search-container">
            <form action="{{ route('contacts.index') }}" method="GET" class="form-inline">
                <input type="text" name="search" placeholder="Search by name or email" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </form>

            @if(request('search') && $contacts->isEmpty())
                <div class="alert alert-warning">
                    No contacts found for "{{ request('search') }}"!
                </div>
            @endif

            <form action="{{ route('contacts.index') }}" method="GET" class="sort-order">
                <label for="sort" class="sort-label">Sort by:</label>
                <select name="sort" id="sort">
                    <option value="" disabled selected>Choose Sorting</option>
                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name</option>
                    <option value="created_at" {{ request('sort') == 'created_at' ? 'selected' : '' }}>Created At</option>
                </select>

                <button type="submit" class="btn btn-primary">Sort</button>
            </form>
        </div>

        <div class="table-wrapper">
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                <tr>
                    <th>
                        <a href="{{ route('contacts.index', ['sort' => 'name']) }}">
                            Name
                            @if(request('sort') == 'name')
                                <span class="sort-arrow">&#9650;</span> <!-- Up Arrow -->
                            @endif
                        </a>
                    </th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>
                        <a href="{{ route('contacts.index', ['sort' => 'created_at']) }}">
                            Created At
                            @if(request('sort') == 'created_at')
                                <span class="sort-arrow">&#9660;</span> <!-- Down Arrow -->
                            @endif
                        </a>
                    </th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $contact->name }}</td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->address }}</td>
                        <td>{{ $contact->created_at->format('Y-m-d H:i:s') }}</td>
                        <td>{{ $contact->updated_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            <a href="{{ route('contacts.show', $contact->id) }}" class="btn btn-primary">View</a>
                            <a href="{{ route('contacts.edit', $contact->id) }}" class="btn btn-success">Edit</a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="back-button-container">
            <a href="{{ url()->previous() }}" class="btn btn-back">Back</a>
        </div>
    </div>

    <div class="pagination-container">
        <ul class="pagination">
            @if ($contacts->onFirstPage())
                <li class="disabled"><span>&laquo; Previous</span></li>
            @else
                <li><a href="{{ $contacts->previousPageUrl() }}" rel="prev">&laquo; Previous</a></li>
            @endif

            @foreach ($contacts->links()->elements as $element)
                @if (is_string($element))
                    <li class="disabled"><span>{{ $element }}</span></li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $contacts->currentPage())
                            <li class="active"><span>{{ $page }}</span></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($contacts->hasMorePages())
                <li><a href="{{ $contacts->nextPageUrl() }}" rel="next">Next &raquo;</a></li>
            @else
                <li class="disabled"><span>Next &raquo;</span></li>
            @endif
        </ul>
    </div>
@endsection
